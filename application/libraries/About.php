<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class About
{
	private $CI;
	private $_message = '';
	private $_data = array();
	private $_limit = 10;
	private $_temporary = array();

	public function __construct($init = array())
	{
		$this->CI =& get_instance();
		$this->CI->load->model(array('model_page', 'model_log', 'model_user_post_level', 'model_category', 'model_post_category'));

		if(array_key_exists('data', $init))
			$this->_data = $init['data'];

		$this->_limit = input_get('limit', $this->_limit);
	}

	public function update()
	{
		$page = $this->CI->model_page->read(array(
			'AND' => array(
				'post.id' => 1,
				'post.type' => 'page'
			),
			'AND_GROUP' => array(
				'IN' => array(
					'access_user_table.name' => array(
						'dashboard_page_update', 'dashboard_page_update_own', 'dashboard_page_update_other'
					)
				),
				'OR_IN' => array(
					'access_level_table.name' => array(
						'dashboard_page_update', 'dashboard_page_update_own', 'dashboard_page_update_other'
					)
				)
			),
			'NOT_GROUP' => array(
				'IN' => array(
					'access_level_table.name' => array(
						'revoke_dashboard_page_update', 'revoke_dashboard_page_update_own', 'revoke_dashboard_page_update_other'
					),
					'access_user_table.name' => array(
						'revoke_dashboard_page_update', 'revoke_dashboard_page_update_own', 'revoke_dashboard_page_update_other'
					)
				)
			)
		), TRUE, 1, 1);

		if(is_null($page->row_array()))
		{
			$this->CI->session->set_flashdata('message', alert_danger('You don\'t have permission to update the page', 'text-center'));
			redirect('dashboard');
		}
		else
		{
			$this->_update_action();
			$page = $page->row_array();
		}

		$data = array(
			'id' => 1,
			'content' => set_value('content', $page['post_content']),
			'title' => set_value('title', $page['post_title']),
			'image' => set_value('image', $page['post_image']),
			'content_message' => text_danger(form_error('content')),
			'title_message' => text_danger(form_error('title')),
			'image_message' => text_danger(form_error('image')),
			'form_message' => $this->_message
		);

		return ['type' => 'single-array-to-parse', 'data' => $data];
	}

	private function _update_action()
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
					$this->CI->load->library('image');
					$upload_image = $this->CI->image->upload('image');
					if($upload_image['status'])
					{
						$image = $upload_image['data']['file_name'];
						$crop_image = $this->CI->image->crop($upload_image['data'], $image, ['create_new' => TRUE, 'width' => 200, 'height' => 200]);
					}
				}

				//update post
				$data_post = array(
					'title' => input_post('title'),
					'content' => input_post('content')
				);

				if($image != '')
					$data_post['image'] = $image;

				$update_post = $this->CI->model_page->update($data_post, input_post('id'), FALSE, TRUE);
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
					$this->_message = alert_danger('Error occured while updating page!<br>Code : ' . $this->CI->db->error()['code'] . '<br>Message : ' . $this->CI->db->error()['message'], 'text-center');
				}
				else
				{
					$this->_message = alert_success('Page updated!', 'text-center');
				}
			}
			else
				$this->_message = alert_danger('Error occured while updating page!', 'text-center');
		}
	}

}