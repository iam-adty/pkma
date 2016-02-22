<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_post extends MY_Model
{
	var $table = 'post';

	public function __construct()
	{
		parent::__construct();
	}

	public function create($data = array(), $global_transaction = FALSE)
	{
		$data['url'] = $this->_generate_url_title(strtolower($data['title']));
		
		return parent::create($data, $global_transaction);
	}

	public function read($identifier = array(), $grouped_identifier = FALSE, $page = 1, $limit = 10, $search = '')
	{
		$this->_select();

		$this->_join();

		$this->_search($search);

		$this->db->order_by('log.date', 'DESC');
		$this->db->group_by('post.id');

		return parent::read($identifier, $grouped_identifier, $page, $limit);
	}

	public function count($identifier = array(), $grouped_identifier = FALSE, $search = '')
	{
		//count 1
		$this->_select();
		$this->_join();
		$this->_search($search);
		$this->db->group_by('post.id');
		$count1 = parent::count($identifier, $grouped_identifier);

		//count 2
		$this->_select();
		$this->_join();
		$this->_search($search);
		$count2 = parent::count($identifier, $grouped_identifier);

		if($count1 == 0)
			return 0;
		else
			return $count2 / $count1;
	}

	private function _generate_url_title($url_title)
	{
		$this->db->like('url', url_title($url_title), 'after');
		$q = $this->db->get('post');
		if($q->num_rows() > 0)
		{
			return $this->_generate_url_title($url_title . ' ' . $q->num_rows());
		}
		else
		{
			return url_title($url_title);
		}
	}

	private function _select()
	{		
		$this->db->select('post.id AS post_id, post.title AS post_title, post.url AS post_url, post.content AS post_content, post.type AS post_type, post.status AS post_status');
		$this->db->select('user.id AS post_author_id, IF(user.id = ' . $this->db->escape($this->session->userdata('blog_user')['id']) . ', \'you\', user.name) AS post_author_name');
		$this->db->select('log.type AS log_type, log.description AS log_description, log.date AS log_date');
		$this->db->select('GROUP_CONCAT(DISTINCT level.name) AS level');
		$this->db->select('GROUP_CONCAT(DISTINCT access_user_table.name) AS access_user');
		$this->db->select('GROUP_CONCAT(DISTINCT access_level_table.name) AS access_level');
	}

	private function _join()
	{
		$this->db->join('log', "log.table_id = post.id AND log.table_name = 'post' AND log.type = 'create'");

		$user_post_level_join = ' AND user_post_level.user_id = ' . $this->db->escape('0');
		$user_post_access_join = ' AND user_post_access.user_id = ' . $this->db->escape('0');

		if(in_array('dashboard_post_list', $this->session->userdata('blog_user')['access']))
		{
			if(!in_array('revoke_dashboard_post_list', $this->session->userdata('blog_user')['access']))
			{
				$own = FALSE;
				if(in_array('dashboard_post_list_own', $this->session->userdata('blog_user')['access']))
				{
					if(!in_array('revoke_dashboard_post_list_own', $this->session->userdata('blog_user')['access']))
					{
						$own = TRUE;
						$user_post_level_join = ' AND user_post_level.user_id = ' . $this->db->escape($this->session->userdata('blog_user')['id']);
						$user_post_access_join = ' AND user_post_access.user_id = ' . $this->db->escape($this->session->userdata('blog_user')['id']);
					}
				}

				if(in_array('dashboard_post_list_other', $this->session->userdata('blog_user')['access']))
				{
					if(!in_array('revoke_dashboard_post_list_other', $this->session->userdata('blog_user')['access']))
					{
						if($own)
						{
							$user_post_level_join = '';
							$user_post_access_join = '';
						}
						else
						{
							$user_post_level_join = ' AND user_post_level.user_id != ' . $this->db->escape($this->session->userdata('blog_user')['id']);
							$user_post_access_join = ' AND user_post_access.user_id != ' . $this->db->escape($this->session->userdata('blog_user')['id']);
						}
					}
				}
			}
		}

		$this->db->join('user_post_level', 'user_post_level.post_id = post.id' . $user_post_level_join);
		$this->db->join('user_post_access', 'user_post_access.post_id = post.id' . $user_post_access_join, 'left');
		$this->db->join('level', 'level.id = user_post_level.level_id');
		$this->db->join('user', 'user.id = log.user_id');
		$this->db->join('access AS access_user_table', 'access_user_table.id = user_post_access.access_id', 'left');
		$this->db->join('level_access', 'level_access.level_id = level.id');
		$this->db->join('access AS access_level_table', 'access_level_table.id = level_access.access_id');
	}

	private function _search($search = '')
	{
		if($search != '')
		{
			$this->db->group_start();
			$this->db->like('LOWER(post.title)', strtolower($search));
			$this->db->or_like('LOWER(post.content)', strtolower($search));
			$this->db->group_end();
		}
	}
}