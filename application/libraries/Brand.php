<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Brand
{
	private $CI;
	private $_message = '';
	private $_data = array();
	private $_limit = 10;
	private $_temporary = array();
	private $_status_option = array(
		'pending', 'published'
	);

	public function __construct($init = array())
	{
		$this->CI =& get_instance();
		$this->CI->load->model(array('model_post', 'model_log', 'model_user_post_level', 'model_category', 'model_post_category', 'model_user_access'));

		if(array_key_exists('data', $init))
			$this->_data = $init['data'];

		$this->_limit = input_get('limit', $this->_limit);
	}

	public function read($config_data = array())
	{
		$item = array();

		$is_public = FALSE;
		if(array_key_exists('is_public', $config_data))
			$is_public = $config_data['is_public'];

		$page_identifier = array(
			'AND' => array(
				'post.type' => 'post',
				'category.id' => 8
			)
		);

		if(!$is_public)
		{
			$page_identifier = array_merge_recursive($page_identifier, array(
				'AND_GROUP' => array(
					'IN' => array(
						'access_user_table.name' => array(
							'dashboard_post_list', 'dashboard_post_list_own', 'dashboard_post_list_other'
						)
					),
					'OR_IN' => array(
						'access_level_table.name' => array(
							'dashboard_post_list', 'dashboard_post_list_own', 'dashboard_post_list_other'
						)
					)
				),
				'NOT_GROUP' => array(
					'IN' => array(
						'access_level_table.name' => array(
							'revoke_dashboard_post_list', 'revoke_dashboard_post_list_own', 'revoke_dashboard_post_list_other'
						),
						'access_user_table.name' => array(
							'revoke_dashboard_post_list', 'revoke_dashboard_post_list_own', 'revoke_dashboard_post_list_other'
						)
					)
				)
			));
		}
		else
		{
			$page_identifier = array_merge_recursive($page_identifier, array(
				'AND' => array(
					'post.status' => 'published'
				)
			));
		}

		$pages = $this->CI->model_post->read($page_identifier, TRUE, input_get('page', 1), $this->_limit, input_get('search'), $is_public);
		foreach ($pages->result_array() as $key => $value)
		{
			$image_data = json_decode($value['post_image'], TRUE);

			$value['post_content'] = rich_text_limiter($value['post_content'], 50);
			$value['log_date'] = date_format(date_create($value['log_date']), 'l. F d, Y \a\t H:i:s');
			$value['post_image'] = $image_data['image'] != '' ? $image_data['image'] : 'blank.jpg';
			$value['post_image_cropped'] = $image_data['image'] != '' ? 'cropped-' . $image_data['image'] : 'cropped-blank.jpg';
			$value['post_logo'] = $image_data['logo'] != '' ? $image_data['logo'] : 'blank.jpg';
			$value['post_logo_cropped'] = $image_data['logo'] != '' ? 'cropped-' . $image_data['logo'] : 'cropped-blank.jpg';
			$item[] = $value;
		}

		return ['type' => 'array-list-to-parse', 'data' => $item];
	}

	public function create()
	{
		$this->_create_action();

		$data = array(
			'content' => set_value('content'),
			'title' => set_value('title'),
			'content_message' => text_danger(form_error('content')),
			'title_message' => text_danger(form_error('title')),
			'image_message' => text_danger(form_error('image')),
			'logo_message' => text_danger(form_error('logo')),
			'form_message' => $this->_message
		);

		return ['type' => 'single-array-to-parse', 'data' => $data];
	}

	private function _create_action()
	{
		if(input_post('action') == 'create')
		{
			$this->CI->form_validation->set_rules('title', 'Title', array(
				'trim', 'required'
			));
			$this->CI->form_validation->set_rules('content', 'Content', array(
				'trim', 'required'
			));
			if($_FILES['image']['error'] != 0)
			{
				$this->CI->form_validation->set_rules('image', 'Image', array(
					'trim', 'required'
				));
			}
			if($_FILES['logo']['error'] != 0)
			{
				$this->CI->form_validation->set_rules('logo', 'Logo', array(
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

				$logo = '';
				if($_FILES['image']['error'] == 0)
				{
					$upload_logo = $this->CI->image->upload('logo');
					if($upload_logo['status'])
					{
						$logo = $upload_logo['data']['file_name'];
						$crop_logo = $this->CI->image->crop($upload_logo['data'], $logo, ['create_new' => TRUE, 'width' => 200, 'height' => 200]);
					}
				}

				$this->CI->db->trans_start();

				//insert data to table post
				$data_post = array(
					'title' => input_post('title'),
					'content' => input_post('content'),
					'type' => 'post',
					'image' => json_encode(array(
						'image' => $image,
						'logo' => $logo
					)),
					'status' => 'pending'
				);
				$insert_post = $this->CI->model_post->create($data_post, TRUE);
				$post_id = $insert_post['status'] ? $insert_post['id'] : 0;
				//
				
				//insert data to table log (loggin post)
				$data_log = array(
					'parent' => 0,
					'table_name' => 'post',
					'table_id' => $post_id,
					'type' => 'create',
					'description' => '',
					'date' => date('Y-m-d H:i:s'),
					'user_id' => $this->CI->session->userdata('blog_user')['id']
				);
				$insert_post_log = $this->CI->model_log->create($data_log, TRUE);
				$post_log_id = $insert_post_log['status'] ? $insert_post_log['id'] : 0;
				//

				//post category
				$data_post_category = array(
					'post_id' => $post_id,
					'category_id' => 8
				);
				$insert_post_category = $this->CI->model_post_category->create($data_post_category, TRUE);
				$post_category_id = $insert_post_category['status'] ? $insert_post_category['id'] : 0;
				//

				//post category log
				$data_log = array(
					'parent' => $post_log_id,
					'table_name' => 'post_category',
					'table_id' => $post_category_id,
					'type' => 'create',
					'description' => '',
					'date' => date('Y-m-d H:i:s'),
					'user_id' => $this->CI->session->userdata('blog_user')['id']
				);
				$insert_post_category_log = $this->CI->model_log->create($data_log, TRUE);
				$post_category_log_id = $insert_post_category_log['status'] ? $insert_post_category_log['id'] : 0;
				//

				//user_post_level
				$data_user_post_level_create = array(
					'user_id' => $this->CI->session->userdata('blog_user')['id'],
					'level_id' => '200',
					'post_id' => $post_id
				);
				$insert_user_post_level = $this->CI->model_user_post_level->create($data_user_post_level_create, TRUE);
				$user_post_level_id = $insert_user_post_level['status'] ? $insert_user_post_level['id'] : 0;
				//

				//insert data to table log (logging user_post_level)
				$data_log = array(
					'parent' => $post_log_id,
					'table_name' => 'user_post_level',
					'table_id' => $user_post_level_id,
					'type' => 'create',
					'description' => '',
					'date' => date('Y-m-d H:i:s'),
					'user_id' => $this->CI->session->userdata('blog_user')['id']
				);
				$insert_user_post_level_log = $this->CI->model_log->create($data_log, TRUE);
				$user_post_level_log_id = $insert_user_post_level_log['status'] ? $insert_user_post_level_log['id'] : 0;
				//
								
				//user_access
				$data_user_access_create = array(
					'user_id' => $this->CI->session->userdata('blog_user')['id'],
					'access_id' => '15520'
				);
				$insert_user_access = $this->CI->model_user_access->create($data_user_access_create, TRUE);
				$user_access_id = $insert_user_access['status'] ? $insert_user_access['id'] : 0;
				//

				//insert data to table log (logging user_post_level)
				$data_log = array(
					'parent' => $post_log_id,
					'table_name' => 'user_access',
					'table_id' => $user_access_id,
					'type' => 'create',
					'description' => '',
					'date' => date('Y-m-d H:i:s'),
					'user_id' => $this->CI->session->userdata('blog_user')['id']
				);
				$insert_user_access_log = $this->CI->model_log->create($data_log, TRUE);
				$user_access_log_id = $insert_user_access_log['status'] ? $insert_user_access_log['id'] : 0;
				//

				//revoke create brand again on session
				$session = $this->CI->session->userdata('blog_user');
                $session['access'] = array_merge($session['access'], array(
                    'revoke_dashboard_custom_brand_create'
                ));
                $this->CI->session->set_userdata('blog_user', $session);

				$this->CI->db->trans_complete();
				if($this->CI->db->trans_status() === FALSE)
				{
					$this->_message = alert_danger('Error occured when creating new post!<br>Code : ' . $this->CI->db->error()['code'] . '<br>Message : ' . $this->CI->db->error()['message'], 'text-center');
				}
				else
				{
					$this->CI->session->set_flashdata('message', alert_success('New post created!', 'text-center'));
						redirect('dashboard/custom/brand');
				}
			}
			else
				$this->_message = alert_danger('Error occured while creating new post!', 'text-center');
		}
	}

	public function update()
	{
		$id = $this->CI->uri->segment(5);
		$page = $this->CI->model_post->read(array(
			'AND' => array(
				'post.id' => $id,
				'post.type' => 'post',
				'category.id' => 8
			),
			'AND_GROUP' => array(
				'IN' => array(
					'access_user_table.name' => array(
						'dashboard_post_update', 'dashboard_post_update_own', 'dashboard_post_update_other'
					)
				),
				'OR_IN' => array(
					'access_level_table.name' => array(
						'dashboard_post_update', 'dashboard_post_update_own', 'dashboard_post_update_other'
					)
				)
			),
			'NOT_GROUP' => array(
				'IN' => array(
					'access_level_table.name' => array(
						'revoke_dashboard_post_update', 'revoke_dashboard_post_update_own', 'revoke_dashboard_post_update_other'
					),
					'access_user_table.name' => array(
						'revoke_dashboard_post_update', 'revoke_dashboard_post_update_own', 'revoke_dashboard_post_update_other'
					)
				)
			)
		), TRUE, 1, 1);

		if(is_null($page->row_array()))
		{
			$this->CI->session->set_flashdata('message', alert_danger('You don\'t have permission to update the post', 'text-center'));
			redirect('dashboard/custom/brand');
		}
		else
		{
			$page = $page->row_array();
			$this->_update_action($page);
		}

		$image = json_decode($page['post_image'], TRUE);

		$data = array(
			'id' => $id,
			'content' => set_value('content', $page['post_content']),
			'title' => set_value('title', $page['post_title']),
			'status' => set_value('status', $page['post_status']),
			'image' => set_value('image', $image['image']),
			'logo' => set_value('logo', $image['logo']),
			'content_message' => text_danger(form_error('content')),
			'title_message' => text_danger(form_error('title')),
			'status_message' => text_danger(form_error('status')),
			'image_message' => text_danger(form_error('image')),
			'logo_message' => text_danger(form_error('logo')),
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

	private function _update_action($current_data = array())
	{
		if(input_post('action') == 'update')
		{
			$this->CI->form_validation->set_rules('title', 'Title', array(
				'trim', 'required'
			));
			$this->CI->form_validation->set_rules('content', 'Content', array(
				'trim', 'required'
			));

			if($this->CI->form_validation->run())
			{
				$this->CI->db->trans_start();

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

				if($_FILES['logo']['error'] == 0)
				{
					$upload_logo = $this->CI->image->upload('logo');
					if($upload_logo['status'])
					{
						$logo = $upload_logo['data']['file_name'];
						$crop_logo = $this->CI->image->crop($upload_logo['data'], $logo, ['create_new' => TRUE, 'width' => 200, 'height' => 200]);
					}
				}

				//update post
				$data_post = array(
					'title' => input_post('title'),
					'content' => input_post('content')
				);

				if(in_array('dashboard_custom_brand_update_other', $this->CI->session->userdata('blog_user')['access']))
					$data_post['status'] = input_post('status');

				$image_data = json_decode($current_data['post_image'], TRUE);
				if($image != '')
					$image_data['image'] = $image;

				if($logo != '')
					$image_data['logo'] = $logo;

				$data_post['image'] = json_encode($image_data);

				$update_post = $this->CI->model_post->update($data_post, input_post('id'), FALSE, TRUE);
				//

				//create log for post update
				$data_log = array(
					'parent' => 0,
					'table_name' => 'post',
					'table_id' => input_post('id'),
					'type' => 'update',
					'description' => '',
					'date' => date('Y-m-d H:i:s'),
					'user_id' => $this->CI->session->userdata('blog_user')['id']
				);
				$create_post_log = $this->CI->model_log->create($data_log, TRUE);
				$post_log_id = $create_post_log['status'] ? $create_post_log['id'] : 0;
				//
				
				$this->CI->db->trans_complete();
				if($this->CI->db->trans_status() === FALSE)
				{
					$this->_message = alert_danger('Error occured while updating post!<br>Code : ' . $this->CI->db->error()['code'] . '<br>Message : ' . $this->CI->db->error()['message'], 'text-center');
				}
				else
				{
					$this->_message = alert_success('Post updated!', 'text-center');
				}
			}
			else
				$this->_message = alert_danger('Error occured while updating post!', 'text-center');
		}
	}

	public function delete()
	{
		$id = $this->CI->uri->segment(5);
		$page = $this->CI->model_post->count(array(
			'AND' => array(
				'post.id' => $id,
				'post.type' => 'post',
				'category.id' => 8
			),
			'AND_GROUP' => array(
				'IN' => array(
					'access_user_table.name' => array(
						'dashboard_post_delete', 'dashboard_post_delete_own', 'dashboard_post_delete_other'
					)
				),
				'OR_IN' => array(
					'access_level_table.name' => array(
						'dashboard_post_delete', 'dashboard_post_delete_own', 'dashboard_post_delete_other'
					)
				)
			),
			'NOT_GROUP' => array(
				'IN' => array(
					'access_level_table.name' => array(
						'revoke_dashboard_post_delete', 'revoke_dashboard_post_delete_own', 'revoke_dashboard_post_delete_other'
					),
					'access_user_table.name' => array(
						'revoke_dashboard_post_delete', 'revoke_dashboard_post_delete_own', 'revoke_dashboard_post_delete_other'
					)
				)
			)
		), TRUE);
		
		if($page == 0)
		{
			$this->CI->session->set_flashdata('message', alert_danger('Cannot find post. Delete fail!'));
			redirect('dashboard/custom/brand');
		}

		$this->CI->db->trans_start();

		//delete post
		$delete_post = $this->CI->model_post->delete($id, FALSE, TRUE);
		//

		//delete post log
		$delete_post_log = $this->CI->model_log->delete(array(
			'AND' => array(
				'table_id' => $id,
				'table_name' => 'post'
			)
		), TRUE, TRUE);
		//

		//delete post category
		$post_category = $this->CI->model_post_category->read(array(
			'AND' => ['post_id' => $id]
		), TRUE, 0, 0);
		$post_cateogry_id = array(0);
		foreach ($post_category->result_array() as $key => $value)
		{
			$post_category_id[] = $value['id'];
		}
		$delete_post_category = $this->CI->model_post_category->delete(array(
			'column' => 'post_id', 'value' => $id
		), FALSE, TRUE);
		//

		//delete post category log
		$delete_post_category_log = $this->CI->model_log->delete(array(
			'AND' => array('table_name' => 'post_category'),
			'IN' => array('table_id' => $post_category_id)
		), TRUE, TRUE);
		//

		//delete user_post_level
		$user_post_level = $this->CI->model_user_post_level->read(array(
			'AND' => array('post_id' => $id)
		), TRUE, 0, 0);
		$user_post_level_id = array(0);
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
		
		//delete user_access
		$user_access = $this->CI->model_user_access->read(array(
			'AND' => array(
				'user_id' => $this->CI->session->userdata('blog_user')['id'],
				'access_id' => '15520'
			)
		), TRUE, 0, 0);
		$user_access_id = array(0);
		foreach ($user_access->result_array() as $key => $value)
		{
			$user_access_id[] = $value['id'];
		}
		$delete_user_access = $this->CI->model_user_access->delete(array(
			'AND' => array(
				'user_id' => $this->CI->session->userdata('blog_user')['id'],
				'access_id' => '15520'
			)
		), TRUE, TRUE);
		//

		//delete user_post_level log
		$delete_user_access_log = $this->CI->model_log->delete(array(
			'AND' => array('table_name' => 'user_access'),
			'IN' => array('table_id' => $user_access_id)
		), TRUE, TRUE);
		//

		$session = $this->CI->session->userdata('blog_user');
        $session['access'] = array_diff($session['access'], array(
            'revoke_dashboard_custom_brand_create'
        ));
        $this->CI->session->set_userdata('blog_user', $session);

		$this->CI->db->trans_complete();
		if($this->CI->db->trans_status() === FALSE)
		{
			$this->CI->session->set_flashdata('message', alert_danger('Error occured while deleting post!<br>Code : ' . $this->CI->db->error()['code'] . '<br>Message : ' . $this->CI->db->error()['message'], 'text-center'));
		}
		else
		{
			$this->CI->session->set_flashdata('message', alert_success('Post deleted !', 'text-center'));
		}
		redirect('dashboard/custom/brand');
	}

	private function _count($config_data = array())
	{
		$is_public = FALSE;
		if(array_key_exists('is_public', $config_data))
			$is_public = $config_data['is_public'];

		$page_identifier = array(
			'AND' => array(
				'post.type' => 'post',
				'category.id' => 8
			)
		);

		if(!$is_public)
		{
			$page_identifier = array_merge($page_identifier, array(
				'AND_GROUP' => array(
					'IN' => array(
						'access_user_table.name' => array(
							'dashboard_post_list', 'dashboard_post_list_own', 'dashboard_post_list_other'
						)
					),
					'OR_IN' => array(
						'access_level_table.name' => array(
							'dashboard_post_list', 'dashboard_post_list_own', 'dashboard_post_list_other'
						)
					)
				),
				'NOT_GROUP' => array(
					'IN' => array(
						'access_level_table.name' => array(
							'revoke_dashboard_post_list', 'revoke_dashboard_post_list_own', 'revoke_dashboard_post_list_other'
						),
						'access_user_table.name' => array(
							'revoke_dashboard_post_list', 'revoke_dashboard_post_list_own', 'revoke_dashboard_post_list_other'
						)
					)
				)
			));
		}
		else
		{
			$page_identifier = array_merge_recursive($page_identifier, array(
				'AND' => array(
					'post.status' => 'published'
				)
			));
		}

		return $this->CI->model_post->count($page_identifier, TRUE, input_get('search'), $is_public);
	}

	public function count()
	{
		return ['type' => 'number', 'data' => $this->_count()];
	}

	public function pagination($data = array())
	{
		$this->CI->load->library('pagination');
        $config['base_url'] = site_url($this->CI->uri->uri_string());
        $config['total_rows'] = $this->_count($data);
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
}