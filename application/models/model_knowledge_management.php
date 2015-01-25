<?php
	class Model_knowledge_management extends CI_Model {
		public function add_knowledge(){

			//insert to knowledge tatble
				//knowledge table
			$data_knowledge =  array(
					'knowledge_id' => '',
					'knowledge_title' => $this->input->post('knowledge_title'),
					'knowledge_description' => $this->input->post('knowledge_description'),
					'knowledge_owner' => $this->session->userdata('email'),
					'count' => 1,
					'sharing_mode' => '',
					'created_time' => date("Y-m-d H:i:s")
				);
			$this->db->insert('knowledge', $data_knowledge);

			$knowledge_id = $this->get_knowledge_id($this->input->post('knowledge_description'), $this->session->userdata('email'));
			//insert to knowledge_item table
			$knowledge_item_title_arr = $this->input->post('knowledge_item_title');
			$knowledge_item_content_arr = $this->input->post('knowledge_item_content');

			$knowledge_description = $this->input->post('knowledge_description');
			$created_time = date("Y-m-d H:i:s");


			for ($i=0; $i < count($knowledge_item_title_arr) - 1 ; $i++) { 
				$knowledge_item_title = $knowledge_item_title_arr[$i];
				$knowledge_item_content = $knowledge_item_content_arr[$i];
				$insertKnowledgeItemQuery = "INSERT INTO `knowledge_item`(`knowledge_item_id`, `knowledge_id`, `knowledge_item_title`, `knowledge_item_content`, `created_time`) VALUES ( '', '$knowledge_id', '$knowledge_item_title', '$knowledge_item_content', '$created_time')";
				$this->db->query($insertKnowledgeItemQuery);
			}


			// insert category to DB
			$cat_owner = $this->session->userdata('email');

			$cat_area = $this->input->post('selected_area');
			$cat_major = $this->input->post('selected_major');
			$cat_subject = $this->input->post('selected_subject');
			$cat_chapter = $this->input->post('selected_chapter');

			// add area
			$user_cat_data = array(
						'cat_id' => "",
						'cat_name' => "",
						'parent_id' => "",
						'level' => NULL,
						'cat_owner' => $cat_owner,
						'created_time' => date("Y-m-d H:i:s")
					);
				//user_category
			$check_area_exists = $this->db->get_where('user_category', array('cat_name' => $cat_area, 'level' => 1, 'cat_owner' => $cat_owner));
			if($check_area_exists->num_rows == 0){
				$user_cat_data['cat_name'] = $cat_area;
				$user_cat_data['parent_id']= $this->get_category_id($cat_owner, $cat_owner, 0);
				$user_cat_data['level'] = 1;
				$this->db->insert('user_category', $user_cat_data);
			}
				//update category
			$check_area_exists_category = $this->db->get_where('category', array('cat_name' => $cat_area, 'level' => 1));
			if($check_area_exists_category->num_rows == 0){
				$cat_data = array(
						'cat_id' => "",
						'cat_name' => $cat_area,
						'parent_id' => NULL,
						'level' => 1,
						'count' => 1,
						'created_time' => date("Y-m-d H:i:s")
					);
				$this->db->insert('category', $cat_data);
			}
			else if($check_area_exists_category->num_rows == 1){
				$new_count = $this->db->get_where('category', array('cat_name' => $cat_area))->row()->count + 1;
				$this->db->where('cat_name', $cat_area);
				$this->db->update('category', array('count' => $new_count));
			}

			//add major
			$check_major_exists = $this->db->get_where('user_category', array('cat_name' => $cat_major, 'level' => 2, 'cat_owner' => $cat_owner));
			if($check_major_exists->num_rows == 0){
				$user_cat_data['cat_name'] = $cat_major;
				$user_cat_data['parent_id']= $this->get_category_id($cat_owner, $cat_area, 1);
				$user_cat_data['level'] = 2;
				$this->db->insert('user_category', $user_cat_data);
			}
				//update category
			$check_major_exists_category = $this->db->get_where('category', array('cat_name' => $cat_major, 'level' => 2));
			if($check_major_exists_category->num_rows == 0){
				$cat_data = array(
						'cat_id' => "",
						'cat_name' => $cat_major,
						'parent_id' => $this->db->get_where('category', array('cat_name' => $cat_area))->row()->cat_id,
						'level' => 2,
						'count' => 1,
						'created_time' => date("Y-m-d H:i:s")
					);
				$this->db->insert('category', $cat_data);
			}
			else if($check_major_exists_category->num_rows == 1){
				$new_count = $this->db->get_where('category', array('cat_name' => $cat_major))->row()->count + 1;
				$this->db->where('cat_name', $cat_major);
				$this->db->update('category', array('count' => $new_count));
			}


			//add subject
			$check_subject_exists = $this->db->get_where('user_category', array('cat_name' => $cat_subject, 'level' => 3, 'cat_owner' => $cat_owner));
			if($check_subject_exists->num_rows == 0){
				$user_cat_data['cat_name'] = $cat_subject;
				$user_cat_data['parent_id']= $this->get_category_id($cat_owner, $cat_major, 2);
				$user_cat_data['level'] = 3;
				$this->db->insert('user_category', $user_cat_data);				
			}
				//update category
			$check_subject_exists_category = $this->db->get_where('category', array('cat_name' => $cat_subject, 'level' => 3));
			if($check_subject_exists_category->num_rows == 0){
				$cat_data = array(
						'cat_id' => "",
						'cat_name' => $cat_subject,
						'parent_id' => $this->db->get_where('category', array('cat_name' => $cat_major))->row()->cat_id,
						'level' => 3,
						'count' => 1,
						'created_time' => date("Y-m-d H:i:s")
					);
				$this->db->insert('category', $cat_data);
			}
			else if($check_subject_exists_category->num_rows == 1){
				$new_count = $this->db->get_where('category', array('cat_name' => $cat_subject))->row()->count + 1;
				$this->db->where('cat_name', $cat_subject);
				$this->db->update('category', array('count' => $new_count));
			}


			//add chapter
			$check_chapter_exists = $this->db->get_where('user_category', array('cat_name' => $cat_chapter, 'level' => 4, 'cat_owner' => $cat_owner));
			if ($check_chapter_exists->num_rows == 0) {
				$user_cat_data['cat_name'] = $cat_chapter;
				$user_cat_data['parent_id']= $this->get_category_id($cat_owner, $cat_subject, 3);
				$user_cat_data['level'] =4;
				$this->db->insert('user_category', $user_cat_data);
			}
				//update category
			$check_chapter_exists_category = $this->db->get_where('category', array('cat_name' => $cat_chapter, 'level' => 4));
			if($check_chapter_exists_category->num_rows == 0){
				$cat_data = array(
						'cat_id' => "",
						'cat_name' => $cat_chapter,
						'parent_id' => $this->db->get_where('category', array('cat_name' => $cat_subject))->row()->cat_id,
						'level' => 4,
						'count' => 1,
						'created_time' => date("Y-m-d H:i:s")
					);
				$this->db->insert('category', $cat_data);
			}
			else if($check_chapter_exists_category->num_rows == 1){
				$new_count = $this->db->get_where('category', array('cat_name' => $cat_chapter))->row()->count + 1;
				$this->db->where('cat_name', $cat_chapter);
				$this->db->update('category', array('count' => $new_count));
			}

			//user_knowledge table
			$data_user_knowledge = array(
					'user_knowledge_id' => "",
					'user_name' => $this->session->userdata('email'),
					'knowledge_id' => $knowledge_id,
					'level1_cat' => $cat_area,
					'level2_cat' => $cat_major,
					'level3_cat' => $cat_subject,
					'level4_cat' => $cat_chapter,
					'sharing_mode' => "",
					'created_time' => date("Y-m-d H:i:s")
				);
			$this->db->insert('user_knowledge', $data_user_knowledge);


			//insert to knowledge_cat table
			$cat_id = $this->get_category_id($this->session->userdata('email'), $cat_chapter, 4);
			$knowledge_cat_data = array(
					'knowledge_cat_id' => "",
					'knowledge_id' => $knowledge_id,
					'cat_id' => $cat_id,
					'created_time' => date("Y-m-d H:i:s")
				);
			$this->db->insert('knowledge_cat', $knowledge_cat_data);
		}

		public function get_all_major(){
			$this->db->where('level', 2);
			$this->db->order_by("cat_name");
			return $this->db->get('category')->result();
		}

		public function get_all_area(){
			$this->db->where('level', 1);
			$this->db->order_by("cat_name");
			return $this->db->get('category')->result();
		}

		public function get_all_subject(){
			$this->db->where('level', 3);
			$this->db->order_by("cat_name");
			return $this->db->get('category')->result();
		}

		public function get_all_chapter(){
			$this->db->where('level', 4);
			$this->db->order_by("cat_name");
			return $this->db->get('category')->result();
		}

		public function get_knowledge_id($knowledge_description, $user_name){
			$this->db->where('knowledge_owner', $user_name);
			$this->db->where('knowledge_description', $knowledge_description);
			$query = $this->db->get('knowledge')->row();
			return $query->knowledge_id;
		}

		public function get_knowledge_owner($knowledge_id){
			return $this->db->get_where('knowledge', array('knowledge_id' => $knowledge_id))->row()->knowledge_owner;
		}

		public function get_category_id($owner, $cat_name, $level){
			$query_array = array('cat_owner'=> $owner, 'cat_name'=> $cat_name, 'level'=>$level);
			$this->db->where($query_array);
			$query = $this->db->get('user_category')->row();
			return $query->cat_id;
		}

		public function count_knowledge($email){
			return $this->db->get_where('user_knowledge', array('user_name' => $email))->num_rows();
		}

		public function get_knowledge($email){
			$this->db->select('*');
			$this->db->from('knowledge');
			$this->db->join('user_knowledge', 'knowledge.knowledge_id = user_knowledge.knowledge_id');
			$this->db->join('knowledge_cat', 'knowledge.knowledge_id = knowledge_cat.knowledge_id');
			$this->db->where('user_knowledge.user_name', $email);
			$this->db->order_by('user_knowledge.created_time', 'desc');
			$query = $this->db->get()->result();
			return $query;
		}

		public function get_knowledge_pagination($email, $limit, $start){
			$this->db->select('*');
			$this->db->from('user_knowledge');
			$this->db->join('knowledge', 'knowledge.knowledge_id = user_knowledge.knowledge_id');
			$this->db->join('knowledge_cat', 'knowledge.knowledge_id = knowledge_cat.knowledge_id');
			$this->db->where('user_knowledge.user_name', $email);
			$this->db->limit($limit,$start);
			$this->db->order_by('user_knowledge.created_time', 'desc');
			$query = $this->db->get()->result();
			return $query;
		}

		public function get_knowledge_by_id($knowledge_id){
			return $this->db->get_where('knowledge', array('knowledge_id' => $knowledge_id))->row();
		}

		public function get_user_knowledge_by_knowledge_id($knowledge_id){
			return $this->db->get_where('user_knowledge', array('knowledge_id' => $knowledge_id))->row();
		}

		public function get_knowledge_item($knowledge_id){
			return $this->db->get_where('knowledge_item', array('knowledge_id' => $knowledge_id))->result();
		}

		public function get_category_of_a_user($email){
			$this->db->where('cat_owner', $email);
			$query = $this->db->get('user_category')->result();
			return $query;
		}

		public function delete_knowledge_from_db($knowledge_id, $user_name){

			//delete user_knowledge
			$this->db->where(array('knowledge_id' => $knowledge_id, 'user_name' => $user_name));
			$this->db->delete('user_knowledge');

			//update knowledge table
			$this->db->where('knowledge_id', $knowledge_id);
			$new_count = ($this->db->get('knowledge')->row()->count) - 1;
			$this->db->where('knowledge_id', $knowledge_id);
			$this->db->update('knowledge', array('count' => $new_count));

			//delete knowledge_cat
			//$this->db->where('knowledge_id', $knowledge_id);
			//$this->db->delete('knowledge_cat');

		}

		// create json for tree
		public function gen_tree($email){
			mysql_connect('localhost', 'root', 'x63561628');
		    mysql_select_db('login_1026');

		    $categories = Category::getTopCategories($email);
		    //print_r($categories);
		    $str = json_encode($categories);
		    $str1 = ltrim ($str, '[');
		    $str2 = rtrim($str1, "]");

		    $file = "json/" . $email . ".json";
		    file_put_contents($file, $str2);

		    return true;

		}


		//update major dropdown list!!
		public function get_major_for_dropdown_list($area_name){
			$area_name = str_replace("%20", " ", $area_name);

			$this->db->where(array('cat_name' => $area_name, 'level' => 1));
			$area_id = $this->db->get('category')->row()->cat_id;

			$this->db->select('cat_id, cat_name');
			if($area_id != NULL){
				$this->db->where(array('level' => 2, 'parent_id' => $area_id));
			}

			$query = $this->db->get('category');

			$majors = array();

			if($query->result()){
				foreach ($query->result() as $major) {
					$majors[$major->cat_id] = $major->cat_name;
				}
				return $majors;
			}else{
				return FALSE;
			}
		}

		public function get_subject_for_dropdown_list($major_name){
			$major_name = str_replace("%20", " ", $major_name);

			$this->db->where(array('cat_name' => $major_name, 'level' => 2));
			$major_id = $this->db->get('category')->row()->cat_id;

			$this->db->select('cat_id, cat_name');
			if($major_id != NULL){
				$this->db->where(array('level' => 3, 'parent_id' => $major_id));
			}

			$query = $this->db->get('category');

			$subjects = array();

			if($query->result()){
				foreach ($query->result() as $subject) {
					$subjects[$subject->cat_id] = $subject->cat_name;
				}
				return $subjects;
			}else{
				return FALSE;
			}
		}

		public function get_chapter_for_dropdown_list($subject_name){
			$subject_name = str_replace("%20", " ", $subject_name);

			$this->db->where(array('cat_name' => $subject_name, 'level' => 3));
			$subject_id = $this->db->get('category')->row()->cat_id;

			$this->db->select('cat_id, cat_name');
			if($subject_id != NULL){
				$this->db->where(array('level' => 4, 'parent_id' => $subject_id));
			}

			$query = $this->db->get('category');

			$chapters = array();

			if($query->result()){
				foreach ($query->result() as $chapter) {
					$chapters[$chapter->cat_id] = $chapter->cat_name;
				}
				return $chapters;
			}else{
				return FALSE;
			}
		}

		public function count_knowledge_by_area($area){
			return $this->db->get_where('user_knowledge', array('level1_cat' => $area))->num_rows();
		}

		public function count_knowledge_by_major($major){
			return $this->db->get_where('user_knowledge', array('level2_cat' => $major))->num_rows();
		}

		public function count_knowledge_by_subject($subject){
			return $this->db->get_where('user_knowledge', array('level3_cat' => $subject))->num_rows();
		}

		public function count_knowledge_by_chapter($chapter){
			return $this->db->get_where('user_knowledge', array('level4_cat' => $chapter))->num_rows();
		}

		public function get_knowledge_by_area($area, $limit, $start){
			$this->db->select('*');
			$this->db->from('user_knowledge');
			$this->db->join('knowledge', 'knowledge.knowledge_id = user_knowledge.knowledge_id');
			$this->db->limit($limit, $start);
			$this->db->where(array('user_knowledge.level1_cat' => $area));
			return $this->db->get()->result();
		}

		public function get_knowledge_by_major($major, $limit, $start){
			$this->db->select('*');
			$this->db->from('user_knowledge');
			$this->db->join('knowledge', 'knowledge.knowledge_id = user_knowledge.knowledge_id');
			$this->db->limit($limit, $start);
			$this->db->where(array('user_knowledge.level2_cat' => $major));
			return $this->db->get()->result();
		}

		public function get_knowledge_by_subject($subject, $limit, $start){
			$this->db->select('*');
			$this->db->from('user_knowledge');
			$this->db->join('knowledge', 'knowledge.knowledge_id = user_knowledge.knowledge_id');
			$this->db->limit($limit, $start);
			$this->db->where(array('user_knowledge.level3_cat' => $subject));
			return $this->db->get()->result();
		}

		public function get_knowledge_by_chapter($chapter, $limit, $start){
			$this->db->select('*');
			$this->db->from('user_knowledge');
			$this->db->join('knowledge', 'knowledge.knowledge_id = user_knowledge.knowledge_id');
			$this->db->limit($limit, $start);
			$this->db->where(array('user_knowledge.level4_cat' => $chapter));
			return $this->db->get()->result();
		}

		public function get_knowledge_with_cat(){
			$this->db->select('*');
			$this->db->from('user_knowledge');
			$this->db->join('knowledge', 'knowledge.knowledge_id = user_knowledge.knowledge_id');
			return $this->db->get()->result();
		}

		public function make_knowledge_request($knowledge_id, $request_sender){
			$check_request_sent = $this->db->get_where('knowledge_request', array('knowledge_id' => $knowledge_id, 'request_sender' => $request_sender, 'request_receiver' => $this->get_knowledge_owner($knowledge_id)))->num_rows;
			if($check_request_sent == 0){
							$data_knowledge_request = array(
					'knowledge_request_id' => "",
					'request_sender' => $request_sender,
					'request_receiver' => $this->get_knowledge_owner($knowledge_id),
					'knowledge_id' => $knowledge_id,
					'approved' => 0,
					'read' => 0,
					'request_time' => date("Y-m-d H:i:s")
				);
			$this->db->insert('knowledge_request', $data_knowledge_request);
			}
		}

		public function get_notification_count($user_name){
			return $this->db->get_where('knowledge_request', array('request_receiver' => $user_name, 'read' => 0))->num_rows();
		}

		public function get_notification_details($user_name){
			$this->db->select('*');
			$this->db->from('knowledge_request');
			$this->db->join('knowledge', 'knowledge.knowledge_id = knowledge_request.knowledge_id');
			$this->db->join('user', 'knowledge_request.request_sender = user.email');
			$this->db->where(array('request_receiver' => $user_name, 'read' => 0));
			$this->db->order_by('knowledge_request.request_time', 'desc');
			return $this->db->get()->result();
		}
		
		public function accept_knowledge_request($knowledge_request_id){
			$this->db->where('knowledge_request_id', $knowledge_request_id);
			$this->db->update('knowledge_request', array('approved' => 1, 'read' => 1));

			//copy & paste the new knowledge
			$knowledge_request = $this->db->get_where('knowledge_request', array('knowledge_request_id' => $knowledge_request_id))->row();
			
			//get the user_knowledge
			$knowledge_to_copy = $this->db->get_where('user_knowledge', array('knowledge_id' => $knowledge_request->knowledge_id, 'user_name' => $knowledge_request->request_receiver))->row();
			//insert into db for new user
			$knowledge_for_new_user = array(
						'user_knowledge_id' => '',
						'user_name' => $knowledge_request->request_sender,
						'knowledge_id' => $knowledge_request->knowledge_id,
						'level1_cat' => $knowledge_to_copy->level1_cat,
						'level2_cat' => $knowledge_to_copy->level2_cat,
						'level3_cat' => $knowledge_to_copy->level3_cat,
						'level4_cat' => $knowledge_to_copy->level4_cat,
						'sharing_mode' => 'public',
						'created_time' => date("Y-m-d H:i:s")
					);
			$this->db->insert('user_knowledge', $knowledge_for_new_user);

			//update user category
				//level 1 category
			if( $this->db->get_where('user_category', array('cat_name' => $knowledge_to_copy->level1_cat, 'cat_owner' => $knowledge_request->request_sender))->num_rows == 0 ){
				$insert_level1_data = array(
						'cat_id' => '',
						'cat_name' => $knowledge_to_copy->level1_cat,
						'parent_id' => $this->db->get_where('user_category', array('cat_name' => $knowledge_request->request_sender))->row()->cat_id,
						'level' => 1,
						'cat_owner' => $knowledge_request->request_sender,
						'created_time' => date("Y-m-d H:i:s")
					);
				$this->db->insert('user_category', $insert_level1_data);
			}

				//level 2 category
			if( $this->db->get_where('user_category', array('cat_name' => $knowledge_to_copy->level2_cat, 'cat_owner' => $knowledge_request->request_sender))->num_rows == 0 ){
				$insert_level2_data = array(
						'cat_id' => '',
						'cat_name' => $knowledge_to_copy->level2_cat,
						'parent_id' => $this->db->get_where('user_category', array('cat_name' => $knowledge_to_copy->level1_cat, 'cat_owner' => $knowledge_request->request_sender))->row()->cat_id,
						'level' => 2,
						'cat_owner' => $knowledge_request->request_sender,
						'created_time' => date("Y-m-d H:i:s")
					);
				$this->db->insert('user_category', $insert_level2_data);
			}

				//level 3 category
			if( $this->db->get_where('user_category', array('cat_name' => $knowledge_to_copy->level3_cat, 'cat_owner' => $knowledge_request->request_sender))->num_rows == 0 ){
				$insert_level3_data = array(
						'cat_id' => '',
						'cat_name' => $knowledge_to_copy->level3_cat,
						'parent_id' => $this->db->get_where('user_category', array('cat_name' => $knowledge_to_copy->level2_cat, 'cat_owner' => $knowledge_request->request_sender))->row()->cat_id,
						'level' => 3,
						'cat_owner' => $knowledge_request->request_sender,
						'created_time' => date("Y-m-d H:i:s")
					);
				$this->db->insert('user_category', $insert_level3_data);
			}

				//level 4 category
			if( $this->db->get_where('user_category', array('cat_name' => $knowledge_to_copy->level4_cat, 'cat_owner' => $knowledge_request->request_sender))->num_rows == 0 ){
				$insert_level4_data = array(
						'cat_id' => '',
						'cat_name' => $knowledge_to_copy->level4_cat,
						'parent_id' => $this->db->get_where('user_category', array('cat_name' => $knowledge_to_copy->level3_cat, 'cat_owner' => $knowledge_request->request_sender))->row()->cat_id,
						'level' => 4,
						'cat_owner' => $knowledge_request->request_sender,
						'created_time' => date("Y-m-d H:i:s")
					);
				$this->db->insert('user_category', $insert_level4_data);
			}
		}

		public function reject_knowledge_request($knowledge_request_id){
			$this->db->where('knowledge_request_id', $knowledge_request_id);
			$this->db->update('knowledge_request', array('read' => 1));
		}
		


	}//end of the class

	class Category{
	    /**
	     * The information stored in the database for each category
	     */
	    public $cat_id;
	    public $parent_id;
	    public $cat_name;
	    public $level;
	    public $cat_owner;

	    // The child categories
	    public $children;

	    public function __construct()
	    {	
	  
	        // Get the child categories when we get this category
	        $this->getChildCategories();
	    }

	    /**
	     * Get the child categories
	     * @return array
	     */
	    public function getChildCategories()
	    {
	        if ($this->children) {
	            return $this->children;
	        }
	        return $this->children = self::getCategories("parent_id = {$this->cat_id}");
	    }

	    ////////////////////////////////////////////////////////////////////////////


	    /**
	     * The top-level categories (i.e. no parent)
	     * @return array
	     */
	    public static function getTopCategories($email)
	    {
	        return self::getCategories('cat_name = \'' . $email . '\'');
	    }

	    /**
	     * Get categories from the database.
	     * @param string $where Conditions for the returned rows to meet
	     * @return array
	     */
	    public static function getCategories($where = '')
	    {
	        if ($where) $where = " WHERE $where";
	        $result = mysql_query("SELECT * FROM user_category$where");

	        $categories = array();
	        while ($category = mysql_fetch_object($result, 'Category'))
	            $categories[] = $category;

	        mysql_free_result($result);
	        return $categories;
	    }
	}





?>