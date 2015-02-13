<?php
	class Model_recommendation extends CI_Model {


		public function update_recommendation_table(){


			$all_users = $this->db->query("SELECT email FROM user")->result();

			foreach ($all_users as $user) {

				$all_user_knowledge = $this->db->get_where('knowledge', array('user_name' => $user->email))->result();
				$all_user_knowledge_count = $this->db->get_where('knowledge', array('user_name' => $user->email))->num_rows();

				$level4_cat_query = "
				SELECT level4_cat
				FROM knowledge
				WHERE user_name = '" . $user->email . "'
				";
				$level4_cat_results = $this->db->query($level4_cat_query)->result();
				$level4_cat_result = array();
				foreach ($level4_cat_results as $row) {
					array_push($level4_cat_result, $row->level4_cat);
				}

				$level4_cat_result = array_unique($level4_cat_result);
				foreach ($level4_cat_result as $row) {
					$cat_knowledge_count = $this->db->get_where('knowledge', array('user_name'=>$user->email, 'level4_cat'=>$row))->num_rows();
					$result = round($cat_knowledge_count / $all_user_knowledge_count  * 10);
					
					foreach ($all_user_knowledge as $knowledge_row) {
						if( $knowledge_row->level4_cat == $row ){
							if( $this->db->get_where('recommendation', array('knowledge_id' => $knowledge_row->knowledge_id,'user_name' => $user->email))->num_rows() == 0 ){
								$insert_data = array(
									'id' => '',
									'knowledge_id' => $knowledge_row->knowledge_id,
									'knowledge_title' => $knowledge_row->knowledge_title,
									'user_name' => $user->email,
									'rating' => $result,
									'created_time' => date("Y-m-d H:i:s")
									);
								$this->db->insert('recommendation', $insert_data);
							}else{
								$id = $this->db->get_where('recommendation', array('knowledge_id' => $knowledge_row->knowledge_id,'user_name' => $user->email))->row()->id;
								$update_data = array(
									'rating' => $result,
									'created_time' => date("Y-m-d H:i:s")
									);
								$this->db->where('id', $id);
								$this->db->update('recommendation', $update_data);
							}

						}
					}
				}
			}

		}


		public function create_dataset(){

			$this->update_recommendation_table();

			//generate array for recommendation
			$all_users = $this->db->query("SELECT email FROM user")->result();
			$dataset = array();
			foreach ($all_users as $user) {
				$knowledges_of_a_user = $this->db->get_where('knowledge', array('user_name'=>$user->email))->result();
				$knowledge_array = array();
				foreach ($knowledges_of_a_user as $knowledge_of_a_user) {
					$this_rating = $this->db->get_where('recommendation', array('knowledge_id'=>$knowledge_of_a_user->knowledge_id))->row()->rating;
					//$this_rating = $this->db->query($rating_query)->row()->rating;
					$knowledge_array[$knowledge_of_a_user->knowledge_title] = $this_rating;
				}
				$dataset[$user->email] = $knowledge_array;
				
			}

			return $dataset;
		}

		public function get_knowledge_recommendation($email){

			$dataset = $this->create_dataset();
			$re = new Recommend();

			return $re->getRecommendations($dataset, $email);
			
			// $new_dataset = $re->transformPreferences($dataset);
			// $re2 = new Recommend();
			// print_r($re2->getRecommendations($new_dataset, "CAPM"));

		}


		public function get_knowledge_by_recommendation_array($recommendations){
			$knowledge_name_array = array();
			foreach ($recommendations as $key => $value) {
				array_push($knowledge_name_array, $key);
			}

			$this->db->where_in('knowledge_title', $knowledge_name_array);
			$this->db->where('reference_knowledge_id', 0);
			$this->db->order_by('count');
			
			return $this->db->get('knowledge')->result();

		}


	}//end of the class


	class Recommend {

		//calculate a distance-based similarity score for 2 users  
		//it will return the similarity score (reciprocal of the distance)
		public function similarityDistance($preferences, $person1, $person2)
		{
			$similar = array();
			$sum = 0;

			//check whether person1 and person2 have the same preference
			foreach($preferences[$person1] as $key=>$value)
			{
				// if(array_key_exists($key, $preferences[$person2]))
				// 	$similar[$key] = 1;

				//added for detected whether the similarity > 30%
				foreach ($preferences[$person2] as $key1 => $value1) {
					if( $this->title_similar($key, $key1) > 30 ){
						$similar[$key] = 1;
					}
				}
			}

			//end the function if 2 people have no same preference at all
			if(count($similar) == 0)
				return 0;

			//add up the squares of all the differences
			foreach($preferences[$person1] as $key=>$value)
			{
				// if(array_key_exists($key, $preferences[$person2]))
				// 	$sum = $sum + pow($value - $preferences[$person2][$key], 2);

				//added for detected whether the similarity > 30%
				foreach ($preferences[$person2] as $key1 => $value1) {
					if( $this->title_similar($key, $key1) > 30 ){
						$sum = $sum + pow($value - $value1, 2);
					}
				}
			}

			//the larger the sum, the further the distance, the less the similarity
			//return the similarity score: between 0 ~ 1, the larger (closer to 1), the more similar
			return  1/(1 + sqrt($sum));     
		}


		//loop through the preference dataset and create a data table
		//the result will be an array of the similarity of all other people with $person
		public function matchItems($preferences, $person)
		{
			$score = array();

			//loop through all other people
			foreach($preferences as $otherPerson=>$values)
			{
				//it it is not "me"
				if($otherPerson !== $person)
				{
					$sim = $this->similarityDistance($preferences, $person, $otherPerson);

					if($sim > 0)
						$score[$otherPerson] = $sim;
				}
			}
			array_multisort($score, SORT_DESC);
			//will be an array of the similarity of all other people with me
			return $score;

		}

		public function getRecommendations($preferences, $person)
		{
			$total = array();
			$simSums = array();
			$ranks = array();
			$sim = 0;

			//loop through all other people
			foreach($preferences as $otherPerson=>$values)
			{
				//calculte the similarity distance between $person and this peroson
				if($otherPerson != $person)
				{
					$sim = $this->similarityDistance($preferences, $person, $otherPerson);
				}

				//if they are similar to some extends
				if($sim > 0)
				{
					foreach($preferences[$otherPerson] as $key=>$value)
					{
						//only calculate those items that $person don't have
						if(!array_key_exists($key, $preferences[$person]))
						{
							//for each new item, total score equal 0
							if(!array_key_exists($key, $total)) {
								$total[$key] = 0;
							}

							//the score equal to the raing * similarity
							//so the score will weighted by simiarity socre
							$total[$key] += $preferences[$otherPerson][$key] * $sim;

							//calculate the sum of similarity for the normalization step
							if(!array_key_exists($key, $simSums)) {
								$simSums[$key] = 0;
							}
							$simSums[$key] += $sim;
						}
					}
				}
			}

			//Normalized the list to avoid the high ranking from lots of people own this item
			foreach($total as $key=>$value)
			{
				$ranks[$key] = $value / $simSums[$key];
			}

			//the result $ranks will be a array of recommendation with score(rating * sim)
			array_multisort($ranks, SORT_DESC);    
			return $ranks;

		}

		// the function transform the format of the dataset given
		// e.g. $preferences[$person]=>item   ====>   $preferences[$item]=>person
		//		will give the result who will like a given item
		public function transformPreferences($preferences)
		{
			$result = array();

			foreach($preferences as $otherPerson => $values)
			{
				foreach($values as $key => $value)
				{
					$result[$key][$otherPerson] = $value;
				}
			}

			return $result;
		}

		//compare the title similarity
		public function title_similar($title_1,$title_2) {
			$title_1 = $this->get_real_title($title_1);
			$title_2 = $this->get_real_title($title_2);
			similar_text($title_1, $title_2, $percent);
			return $percent;
		}

		public function get_real_title($str){
			$str = str_replace(array('-','—','|'),'_',$str);
			$splits = explode('_', $str);
			$l = 0;
			foreach ($splits as $tp){
				$len = strlen($tp);
				if ($l < $len){$l = $len;$tt = $tp;}
			}
			$tt = trim(htmlspecialchars($tt));
			return $tt;
		}


	}

?>