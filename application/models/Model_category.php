<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_category extends MY_Model
{
	var $table = 'category';

	public function __construct()
	{
		parent::__construct();
	}

	public function read($identifier = array(), $grouped_identifier = FALSE, $page = 1, $limit = 10, $search = '')
	{
		$this->_select();

		$this->_join();

		$this->_search($search);

		$this->db->order_by('log.date', 'DESC');
		$this->db->group_by('category.id');

		return parent::read($identifier, $grouped_identifier, $page, $limit);
	}

	public function count($identifier = array(), $grouped_identifier = FALSE, $search = '')
	{
		//count 1
		$this->_select();
		$this->_join();
		$this->_search($search);
		$this->db->group_by('category.id');
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

	private function _select()
	{		
		$this->db->select('category.id AS category_id, category.name AS category_name, category.description AS category_description, category.status AS category_status, category.parent AS category_parent');
		$this->db->select('user.id AS category_author_id, IF(user.id = ' . $this->db->escape($this->session->userdata('blog_user')['id']) . ', \'you\', user.name) AS category_author_name');
		$this->db->select('log.type AS log_type, log.description AS log_description, log.date AS log_date');
		$this->db->select('GROUP_CONCAT(DISTINCT level.name) AS level');
		$this->db->select('GROUP_CONCAT(DISTINCT access_user_table.name) AS access_user');
		$this->db->select('GROUP_CONCAT(DISTINCT access_level_table.name) AS access_level');
	}

	private function _join()
	{
		$this->db->join('log', "log.table_id = category.id AND log.table_name = 'category' AND log.type = 'create'");

		$user_category_level_join = ' AND user_category_level.user_id = ' . $this->db->escape('0');
		$user_category_access_join = ' AND user_category_access.user_id = ' . $this->db->escape('0');

		if(in_array('dashboard_category_list', $this->session->userdata('blog_user')['access']))
		{
			if(!in_array('revoke_dashboard_category_list', $this->session->userdata('blog_user')['access']))
			{
				$own = FALSE;
				if(in_array('dashboard_category_list_own', $this->session->userdata('blog_user')['access']))
				{
					if(!in_array('revoke_dashboard_category_list_own', $this->session->userdata('blog_user')['access']))
					{
						$own = TRUE;
						$user_category_level_join = ' AND user_category_level.user_id = ' . $this->db->escape($this->session->userdata('blog_user')['id']);
						$user_category_access_join = ' AND user_category_access.user_id = ' . $this->db->escape($this->session->userdata('blog_user')['id']);
					}
				}

				if(in_array('dashboard_category_list_other', $this->session->userdata('blog_user')['access']))
				{
					if(!in_array('revoke_dashboard_category_list_other', $this->session->userdata('blog_user')['access']))
					{
						if($own)
						{
							$user_category_level_join = '';
							$user_category_access_join = '';
						}
						else
						{
							$user_category_level_join = ' AND user_category_level.user_id != ' . $this->db->escape($this->session->userdata('blog_user')['id']);
							$user_category_access_join = ' AND user_category_access.user_id != ' . $this->db->escape($this->session->userdata('blog_user')['id']);
						}
					}
				}
			}
		}

		$this->db->join('user_category_level', 'user_category_level.category_id = category.id' . $user_category_level_join);
		$this->db->join('user_category_access', 'user_category_access.category_id = category.id' . $user_category_access_join, 'left');
		$this->db->join('level', 'level.id = user_category_level.level_id');
		$this->db->join('user', 'user.id = log.user_id');
		$this->db->join('access AS access_user_table', 'access_user_table.id = user_category_access.access_id', 'left');
		$this->db->join('level_access', 'level_access.level_id = level.id');
		$this->db->join('access AS access_level_table', 'access_level_table.id = level_access.access_id');
	}

	private function _search($search = '')
	{
		if($search != '')
		{
			$this->db->group_start();
			$this->db->like('LOWER(category.name)', strtolower($search));
			$this->db->or_like('LOWER(category.description)', strtolower($search));
			$this->db->group_end();
		}
	}
}