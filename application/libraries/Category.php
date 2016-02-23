<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Category
{
	private $CI;
	private $_message = '';
	private $_data = array();
	private $_status_option = array(
		'draft', 'pending', 'published'
	);
	private $_limit = 10;

	public function __construct($init = array())
	{
		$this->CI =& get_instance();
		$this->CI->load->model(array('model_category', 'model_user_category_level', 'model_log'));

		if(array_key_exists('data', $init))
			$this->_data = $init['data'];

		$this->_limit = input_get('limit', $this->_limit);
	}

	public function read()
	{
		$item = array();
		$identifier = array(
			'AND_GROUP' => array(
				'IN' => array(
					'access_user_table.name' => array(
						'dashboard_category_list', 'dashboard_category_list_own', 'dashboard_category_list_other'
					)
				),
				'OR_IN' => array(
					'access_level_table.name' => array(
						'dashboard_category_list', 'dashboard_category_list_own', 'dashboard_category_list_other'
					)
				)
			),
			'NOT_GROUP' => array(
				'IN' => array(
					'access_user_table.name' => array(
						'revoke_dashboard_category_list', 'revoke_dashboard_category_list_own', 'revoke_dashboard_category_list_other'
					),
					'access_level_table.name' => array(
						'revoke_dashboard_category_list', 'revoke_dashboard_category_list_own', 'revoke_dashboard_category_list_other'
					)
				)
			)
		);

		$category = $this->CI->model_category->read($identifier, TRUE, input_get('page', 1), $this->_limit, input_get('search'));

		$item_id = array();
		foreach ($category->result_array() as $key => $value)
		{
			$value['category_description'] = rich_text_limiter($value['category_description'], 50);
			$value['log_date'] = date_format(date_create($value['log_date']), 'l. F d, Y \a\t H:i:s');
			$item[] = $value;
		}

		return ['type' => 'array-list-to-parse', 'data' => $item];
	}

	public function create()
	{
		$this->_create_action();

		$data = array(
			'parent' => set_value('parent'),
			'description' => set_value('description'),
			'name' => set_value('name'),
			'status' => set_value('status','draft'),
			'description_message' => text_danger(form_error('description')),
			'name_message' => text_danger(form_error('name')),
			'status_message' => text_danger(form_error('status')),
			'parent_message' => text_danger(form_error('parent')),
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
			if($this->CI->form_validation->run('dashboard/category/create'))
			{
				$this->CI->db->trans_start();

				//insert data to table category
				$data_category = array(
					'name' => input_post('name'),
					'description' => input_post('description'),
					'parent' => input_post('parent', 0),
					'status' => input_post('status')
				);
				$insert_category = $this->CI->model_category->create($data_category, TRUE);
				$category_id = $insert_category['status'] ? $insert_category['id'] : 0;
				//
				
				//insert data to table log (loggin post)
				$data_log = array(
					'parent' => 0,
					'table_name' => 'category',
					'table_id' => $category_id,
					'type' => 'create',
					'description' => '',
					'date' => date('Y-m-d H:i:s'),
					'user_id' => $this->CI->session->userdata('blog_user')['id']
				);
				$insert_category_log = $this->CI->model_log->create($data_log, TRUE);
				$category_log_id = $insert_category_log['status'] ? $insert_category_log['id'] : 0;
				//

				//insert data to table user_post_level
				$data_user_category_level_create = array(
					'user_id' => $this->CI->session->userdata('blog_user')['id'],
					'level_id' => '300',
					'category_id' => $category_id
				);
				$insert_user_category_level = $this->CI->model_user_category_level->create($data_user_category_level_create, TRUE);
				$user_category_level_id = $insert_user_category_level['status'] ? $insert_user_category_level['id'] : 0;
				//

				//insert data to table log (logging user_post_level)
				$data_log = array(
					'parent' => $category_log_id,
					'table_name' => 'user_category_level',
					'table_id' => $user_category_level_id,
					'type' => 'create',
					'description' => '',
					'date' => date('Y-m-d H:i:s'),
					'user_id' => $this->CI->session->userdata('blog_user')['id']
				);
				$insert_user_category_level_log = $this->CI->model_log->create($data_log, TRUE);
				$user_category_level_log_id = $insert_user_category_level_log['status'] ? $insert_user_category_level_log['id'] : 0;
				//

				$this->CI->db->trans_complete();
				if($this->CI->db->trans_status() === FALSE)
				{
					$this->_message = alert_danger('Error occured when creating new category!<br>Code : ' . $this->CI->db->error()['code'] . '<br>Message : ' . $this->CI->db->error()['message'], 'text-center');
				}
				else
				{
					$this->CI->session->set_flashdata('message', alert_success('New category created!', 'text-center'));
						redirect('dashboard/category');
				}
			}
			else
				$this->_message = alert_danger('Error occured while creating new category!', 'text-center');
		}
	}

	public function update()
	{
		$id = $this->CI->uri->segment(4);
		$category = $this->CI->model_category->read(array(
			'AND' => array(
				'category.id' => $id
			),
			'OR_GROUP' => array(
				'IN' => array(
					'access_user_table.name' => array(
						'dashboard_category_update', 'dashboard_category_update_own', 'dashboard_category_update_other'
					),
					'access_level_table.name' => array(
						'dashboard_category_update', 'dashboard_category_update_own', 'dashboard_category_update_other'
					)
				)
			),
			'NOT_IN' => array(
				'access_user_table.name' => array(
					'revoke_dashboard_category_update', 'revoke_dashboard_category_update_own', 'revoke_dashboard_category_update_other'
				),
				'access_level_table.name' => array(
					'revoke_dashboard_category_update', 'revoke_dashboard_category_update_own', 'revoke_dashboard_category_update_other'
				)
			)
		), TRUE, 1, 1);

		if(is_null($category->row_array()))
		{
			$this->CI->session->set_flashdata('message', alert_danger('You don\'t have permission to update the category', 'text-center'));
			redirect('dashboard/category');
		}
		else
		{
			$this->_update_action();
			$category = $category->row_array();
		}

		$data = array(
			'id' => $id,
			'name' => set_value('name', $category['category_name']),
			'description' => set_value('description', $category['category_description']),
			'status' => set_value('status', $category['category_status']),
			'parent' => set_value('parent', $category['category_parent']),
			'name_message' => text_danger(form_error('name')),
			'description_message' => text_danger(form_error('description')),
			'status_message' => text_danger(form_error('status')),
			'parent_message' => text_danger(form_error('parent')),
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

	private function _update_action()
	{
		if(input_post('action') == 'update')
		{			
			if($this->CI->form_validation->run('dashboard/category/update'))
			{
				$this->CI->db->trans_start();

				//update category
				$data_category = array(
					'name' => input_post('name'),
					'description' => input_post('description'),
					'status' => input_post('status'),
					'parent' => input_post('parent')
				);
				$update_category = $this->CI->model_category->update($data_category, input_post('id'), FALSE, TRUE);
				//

				//create log for category update
				$data_log = array(
					'parent' => 0,
					'table_name' => 'category',
					'table_id' => input_post('id'),
					'type' => 'update',
					'description' => '',
					'date' => date('Y-m-d H:i:s'),
					'user_id' => $this->CI->session->userdata('blog_user')['id']
				);
				$create_category_log = $this->CI->model_log->create($data_log, TRUE);
				$category_log_id = $create_category_log['status'] ? $create_category_log['id'] : 0;
				//

				//update user_post_level if any
				//

				//create user_post_level log
				//

				//update user_post_access if any
				//

				//create user_post_access log
				//

				$this->CI->db->trans_complete();
				if($this->CI->db->trans_status() === FALSE)
				{
					$this->_message = alert_danger('Error occured while updating category!<br>Code : ' . $this->CI->db->error()['code'] . '<br>Message : ' . $this->CI->db->error()['message'], 'text-center');
				}
				else
				{
					$this->_message = alert_success('Category updated!', 'text-center');
				}
			}
			else
				$this->_message = alert_danger('Error occured while updating category!', 'text-center');
		}
	}

	public function delete()
	{
		$id = $this->CI->uri->segment(4);

		$category = $this->CI->model_category->count(array(
			'AND' => array(
				'category.id' => $id
			),
			'OR_GROUP' => array(
				'IN' => array(
					'access_user_table.name' => array(
						'dashboard_category_delete', 'dashboard_category_delete_own', 'dashboard_category_delete_other'
					),
					'access_level_table.name' => array(
						'dashboard_category_delete', 'dashboard_category_delete_own', 'dashboard_category_delete_other'
					)
				)
			),
			'NOT_IN' => array(
				'access_user_table.name' => array(
					'revoke_dashboard_category_delete', 'revoke_dashboard_category_delete_own', 'revoke_dashboard_category_delete_other'
				),
				'access_level_table.name' => array(
					'revoke_dashboard_category_delete', 'revoke_dashboard_category_delete_own', 'revoke_dashboard_category_delete_other'
				)
			)
		), TRUE);
		
		if($category == 0)
		{
			$this->CI->session->set_flashdata('message', alert_danger('Category not found. Cannot delete!', 'text-center'));
			redirect('dashboard/category');
		}

		$this->CI->db->trans_start();

		//delete post
		$delete_category = $this->CI->model_category->delete($id, FALSE, TRUE);
		//

		//delete post log
		$delete_category_log = $this->CI->model_log->delete(array(
			'AND' => array(
				'table_id' => $id,
				'table_name' => 'category'
			)
		), TRUE, TRUE);
		//

		//delete user_post_level
		$user_category_level = $this->CI->model_user_category_level->read(array(
			'AND' => array('category_id' => $id)
		), TRUE, 0, 0);
		$user_category_level_id = array();
		foreach ($user_category_level->result_array() as $key => $value)
		{
			$user_category_level_id[] = $value['id'];
		}
		$delete_user_category_level = $this->CI->model_user_category_level->delete(array(
			'column' => 'category_id', 'value' => $id
		), FALSE, TRUE);
		//

		//delete user_post_level log
		$delete_user_category_level_log = $this->CI->model_log->delete(array(
			'AND' => array('table_name' => 'user_category_level'),
			'IN' => array('table_id' => $user_category_level_id)
		), TRUE, TRUE);
		//

		//delete user_post_access
		//

		//delete user_post_access log
		//

		$this->CI->db->trans_complete();
		if($this->CI->db->trans_status() === FALSE)
		{
			$this->CI->session->set_flashdata('message', alert_danger('Error occured while deleting category!<br>Code : ' . $this->CI->db->error()['code'] . '<br>Message : ' . $this->CI->db->error()['message'], 'text-center'));
		}
		else
		{
			$this->CI->session->set_flashdata('message', alert_success('Category deleted !', 'text-center'));
		}
		redirect('dashboard/category');
	}

	private function _count()
	{
		$identifier = array(
			'AND_GROUP' => array(
				'IN' => array(
					'access_user_table.name' => array(
						'dashboard_category_list', 'dashboard_category_list_own', 'dashboard_category_list_other'
					)
				),
				'OR_IN' => array(
					'access_level_table.name' => array(
						'dashboard_category_list', 'dashboard_category_list_own', 'dashboard_category_list_other'
					)
				)
			),
			'NOT_GROUP' => array(
				'IN' => array(
					'access_user_table.name' => array(
						'revoke_dashboard_category_list', 'revoke_dashboard_category_list_own', 'revoke_dashboard_category_list_other'
					),
					'access_level_table.name' => array(
						'revoke_dashboard_category_list', 'revoke_dashboard_category_list_own', 'revoke_dashboard_category_list_other'
					)
				)
			)
		);

		return $this->CI->model_category->count($identifier, TRUE, input_get('search'));
	}

	public function count()
	{
		return ['type' => 'number', 'data' => $this->_count()];
	}

	public function read_parent()
	{
		$item = array();
		$identifier = array(
			'AND_GROUP' => array(
				'IN' => array(
					'access_user_table.name' => array(
						'dashboard_category_list', 'dashboard_category_list_own', 'dashboard_category_list_other'
					)
				),
				'OR_IN' => array(
					'access_level_table.name' => array(
						'dashboard_category_list', 'dashboard_category_list_own', 'dashboard_category_list_other'
					)
				)
			),
			'NOT_GROUP' => array(
				'IN' => array(
					'access_user_table.name' => array(
						'revoke_dashboard_category_list', 'revoke_dashboard_category_list_own', 'revoke_dashboard_category_list_other'
					),
					'access_level_table.name' => array(
						'revoke_dashboard_category_list', 'revoke_dashboard_category_list_own', 'revoke_dashboard_category_list_other'
					)
				)
			)
		);

		$category = $this->CI->model_category->read($identifier, TRUE, 0, 0);

		$update_id = $this->CI->uri->segment(3) == 'update' ? $this->CI->uri->segment(4) : 0;
		$selected_parent = '';

		$item_id = array();
		foreach ($category->result_array() as $key => $value)
		{
			$value['category_description'] = rich_text_limiter($value['category_description'], 50);
			$value['log_date'] = date_format(date_create($value['log_date']), 'l. F d, Y \a\t H:i:s');

			if($value['category_id'] == $update_id)
				$selected_parent = $value['category_parent'];

			if($value['category_id'] == set_value('parent', ''))
				$value['category_selected'] = 'selected="selected"';
			else
				$value['category_selected'] = '';

			$item_id[] = $value['category_id'];
			$item[] = $value;
		}

		if($selected_parent != '' && set_value('parent', '') == '')
		{
			$item[array_search($selected_parent, $item_id)]['category_selected'] = 'selected="selected"';
		}

		return ['type' => 'array-list-to-parse', 'data' => $item];
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
}