<?php
	class Model_users extends CI_Model {
		public function can_log_in(){
			$this->db->where('email', $this->input->post('email'));
			$this->db->where('password', md5($this->input->post('password')));
			$query = $this->db->get('user');

			if($query->num_rows() == 1){
				return true;
			}
			else{
				return false;
			}
		}

		public function add_temp_user($key){
			$data = array(
				'user_id' => "",
				'email' => $this->input->post('email'),
				'password' => md5($this->input->post('password')),
				'first_name' => $this->input->post('firstname'),
				'last_name' => $this->input->post('lastname'),
				'major' => $this->input->post('major'),
				'user_role' => 'student',
				'temp_key' => $key
				);

			if($this->db->insert('temp_user', $data)){
				return true;
			}
			else{
				return false;
			}

		}

		public function is_key_valid($key){
			$this->db->where('temp_key', $key);
			$query = $this->db->get('temp_user');
			if($query->num_rows == 1){
				return true;
			}
			else{
				return false;
			}
		}

		public function add_user($key){
			$this->db->where('temp_key', $key);
			$temp_user = $this->db->get('temp_user');

			if($temp_user){
				$row = $temp_user->row();
				$data = array(
						'user_id' => "",
						'email' => $row->email,
						'password' => $row->password,
						'first_name' => $row->first_name,
						'last_name' => $row->last_name,
						'user_role' => 'student',
						'reputation' => 0,
						'major' => $row->major,
						'register_date' => date("Y-m-d H:i:s")
					);

				$query = $this->db->insert('user', $data);
			}

			if($query){
				$this->db->where('temp_key', $key);
				$this->db->delete('temp_user');

				//add level 0 category to DB
				$user_cat_data = array(
					'cat_id' => "",
					'cat_name' => $row->email,
					'parent_id' => "",
					'level' => 0,
					'cat_owner' => $row->email,
					'created_time' => date("Y-m-d H:i:s")
				);
				$this->db->insert('user_category', $user_cat_data);


				//add major to category
				$check_major_exists_category = $this->db->get_where('category', array('cat_name' => $row->major, 'level' => 2));
				if($check_major_exists_category->num_rows == 0){
					$cat_data = array(
							'cat_id' => "",
							'cat_name' => $row->major,
							'parent_id' => 0,
							'level' => 2,
							'count' => 1,
							'created_time' => date("Y-m-d H:i:s")
						);
					$this->db->insert('category', $cat_data);
				}

				return $row->email;
			}else{
				return false;
			}



		}

		public function getFirstname($email){
			$this->db->where('email', $email);
			$query = $this->db->get('user')->row();
			return $query->first_name;
		}

		public function getLastname($email){
			$this->db->where('email', $email);
			$query = $this->db->get('user')->row();
			return $query->last_name;
		}

		public function get_user_major($email){
			$this->db->where('email', $email);
			$query = $this->db->get('user')->row();
			return $query->major;
		}

		public function get_user_role($email){
			$this->db->where('email', $email);
			$query = $this->db->get('user')->row();
			return $query->user_role;
		}

		public function get_user_by_email($email){
			return $this->db->get_where('user', array('email' => $email))->row();
		}

		public function get_user_email_by_user_id($user_id){
			return $this->db->get_where('user', array('user_id'=>$user_id))->row()->email;
		}

		public function add_reputation($user_name, $adding_value){
			$current_reputation = $this->db->get_where('user', array('email'=>$user_name))->row()->reputation;
			$new_reputation = $current_reputation +  $adding_value;
			$this->db->where('email', $user_name);
			$this->db->update('user', array('reputation'=>$new_reputation));
		}

		public function get_knowledge_owner($knowledge_id){
			return $this->db->get_where('knowledge', array('knowledge_id' => $knowledge_id))->row()->knowledge_owner;
		}

		public function get_knowledge_user_name($knowledge_id){
			return $this->db->get_where('knowledge', array('knowledge_id' => $knowledge_id))->row()->user_name;
		}

		public function get_user_stat_knowledge($username){
			$this->db->where('user_name', $username);
			$this->db->from('knowledge');
			return $this->db->count_all_results();
		}

		public function get_user_stat_focusing_subject($username){
			$this->db->where(array('level'=>3, 'cat_owner'=>$username));
			$this->db->from('user_category');
			return $this->db->count_all_results();
		}

		public function get_user_stat_reputation($username){
			return $this->db->get_where('user', array('email'=>$username))->row()->reputation;
		}

		public function edit_firstname($username, $new_first_name){
			$this->db->where('email', $username);
			$this->db->update('user', array('first_name'=>$new_first_name));
		}

		public function edit_lastname($username, $new_last_name){
			$this->db->where('email', $username);
			$this->db->update('user', array('last_name'=>$new_last_name));
		}

		public function edit_major($username, $new_major){
			$this->db->where('email', $username);
			$this->db->update('user', array('major'=>$new_major));
		}

		public function update_available_majors_json(){
			$this->db->select("cat_name");
			$result = $this->db->get_where('category', array('level'=>2))->result();
			$result_array = array();

			foreach ($result as $row) {
				array_push($result_array, $row->cat_name);
			}

			$str = json_encode($result_array);
			
			$file = "json/available_majors.json";
		    file_put_contents($file, $str);
		}

		public function verify_password($username, $password){
			$this->db->where('email', $username);
			$this->db->where('password', md5($password));
			$query = $this->db->get('user');

			if($query->num_rows() == 1){
				return true;
			}
			else{
				return false;
			}
		}

		public function update_user_password($username, $new_password){
			$this->db->where('email', $username);
			$this->db->update('user', array('password' => md5($new_password)));
		}

		public function get_register_date($username){
			return substr($this->db->get_where('user', array('email'=>$username))->row()->register_date, 0, 10);
		}

		public function get_access_rights_by_user_name_as_array($email){
			$user_access_rights = $this->db->get_where('user_access_rights', array('email'=>$email))->result();

			$user_access_rights_array = array();
			foreach ($user_access_rights as $key => $value) {
				array_push($user_access_rights_array, $value->major);
			}

			return $user_access_rights_array;
		}


//=================================================================================================================
//=================================================================================================================
//																												  #
//													Admin Functions   											  #
//																												  #
//=================================================================================================================
//=================================================================================================================	

		public function get_user_list(){
			return $this->db->get('user')->result();
		}

		public function edit_user($email, $edit_field, $new_value){
			$this->db->where('email', $email);
			$this->db->update('user', array($edit_field=>$new_value));
		}

		public function get_access_rights(){
			return $this->db->get('user_access_rights')->result();
		}

		public function get_access_rights_by_user_id($user_id){
			$this->db->select("user_access_rights.major");
			$this->db->from('user_access_rights');
			$this->db->join('user', 'user_access_rights.email = user.email');
			$this->db->where('user.user_id', $user_id);
			return $this->db->get()->result();
		}

		public function submit_user_access_rights($email, $new_access_rights){
			$this->db->where('email', $email);
			$this->db->delete('user_access_rights');

			foreach ($new_access_rights as $key => $value) {
				$row = array(
						'right_id' => '',
						'email' => $email,
						'major' => $value,
						'created_time' => date("Y-m-d H:i:s")
					);
				$this->db->insert('user_access_rights', $row);
			}
		}

	}

?>