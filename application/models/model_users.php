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
						'major' => $row->major
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

	}

?>