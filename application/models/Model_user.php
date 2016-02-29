<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Model_user extends MY_Model
{
	var $table = 'user';

	public function __construct()
	{
		parent::__construct();
	}

	public function get($param = 0, $field = NULL)
	{

		if(!is_null($field))
		{
			$this->db->select($field);
		}
		else
		{
			$this->db->select('user.id, user.username, user.name, user.email, user.status');
			$this->db->select('GROUP_CONCAT(DISTINCT level.id) AS level');
			$this->db->select('GROUP_CONCAT(DISTINCT access_of_level.id) AS access_id_of_level');
			$this->db->select('GROUP_CONCAT(DISTINCT access_of_user.id) AS access_id_of_user');
		}

		if(is_array($param))
		{
			$this->db->where($param);
		}
		else
		{
			$this->db->where('id', $param);
		}

		$this->db->join('user_level', 'user_level.user_id = user.id', 'left');
		$this->db->join('level', 'level.id = user_level.level_id', 'left');
		$this->db->join('level_access', 'level_access.level_id = level.id', 'left');
		$this->db->join('access AS access_of_level', 'access_of_level.id = level_access.access_id', 'left');
		$this->db->join('user_access', 'user_access.user_id = user.id', 'left');
		$this->db->join('access AS access_of_user', 'access_of_user.id = user_access.access_id', 'left');

		$this->db->group_by('user.id');

		$query = $this->db->get('user');

		return $query;
	}

	public function read($identifier = array(), $grouped_identifier = FALSE, $page = 1, $limit = 10, $search = '')
	{
		$this->_select();

		$this->_join();

		$this->_search($search);

		$this->db->order_by('log.date', 'DESC');
		$this->db->group_by('user.id');

		return parent::read($identifier, $grouped_identifier, $page, $limit);
	}

	public function count($identifier = array(), $grouped_identifier = FALSE, $search = '')
	{
		//count 1
		$this->_select();
		$this->_join();
		$this->_search($search);
		$this->db->group_by('user.id');
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
		$this->db->select('user.id AS user_id, user.name AS user_name, user.username AS user_username, user.email AS user_email, user.status AS user_status, user.image AS user_image');
		$this->db->select('log.type AS log_type, log.description AS log_description, log.date AS log_date');
		$this->db->select('GROUP_CONCAT(DISTINCT level.name) AS user_level');
		$this->db->select('GROUP_CONCAT(DISTINCT level.id) AS user_level_id');
	}

	private function _join()
	{
		$this->db->join('log', "log.table_id = user.id AND log.table_name = 'user' AND log.type = 'create'");
		$this->db->join('user_level', 'user.id = user_level.user_id');
		$this->db->join('level', 'level.id = user_level.level_id');
	}

	private function _search($search = '')
	{
		if($search != '')
		{
			$this->db->group_start();
			$this->db->like('LOWER(user.name)', strtolower($search));
			$this->db->or_like('LOWER(user.email)', strtolower($search));
			$this->db->or_like('LOWER(user.username)', strtolower($search));
			$this->db->group_end();
		}
	}
}