<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
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
			'dashboard_url' => base_url('dashboard'),
			'blog_csrf_name' => $this->security->get_csrf_token_name(),
			'blog_csrf_hash' => $this->security->get_csrf_hash(),
			'blog_session_user_name' => $this->session->userdata('blog_user')['name'],
			'message' => $this->session->flashdata('message') . $this->_message,
			'search' => input_get('search')
		);

		$this->load->library('template', [
			'type' => 'dashboard', 'data' => $this->_data
		]);
	}

	private function _session_check()
	{
		$access = FALSE;
		if ($this->session->has_userdata('blog_user'))
			$access = TRUE;

		if (!$access) {
			$this->session->set_flashdata('message', alert_danger('Please login with your account before accessing dashboard', 'text-center'));
			$redirect = '';
			$uri = $this->uri->uri_string();
			if($uri != '')
				$redirect = '?redirect=' . $uri;
			redirect('dashboard/login' . $redirect);
		}
	}

	public function login()
	{
		if($this->session->has_userdata('blog_user'))
			redirect('dashboard');

		if ($this->input->post('action') == 'login')
			$this->_login_auth();

		$this->load->helper('form');

		$data = array_merge($this->_data, array(
			'username' => set_value('username'),
			'password' => '',
			'username_message' => text_danger(form_error('username'), 'text-center'),
			'password_message' => text_danger(form_error('password'), 'text-center')
		));

		$this->template->parse('login', $data);
	}

	private function _login_auth()
	{
		$this->load->model('model_user');

		if ($this->form_validation->run() == FALSE)
			$this->_message = alert_danger('Error occured when logging you in!', 'text-center');
		else
		{
			$username = input_post('username');
			$password = input_post('password');

			$where = array(
				'username' => $username,
				'password' => sha1($password)
			);

			$field = array(
				'user.id', 'user.username', 'user.name', 'user.email', 'user.status', 'GROUP_CONCAT(DISTINCT level.name) AS level', 'GROUP_CONCAT(DISTINCT access.name) AS access'
			);

			$login = $this->model_user->get($where, $field);

			if ($login->num_rows() > 0)
			{
				$user = $login->row_array();
				if(in_array('dashboard_login', explode(',', $user['access'])))
				{
					switch ($user['status'])
					{
						case 'active':
							$user['login_time'] = date('Y-m-d H:i:s');
							$user['login_status'] = TRUE;
							$user['level'] = explode(',', $user['level']);
							$user['access'] = explode(',', $user['access']);
							$this->session->set_userdata('blog_user', $user);
							redirect(input_get('redirect', 'dashboard'));
							break;
						
						default:
							$this->_message = alert_danger('Your account status is "'.$user['status'].'". Can\'t login!', 'text-center');
							break;
					}
				}
				else
					$this->_message = alert_danger('Oops! Sorry, you don\'t have permission to perform this action', 'text-center');
			}
			else
				$this->_message = alert_danger('Oops! Wrong username or password!', 'text-center');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('blog_user');
		$this->session->sess_destroy();
		redirect('dashboard/login');
	}

	public function index()
	{
		$this->_session_check();
		if(!in_array('dashboard_view', $this->session->userdata('blog_user')['access']))
			redirect(base_url());
		$data = array_merge($this->_data);
		$this->template->parse('index', $data);
	}

	public function page()
	{
		$this->_session_check();

		$data = array_merge($this->_data);
		$sub_page = $this->uri->segment(3);
		if($sub_page != '')
		{
			if(!in_array('dashboard_page_' . $sub_page, $this->session->userdata('blog_user')['access']))
				redirect('dashboard/page');

			$data['template_page/index'] = '{template_page/'. $sub_page .'}';
		}
		else
		{
			if(!in_array('dashboard_page_view', $this->session->userdata('blog_user')['access']))
			{
				$this->session->set_flashdata('message', alert_danger('You don\'t have access to list pages'));
				redirect('dashboard');
			}
		}
		
		$this->template->parse('page', $data);
	}

	public function post()
	{
		$this->_session_check();

		$data = array_merge($this->_data);
		$sub_page = $this->uri->segment(3);
		if($sub_page != '')
		{
			if(!in_array('dashboard_post_' . $sub_page, $this->session->userdata('blog_user')['access']))
				redirect('dashboard/post');

			$data['template_post/index'] = '{template_post/'. $sub_page .'}';
		}
		else
		{
			if(!in_array('dashboard_post_view', $this->session->userdata('blog_user')['access']))
			{
				$this->session->set_flashdata('message', alert_danger('You don\'t have access to list post'));
				redirect('dashboard');
			}
		}
		
		$this->template->parse('post', $data);
	}

	public function category()
	{
		$this->_session_check();

		$data = array_merge($this->_data);
		$sub_page = $this->uri->segment(3);
		if($sub_page != '')
		{
			if(!in_array('dashboard_category_' . $sub_page, $this->session->userdata('blog_user')['access']))
				redirect('dashboard/category');

			$data['template_category/index'] = '{template_category/'. $sub_page .'}';
		}
		else
		{
			if(!in_array('dashboard_category_view', $this->session->userdata('blog_user')['access']))
			{
				$this->session->set_flashdata('message', alert_danger('You don\'t have access to list categories'));
				redirect('dashboard');
			}
		}
		
		$this->template->parse('category', $data);
	}

}