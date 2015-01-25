<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function index()
	{
		$this->login();
		$this->load->helper('url');
	}

	
//=================================================================================================================
//=================================================================================================================
//																												  #
//													User Management												  #
//																												  #
//=================================================================================================================
//=================================================================================================================

	public function uitesting(){
		$this->load->view('header');
	}

	public function login(){
		$this->load->model('model_knowledge_management');
		$data['major_selection'] = $this->model_knowledge_management->get_all_major();



		if($this->session->userdata('is_logged_in') == 1 && $this->session->userdata('user_role') == 'student' ){
			$this->dashboard();
		}
		elseif ($this->session->userdata('is_logged_in') == 1 && $this->session->userdata('user_role') == 'teacher') {
			$this->teacher_dashboard();
		}
		else{
			$this->load->view('view_new_login_page', $data);
		}
		
	}
	
	public function load_old_login(){
		$this->load->model('model_knowledge_management');
		$data['major_selection'] = $this->model_knowledge_management->get_all_major();

		if($this->session->userdata('is_logged_in') == 1){
			$this->uitesting();
		}
		else{
			$this->load->view('view_login', $data);
		}
		
	}

	public function dashboard(){

		if($this->session->userdata('is_logged_in')){
			$this->load->view('view_dashboard');
		}
		else{
			$this->load->view('restricted');
		}
		
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('index.php/');
	}

	public function login_validation(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|callback_validate_credentials');
		$this->form_validation->set_rules('password', 'Password', 'required|md5');
		$this->form_validation->set_error_delimiters('<div class="text-error">', '</div>');


		//info for create knowledge
		$this->load->model('model_knowledge_management');
		$data['major_selection'] = $this->model_knowledge_management->get_all_major();
		$data['area_selection'] = $this->model_knowledge_management->get_all_area();
		$data['subject_selection'] = $this->model_knowledge_management->get_all_subject();
		$data['chapter_selection'] = $this->model_knowledge_management->get_all_chapter();
		$this->load->model('model_users');
		$data['user_major'] = $this->model_users->get_user_major($this->session->userdata('email'));


		if($this->form_validation->run()){

			$this->load->model('model_users');
			$data = array(
					'email' => $this->input->post('email'),
					'is_logged_in' => 1,
					'firstname' => $this->model_users->getFirstname($this->input->post('email')),
					'major' => $this->model_users->get_user_major($this->input->post('email')),
					'user_role' => $this->model_users->get_user_role($this->input->post('email'))
				);
			
			$this->session->set_userdata($data);
			if( $this->session->userdata('user_role') == 'teacher' ){
				redirect('index.php/main/teacher_dashboard');
			}
			else{
				$this->dashboard();
			}
		}
		else{
			$this->login();
		}
	}

	public function validate_credentials(){
		$this->load->model('model_users');

		if($this->model_users->can_log_in()){
			return true;
		}
		else{
			$this->form_validation->set_message('validate_credentials', 'Incorrect username/passowrd!');
			return false;
		}
	}
	
	public function register_validation(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'is_unique[user.email]');
		$this->form_validation->set_error_delimiters('<div class="text-error">', '</div>');
		$this->form_validation->set_message('is_unique', 'The email address already exists!!');

		if($this->form_validation->run()){


			$config = Array(		
		    'protocol' => 'smtp',
		    'smtp_host' => 'ssl://smtp.mail.yahoo.com',
		    'smtp_port' => 465,
		    'smtp_user' => 'evian720@yahoo.com.hk',
		    'smtp_pass' => '2forever',
		    'smtp_timeout' => '15',
		    'mailtype' => 'html', 
		    'charset' => 'iso-8859-1',
		    'newline' => '\r\n'
		);
			
			$key = md5(uniqid());
			$this->load->library('email', $config);
			$this->load->model('model_users');


			//construct the email
			if($this->model_users->add_temp_user($key)){
				$this->email->from('evian720@yahoo.com.hk', 'Organzing and Extending the Memory of Your Brain');
				$this->email->to($this->input->post('email'));
				$this->email->subject("Please confirm your account registration.");
				$message = "Dear " . $this->input->post('firstname') . ",<br><br>";
				//$this->email->set_newline("\r\n");
				$message .= "Thank you for signing up!<br>";
				$message .= "<a href='".base_url() . "index.php/main/register_user/$key'>Click here</a> to finish the registration!<br><br>";
				//$this->email->set_newline("\r\n");
				$message .= "Organzing and Extending the Memory of Your Brain<br>";
				$message .= "Support Team<br>";
				$message .= "<br>";
				//$this->email->set_newline("\r\n");
				$this->email->message($message);
				$this->email->set_newline("\r\n");
				if($this->email->send()){
					$this->load->view('email_sent');
				}
				else{
					show_error($this->email->print_debugger());
				}
			}
			else{
				echo "Cannot add to temp DB!";
			}
		}
		else{
			$this->login();
		}
	}

	public function register_user($key){
		$this->load->model('model_users');

		if($this->model_users->is_key_valid($key)){
			if( $newemail = $this->model_users->add_user($key)){
				$data = array(
						'email' => $newemail,
						'is_logged_in' => 1,
						'firstname' => $this->model_users->getFirstname($this->input->post('email'))
					);

				$this->session->set_userdata($data);
				redirect('index.php/main/dashboard');
			}
			else{
				echo "Fail to add user! Please try again!";
			}
		}
		else{
			echo "Invalid Key!!";
		}
	}

	public function teacher_dashboard(){
		$this->load->view('teacher_dashboard');
	}


