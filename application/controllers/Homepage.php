<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Homepage extends CI_Controller
{
	private $_config = array();
	private $_data = array();
	private $_message = '';

	public function __construct()
	{
		parent::__construct();

		// $this->output->enable_profiler(TRUE);

		if(input_post('action') == 'search')
			redirect($this->uri->uri_string() . '?search=' . input_post('search'));

		$this->config->load('blog', TRUE);
		$this->_config = $this->config->item('blog');

		$this->_data = array(
			'blog_csrf_name' => $this->security->get_csrf_token_name(),
			'blog_csrf_hash' => $this->security->get_csrf_hash(),
			'message' => $this->session->flashdata('message') . $this->_message,
			'search' => input_get('search')
		);

		$this->load->library('template', [
			'type' => 'blog', 'data' => $this->_data
		]);

		$menu = [
			'menu_home_active_class' => '',
			'menu_news_active_class' => '',
			'menu_blog_active_class' => '',
			'menu_brand_active_class' => ''
		];

		$this->_data = array_merge($this->_data, $menu);

	}

	public function _remap()
	{
		$uri = $this->uri->segment(1, 'index');
		$view = '_' . $uri;
		if(method_exists($this, $view))
			$this->$view();
		else
			show_404();
	}

	private function _index()
	{
		$data = [
			'menu_home_active_class' => 'active'
		];

		$this->template->parse('home', array_merge($this->_data, $data));
	}

	private function _news()
	{
		$data = [
			'menu_news_active_class' => 'active'
		];

		$this->template->parse('news', array_merge($this->_data, $data));
	}

	private function _blog()
	{
		$data = [
			'menu_blog_active_class' => 'active'
		];

		$this->template->parse('blog', array_merge($this->_data, $data));
	}

	private function _brand()
	{
		$data = [
			'menu_brand_active_class' => 'active'
		];

		$this->template->parse('brand', array_merge($this->_data, $data));
	}

	private function _register()
	{
		if(input_post('action') == 'register')
		{
			$this->form_validation->set_rules('name', 'Name', array(
				'trim', 'required'
			));
			$this->form_validation->set_rules('email', 'Email', array(
				'trim', 'required', 'valid_email'
			));
			$this->form_validation->set_rules('message', 'Message', array(
				'trim', 'required'
			));

			if($this->form_validation->run() === FALSE)
			{

			}
			else
			{
				$this->load->model(array('model_user', 'model_user_level', 'model_log'));

				$data_user = array(
					'name' => input_post('name'),
					'username' => random_string('alnum', 10),
					'email' => input_post('email'),
					'password' => sha1('1234'),
					'status' => 'pending'
				);
				$insert_user = $this->model_user->create($data_user, TRUE);
				$user_id = $insert_user['status'] ? $insert_user['id'] : 0;
				
				$data_log = array(
					'parent' => 0,
					'table_name' => 'user',
					'table_id' => $user_id,
					'type' => 'create',
					'description' => '',
					'date' => date('Y-m-d H:i:s'),
					'user_id' => 3
				);
				$insert_user_log = $this->model_log->create($data_log, TRUE);
				$user_log_id = $insert_user_log['status'] ? $insert_user_log['id'] : 0;

				$data_user_level = array(
					'user_id' => $user_id,
					'level_id' => 105010,
				);
				$insert_user_level = $this->model_user_level->create($data_user_level, TRUE);
				$user_level_id = $insert_user_level['status'] ? $insert_user_level['id'] : 0;

				$data_log = array(
					'parent' => $user_log_id,
					'table_name' => 'user_level',
					'table_id' => $user_level_id,
					'type' => 'create',
					'description' => '',
					'date' => date('Y-m-d H:i:s'),
					'user_id' => 3
				);
				$insert_user_level_log = $this->model_log->create($data_log, TRUE);
				$user_level_log_id = $insert_user_level_log['status'] ? $insert_user_level_log['id'] : 0;

				$this->db->trans_complete();
				if($this->db->trans_status() === FALSE)
				{
					$this->_message = alert_danger('Error occured when creating new user!<br>Code : ' . $this->db->error()['code'] . '<br>Message : ' . $this->db->error()['message'], 'text-center');
				}
				else
				{
					$this->session->set_flashdata('message', alert_success('New user created!', 'text-center'));
						redirect('index');
				}
			}

		}
		else
		{
			show_404();
		}
	}

}