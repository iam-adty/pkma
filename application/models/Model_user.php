<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Model_user extends CI_Model
{
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
			$this->db->select('GROUP_CONCAT(DISTINCT level.name) AS level');
			$this->db->select('GROUP_CONCAT(DISTINCT access.name) AS access');
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
		$this->db->join('level', 'level.id = user_level.level_id AND level.status = \'published\'', 'left');
		$this->db->join('level_access', 'level_access.level_id = level.id', 'left');
		$this->db->join('access', 'access.id = level_access.access_id AND access.status = \'published\'', 'left');

		$this->db->group_by('user.id');

		$query = $this->db->get('user');

		return $query;
	}
}