//=================================================================================================================
//=================================================================================================================
//																												  #
//												Knowledge Management											  #
//																												  #
//=================================================================================================================
//=================================================================================================================

	public function create_knowledge(){
		//pass the selections to create knowledge view
		$this->load->model('model_knowledge_management');
		$data['major_selection'] = $this->model_knowledge_management->get_all_major();
		$data['area_selection'] = $this->model_knowledge_management->get_all_area();
		$data['subject_selection'] = $this->model_knowledge_management->get_all_subject();
		$data['chapter_selection'] = $this->model_knowledge_management->get_all_chapter();
		$this->load->model('model_users');
		$data['user_major'] = $this->model_users->get_user_major($this->session->userdata('email'));

		$this->load->view('view_create_knowledge', $data);
	}

	public function get_create_knowledge_detail(){
		//pass the selections to create knowledge view
		$this->load->model('model_knowledge_management');
		$data['major_selection'] = $this->model_knowledge_management->get_all_major();
		$data['area_selection'] = $this->model_knowledge_management->get_all_area();
		$data['subject_selection'] = $this->model_knowledge_management->get_all_subject();
		$data['chapter_selection'] = $this->model_knowledge_management->get_all_chapter();
		$this->load->model('model_users');
		$data['user_major'] = $this->model_users->get_user_major($this->session->userdata('email'));

		$this->load->view('modal_create_knowledge', $data);
	}


	public function submit_knowledge(){
		$this->load->model('model_knowledge_management');
		$this->model_knowledge_management->add_knowledge();
		redirect('index.php/main/dashboard');
	}

	public function view_knowledge(){
		$this->load->model('model_knowledge_management');
		// pagination
		$config['base_url'] = base_url() . "index.php/main/view_knowledge";
		$config['per_page'] = 3;
		$config['total_rows'] = $this->model_knowledge_management->count_knowledge($this->session->userdata('email'));
		$config['uri_segment'] = 3;

		$this->pagination->initialize($config);

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$result['my_knowledge'] = $this->model_knowledge_management->get_knowledge_pagination($this->session->userdata("email"), $config['per_page'], $page);
		//$result['my_knowledge'] = $this->model_knowledge_management->get_knowledge($this->session->userdata("email"));
		$result['my_category'] = $this->model_knowledge_management->get_category_of_a_user($this->session->userdata("email"));

		$result["links"] = $this->pagination->create_links();

		$this->load->view('view_timeline', $result);
		
	}

	public function delete_knowledge(){
		$this->load->model('model_knowledge_management');
		$knowledge_id = $this->input->get('knowledge_id');
		//$knowledge_id = $this->model_knowledge_management->get_knowledge_id($knowledge_to_delete, $this->session->userdata('email'));
		$this->model_knowledge_management->delete_knowledge_from_db($knowledge_id, $this->session->userdata('email'));
		redirect('index.php/main/view_knowledge');
	}

	public function view_tree(){
		$this->load->model('model_knowledge_management');
		if($this->model_knowledge_management->gen_tree($this->session->userdata('email')) == true)
			$this->load->view('view_knowledge_tree');
	}

	//ajax update dropdown list!!!
	public function get_major_dropdown_list($area_name){
		$this->load->model('model_knowledge_management');
		header('Content-Type: application/x-json; charset=utf-8');
 		echo(json_encode($this->model_knowledge_management->get_major_for_dropdown_list($area_name)));
	}

	public function get_subject_dropdown_list($major_name){
		$this->load->model('model_knowledge_management');
		header('Content-Type: application/x-json; charset=utf-8');
 		echo(json_encode($this->model_knowledge_management->get_subject_for_dropdown_list($major_name)));
	}

	public function get_chapter_dropdown_list($subject_name){
		$this->load->model('model_knowledge_management');
		header('Content-Type: application/x-json; charset=utf-8');
 		echo(json_encode($this->model_knowledge_management->get_chapter_for_dropdown_list($subject_name)));
	}
	//end of update dropdown list!!!


	public function view_knowledge_detail($knowledge_id){
		$this->load->model('model_knowledge_management');
		$data['knowledge'] = $this->model_knowledge_management->get_knowledge_by_id($knowledge_id);
		$data['user_knowledge'] = $this->model_knowledge_management->get_user_knowledge_by_knowledge_id($knowledge_id);
		$data['knowledge_items'] = $this->model_knowledge_management->get_knowledge_item($knowledge_id);
		$this->load->view('modal_knowledge_details', $data);
	}

	public function view_knowledge_others(){
		$this->load->model('model_knowledge_management');

		//pagination
		$config['base_url'] = base_url() . "index.php/main/view_knowledge_others";
		$config['per_page'] = 5;
		$config['uri_segment'] = 3;
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$config['total_rows'] = $this->model_knowledge_management->count_knowledge_by_area('Technology');
		$this->pagination->initialize($config);

		$data['user_category'] = $this->model_knowledge_management->get_category_of_a_user($this->session->userdata('email'));

		// create link for area
		$config['total_rows'] = $this->model_knowledge_management->count_knowledge_by_area('Technology');
		$this->pagination->initialize($config);

		$data['area_knowledge'] = $this->model_knowledge_management->get_knowledge_by_area('Technology', $config['per_page'], $page);
		$data['link1'] = $this->pagination->create_links();

		// create link for major
		$config['total_rows'] = $this->model_knowledge_management->count_knowledge_by_major($this->session->userdata('major'));
		$this->pagination->initialize($config);
		$data['major_knowledge'] = $this->model_knowledge_management->get_knowledge_by_major($this->session->userdata('major'), $config['per_page'], $page);
		$data['link2'] = $this->pagination->create_links();

		//get all area
		$data['area'] = $this->model_knowledge_management->get_all_area();
		$data['major'] = $this->model_knowledge_management->get_all_major();
		$data['subject'] = $this->model_knowledge_management->get_all_subject();
		$data['chapter'] = $this->model_knowledge_management->get_all_chapter();

		$this->load->view('view_knowledge_others', $data);
	}

	// update the knowledge based on area selection
	public function update_area_selection(){
		$option_selected = $this->input->post('optradio');
		$data['selected'] = $option_selected;

		$this->load->model('model_knowledge_management');

		//pagination
		$config['base_url'] = base_url() . "index.php/main/view_knowledge_others";
		$config['per_page'] = 5;
		$config['uri_segment'] = 3;
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$config['total_rows'] = $this->model_knowledge_management->count_knowledge_by_area($option_selected);
		$this->pagination->initialize($config);

		$data['user_category'] = $this->model_knowledge_management->get_category_of_a_user($this->session->userdata('email'));

		// create link for area
		$config['total_rows'] = $this->model_knowledge_management->count_knowledge_by_area($option_selected);
		$this->pagination->initialize($config);
		$data['knowledges'] = $this->model_knowledge_management->get_knowledge_by_area($option_selected, $config['per_page'], $page);
		$data['link1'] = $this->pagination->create_links();


		//get all area
		$data['area'] = $this->model_knowledge_management->get_all_area();

		$this->load->view('view_knowledge_others_update', $data);
	}

	// update the knowledge based on major selection
	public function update_major_selection(){
		$option_selected = $this->input->post('optradio');
		$data['selected'] = $option_selected;

		$this->load->model('model_knowledge_management');

		//pagination
		$config['base_url'] = base_url() . "index.php/main/view_knowledge_others";
		$config['per_page'] = 5;
		$config['uri_segment'] = 3;
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$config['total_rows'] = $this->model_knowledge_management->count_knowledge_by_major($option_selected);
		$this->pagination->initialize($config);

		$data['user_category'] = $this->model_knowledge_management->get_category_of_a_user($this->session->userdata('email'));

		// create link for major
		$this->pagination->initialize($config);
		$data['knowledges'] = $this->model_knowledge_management->get_knowledge_by_major($option_selected, $config['per_page'], $page);
		$data['link1'] = $this->pagination->create_links();


		//get all area
		$data['major'] = $this->model_knowledge_management->get_all_major();

		$this->load->view('view_knowledge_others_update', $data);
	}

	// update the knowledge based on subject selection
	public function update_subject_selection(){
		$option_selected = $this->input->post('optradio');
		$data['selected'] = $option_selected;

		$this->load->model('model_knowledge_management');

		//pagination
		$config['base_url'] = base_url() . "index.php/main/view_knowledge_others";
		$config['per_page'] = 5;
		$config['uri_segment'] = 3;
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$config['total_rows'] = $this->model_knowledge_management->count_knowledge_by_subject($option_selected);
		$this->pagination->initialize($config);

		$data['user_category'] = $this->model_knowledge_management->get_category_of_a_user($this->session->userdata('email'));

		// create link for major
		$this->pagination->initialize($config);
		$data['knowledges'] = $this->model_knowledge_management->get_knowledge_by_subject($option_selected, $config['per_page'], $page);
		$data['link1'] = $this->pagination->create_links();


		//get all subject
		$data['subject'] = $this->model_knowledge_management->get_all_subject();

		$this->load->view('view_knowledge_others_update', $data);
	}

	// update the knowledge based on chapter selection
	public function update_chapter_selection(){
		$option_selected = $this->input->post('optradio');
		$data['selected'] = $option_selected;

		$this->load->model('model_knowledge_management');

		//pagination
		$config['base_url'] = base_url() . "index.php/main/view_knowledge_others";
		$config['per_page'] = 5;
		$config['uri_segment'] = 3;
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$config['total_rows'] = $this->model_knowledge_management->count_knowledge_by_chapter($option_selected);
		$this->pagination->initialize($config);

		$data['user_category'] = $this->model_knowledge_management->get_category_of_a_user($this->session->userdata('email'));

		// create link for major
		$this->pagination->initialize($config);
		$data['knowledges'] = $this->model_knowledge_management->get_knowledge_by_chapter($option_selected, $config['per_page'], $page);
		$data['link1'] = $this->pagination->create_links();


		//get all subject
		$data['chapter'] = $this->model_knowledge_management->get_all_subject();

		$this->load->view('view_knowledge_others_update', $data);
	}

	public function view_knowledge_directory(){
		$this->load->model('model_knowledge_management');
		$data['knowledge'] = $this->model_knowledge_management->get_knowledge_with_cat();
		$this->load->view('view_knowledge_directory', $data);
	}

	
	// start of request system
	public function request_knowledge($knowledge_id){
		$this->load->model('model_knowledge_management');
		$this->model_knowledge_management->make_knowledge_request($knowledge_id, $this->session->userdata('email'));
	}

	public function refresh_header_count(){
		$this->load->model('model_knowledge_management');
		$data['notification_count'] = $this->model_knowledge_management->get_notification_count($this->session->userdata('email'));

		echo $data['notification_count'];
	}

	public function refresh_header_details(){
		$this->load->model('model_knowledge_management');
		$data['notifications'] = $this->model_knowledge_management->get_notification_details($this->session->userdata('email'));
		$this->load->view('view_notification', $data);
	}

	public function accept_knowledge_request($knowledge_request_id){
		$this->load->model('model_knowledge_management');
		$this->model_knowledge_management->accept_knowledge_request($knowledge_request_id);
		
	}
	
	public function reject_knowledge_request($knowledge_request_id){
		$this->load->model('model_knowledge_management');
		$this->model_knowledge_management->reject_knowledge_request($knowledge_request_id);
		
	}
	// end of request system
	
	
	
}