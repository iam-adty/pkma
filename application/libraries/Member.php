<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Member
{
	private $CI;
	private $_message = '';
	private $_data = array();
	private $_status_option = array(
		'active', 'pending', 'blocked'
	);
	private $_limit = 10;

	public function __construct($init = array())
	{
		$this->CI =& get_instance();
		$this->CI->load->model(array('model_user', 'model_log', 'model_user_level', 'model_level'));

		if(array_key_exists('data', $init))
			$this->_data = $init['data'];

		$this->_limit = input_get('limit', $this->_limit);
	}

	public function read()
	{
		$item = array();
		$identifier = array(
			'IN' => array(
				'level.name' => ['admin_pkma', 'member_pkma']
			)
		);

		$users = $this->CI->model_user->read($identifier, TRUE, input_get('page', 1), $this->_limit, input_get('search'));
		foreach ($users->result_array() as $key => $value)
		{
			$value['log_date'] = date_format(date_create($value['log_date']), 'l. F d, Y \a\t H:i:s');
			$item[] = $value;
		}

		return ['type' => 'array-list-to-parse', 'data' => $item];
	}

	public function create()
	{
		$this->_create_action();

		$data = array(
			'name' => set_value('name'),
			'username' => set_value('username'),
			'email' => set_value('email'),
			'image' => set_value('image'),
			'status' => set_value('status','pending'),
			'level' => set_value('level','pending'),
			'name_message' => text_danger(form_error('name')),
			'username_message' => text_danger(form_error('username')),
			'email_message' => text_danger(form_error('email')),
			'status_message' => text_danger(form_error('status')),
			'level_message' => text_danger(form_error('level')),
			'password_message' => text_danger(form_error('password')),
			'image_message' => text_danger(form_error('image')),
			'form_message' => $this->_message
		);

		foreach ($this->_status_option as $key => $value)
		{
			if($data['status'] == $value)
				$data['status_' . $value] = 'selected="selected"';
			else
				$data['status_' . $value] = '';
		}

		return ['type' => 'single-array-to-parse', 'data' => $data];
	}

	private function _create_action()
	{
		if(input_post('action') == 'create')
		{			
			if($this->CI->form_validation->run('dashboard/user/create'))
			{
				$this->CI->db->trans_start();

				$image = '';
				if($_FILES['image']['error'] == 0)
				{
					$this->CI->load->library('image');
					$upload_image = $this->CI->image->upload('image');
					if($upload_image['status'])
					{
						$image = $upload_image['data']['file_name'];
						$crop_image = $this->CI->image->crop($upload_image['data'], $image, ['create_new' => TRUE, 'width' => 200, 'height' => 200]);
					}
				}

				//insert data to table post
				$data_user = array(
					'name' => input_post('name'),
					'username' => input_post('username'),
					'email' => input_post('email'),
					'password' => sha1(input_post('password')),
					'status' => input_post('status'),
					'image' => $image
				);
				$insert_user = $this->CI->model_user->create($data_user, TRUE);
				$user_id = $insert_user['status'] ? $insert_user['id'] : 0;
				//
				
				//insert data to table log (loggin post)
				$data_log = array(
					'parent' => 0,
					'table_name' => 'user',
					'table_id' => $user_id,
					'type' => 'create',
					'description' => '',
					'date' => date('Y-m-d H:i:s'),
					'user_id' => $this->CI->session->userdata('blog_user')['id']
				);
				$insert_user_log = $this->CI->model_log->create($data_log, TRUE);
				$user_log_id = $insert_user_log['status'] ? $insert_user_log['id'] : 0;
				//

				//insert data to table user_post_level
				$data_user_level = array(
					'user_id' => $user_id,
					'level_id' => input_post('level'),
				);
				$insert_user_level = $this->CI->model_user_level->create($data_user_level, TRUE);
				$user_level_id = $insert_user_level['status'] ? $insert_user_level['id'] : 0;
				//

				//insert data to table log (logging user_post_level)
				$data_log = array(
					'parent' => $user_log_id,
					'table_name' => 'user_level',
					'table_id' => $user_level_id,
					'type' => 'create',
					'description' => '',
					'date' => date('Y-m-d H:i:s'),
					'user_id' => $this->CI->session->userdata('blog_user')['id']
				);
				$insert_user_level_log = $this->CI->model_log->create($data_log, TRUE);
				$user_level_log_id = $insert_user_level_log['status'] ? $insert_user_level_log['id'] : 0;
				//

				$this->CI->db->trans_complete();
				if($this->CI->db->trans_status() === FALSE)
				{
					$this->_message = alert_danger('Error occured when creating new user!<br>Code : ' . $this->CI->db->error()['code'] . '<br>Message : ' . $this->CI->db->error()['message'], 'text-center');
				}
				else
				{
					$this->CI->session->set_flashdata('message', alert_success('New user created!', 'text-center'));
						redirect('dashboard/user');
				}
			}
			else
				$this->_message = alert_danger('Error occured while creating new user!', 'text-center');
		}
	}

	public function update()
	{
		$id = $this->CI->uri->segment(5);
		$user = $this->CI->model_user->read(array(
			'AND' => array(
				'user.id' => $id
			)
		), TRUE, 1, 1);

		if(is_null($user->row_array()))
		{
			$this->CI->session->set_flashdata('message', alert_danger('You don\'t have permission to update the member', 'text-center'));
			redirect('dashboard/custom/member');
		}
		else
		{
			$this->_update_action($user->row());
			$user = $user->row_array();
		}

		$data = array(
			'id' => $id,
			'name' => set_value('name', $user['user_name']),
			'email' => set_value('email', $user['user_email']),
			'username' => set_value('username', $user['user_username']),
			'status' => set_value('status', $user['user_status']),
			'level' => set_value('level', $user['user_level_id']),
			'image' => set_value('image', $user['user_image'] != '' ? base_url('upload/image/' . $user['user_image']) : $user['user_image']),
			'name_message' => text_danger(form_error('name')),
			'username_message' => text_danger(form_error('username')),
			'status_message' => text_danger(form_error('status')),
			'level_message' => text_danger(form_error('level')),
			'image_message' => text_danger(form_error('image')),
			'email_message' => text_danger(form_error('email')),
			'password_message' => text_danger(form_error('password')),
			'form_message' => $this->_message
		);

		foreach ($this->_status_option as $key => $value)
		{
			if($data['status'] == $value)
				$data['status_' . $value] = 'selected="selected"';
			else
				$data['status_' . $value] = '';
		}

		return ['type' => 'single-array-to-parse', 'data' => $data];
	}

	private function _update_action($user)
	{
		if(input_post('action') == 'update')
		{
			$this->CI->form_validation->set_rules('username', 'Username', array(
				'trim', 'required', array(
					'user_username_update_check', function()
					{
						$user = $this->CI->model_user->read(array(
							'AND' => array(
								'username' => input_post('username')
							)
						), TRUE, 1, 1);

						if($user->num_rows() > 0)
						{
							if($user->row()->user_id == input_post('id'))
								return TRUE;
							else
							{
								$this->CI->form_validation->set_message('user_username_update_check', 'Username already exist');
								return FALSE;
							}
						}
						else
							return TRUE;
					}
				)
			));
			$this->CI->form_validation->set_rules('email', 'Email', array(
				'trim', 'required', array(
					'user_email_update_check', function()
					{
						$user = $this->CI->model_user->read(array(
							'AND' => array(
								'email' => input_post('email')
							)
						), TRUE, 1, 1);

						if($user->num_rows() > 0)
						{
							if($user->row()->user_id == input_post('id'))
								return TRUE;
							else
							{
								$this->CI->form_validation->set_message('user_email_update_check', 'Email already exist');
								return FALSE;
							}
						}
						else
							return TRUE;
					}
				)
			));
			$this->CI->form_validation->set_rules('name', 'Name', array(
				'trim', 'required'
			));
			$this->CI->form_validation->set_rules('status', 'Status', array(
				'trim', 'required'
			));

			if(input_post('password', '') != '')
			{
				$this->CI->form_validation->set_rules('password', 'Password', array(
					'trim', 'required'
				));
			}

			if($this->CI->form_validation->run())
			{
				$image = '';
				if($_FILES['image']['error'] == 0)
				{
					$upload_image = $this->CI->image->upload('image');
					if($upload_image['status'])
					{
						$image = $upload_image['data']['file_name'];
						$crop_image = $this->CI->image->crop($upload_image['data'], $image, ['create_new' => TRUE, 'width' => 200, 'height' => 200]);
					}
				}
				else if(input_post('remove_image') == 'true')
				{
					$image = '';
				}

				$this->CI->db->trans_start();

				//update post
				$data_user = array(
					'name' => input_post('name'),
					'username' => input_post('username'),
					'status' => input_post('status'),
					'email' => input_post('email'),
					'image' => $image
				);

				if(input_post('password', '') != '')
					$data_user['password'] = sha1(input_post('password'));

				$update_user = $this->CI->model_user->update($data_user, input_post('id'), FALSE, TRUE);
				//

				//create log for post update
				$data_log = array(
					'parent' => 0,
					'table_name' => 'user',
					'table_id' => input_post('id'),
					'type' => 'update',
					'description' => '',
					'date' => date('Y-m-d H:i:s'),
					'user_id' => $this->CI->session->userdata('blog_user')['id']
				);
				$create_user_log = $this->CI->model_log->create($data_log, TRUE);
				$user_log_id = $create_user_log['status'] ? $create_user_log['id'] : 0;
				//

				//update user_level if any
				
				//

				//create user_level log
				
				//

				//update user_post_access if any
				//

				//create user_post_access log
				//

				$this->CI->db->trans_complete();
				if($this->CI->db->trans_status() === FALSE)
				{
					$this->_message = alert_danger('Error occured while updating page!<br>Code : ' . $this->CI->db->error()['code'] . '<br>Message : ' . $this->CI->db->error()['message'], 'text-center');
				}
				else
				{
					$this->_message = alert_success('Page updated!', 'text-center');
				}
			}
			else
				$this->_message = alert_danger('Error occured while updating user!', 'text-center');
		}
	}

	public function delete()
	{
		$id = $this->CI->uri->segment(5);

		$page = $this->CI->model_user->count(array(
			'AND' => array(
				'post.id' => $id,
				'post.type' => 'page'
			),
			'AND_GROUP' => array(
				'IN' => array(
					'access_user_table.name' => array(
						'dashboard_page_delete', 'dashboard_page_delete_own', 'dashboard_page_delete_other'
					)
				),
				'OR_IN' => array(
					'access_level_table.name' => array(
						'dashboard_page_delete', 'dashboard_page_delete_own', 'dashboard_page_delete_other'
					)
				)
			),
			'NOT_GROUP' => array(
				'IN' => array(
					'access_level_table.name' => array(
						'revoke_dashboard_page_delete', 'revoke_dashboard_page_delete_own', 'revoke_dashboard_page_delete_other'
					),
					'access_user_table.name' => array(
						'revoke_dashboard_page_delete', 'revoke_dashboard_page_delete_own', 'revoke_dashboard_page_delete_other'
					)
				)
			)
		), TRUE);
		
		if($page == 0)
		{
			$this->CI->session->set_flashdata('message', alert_danger('Cannot find page. Delete fail!'));
			redirect('dashboard/page');
		}

		$this->CI->db->trans_start();

		//delete post
		$delete_post = $this->CI->model_user->delete($id, FALSE, TRUE);
		//

		//delete post log
		$delete_post_log = $this->CI->model_log->delete(array(
			'AND' => array(
				'table_id' => $id,
				'table_name' => 'post'
			)
		), TRUE, TRUE);
		//

		//delete user_post_level
		$user_post_level = $this->CI->model_user_post_level->read(array(
			'AND' => array('post_id' => $id)
		), TRUE, 0, 0);
		$user_post_level_id = array();
		foreach ($user_post_level->result_array() as $key => $value)
		{
			$user_post_level_id[] = $value['id'];
		}
		$delete_user_post_level = $this->CI->model_user_post_level->delete(array(
			'column' => 'post_id', 'value' => $id
		), FALSE, TRUE);
		//

		//delete user_post_level log
		$delete_user_post_level_log = $this->CI->model_log->delete(array(
			'AND' => array('table_name' => 'user_post_level'),
			'IN' => array('table_id' => $user_post_level_id)
		), TRUE, TRUE);
		//

		//delete user_post_access
		//

		//delete user_post_access log
		//

		$this->CI->db->trans_complete();
		if($this->CI->db->trans_status() === FALSE)
		{
			$this->CI->session->set_flashdata('message', alert_danger('Error occured while deleting page!<br>Code : ' . $this->CI->db->error()['code'] . '<br>Message : ' . $this->CI->db->error()['message'], 'text-center'));
		}
		else
		{
			$this->CI->session->set_flashdata('message', alert_success('Page deleted !', 'text-center'));
		}
		redirect('dashboard/page');
	}

	private function _count()
	{
		$identifier = array();

		return $this->CI->model_user->count($identifier, TRUE, input_get('search'));
	}

	public function count()
	{
		return ['type' => 'number', 'data' => $this->_count()];
	}

	public function pagination($data = array())
	{
		$this->CI->load->library('pagination');
        $config['base_url'] = site_url($this->CI->uri->uri_string());
        $config['total_rows'] = $this->_count();
        $config['per_page'] = array_key_exists('per_page', $data) ? $data['per_page'] : $this->_limit;
        $config['num_links'] = array_key_exists('num_links', $data) ? $data['num_links'] : 10;
        $config['use_page_numbers'] = TRUE;
        $config['reuse_query_string'] = TRUE;
        $config['query_string_segment'] = 'page';
        $config['page_query_string'] = TRUE;
        
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tag_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tag_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tag_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tag_close'] = "</li>";
        $config['first_link'] = "&lsaquo;";
        $config['prev_link'] = "&lt;";
        $config['next_link'] = "&gt;";
        $config['last_link'] = "&rsaquo;";
        $this->CI->pagination->initialize($config);
        return ['type' => 'string', 'data' => $this->CI->pagination->create_links()];
	}

	public function read_level($data = array())
	{
		$item = array();
		$identifier = array();

		$level = 0;
		if(array_key_exists('selected_level', $data))
			$level = $data['selected_level'];

		$levels = $this->CI->model_level->read($identifier, TRUE, 0, 0);
		foreach ($levels->result_array() as $key => $value)
		{
			$value['selected'] = '';
			if($value['id'] == set_value('level', $level))
				$value['selected'] = 'selected="selected"';

			foreach ($value as $key_value => $value_value)
			{
				$value['level_' . $key_value] = $value_value;
				unset($value[$key_value]);
			}
			$item[] = $value;
		}

		return ['type' => 'array-list-to-parse', 'data' => $item];
	}

}