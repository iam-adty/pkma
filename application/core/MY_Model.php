<?php defined('BASEPATH') OR die('Direct script access not allowed');

class MY_Model extends CI_Model
{
	var $table = '';

	public function __construct()
	{
		parent::__construct();
	}

	public function create($data = array(), $global_transaction = FALSE)
	{
		if(!$global_transaction)
			$this->db->trans_start();

		$this->db->insert($this->table, $data);
		
		$result = array(
			'status' => FALSE,
			'error' => ''
		);

		if(!$global_transaction)
		{
			$this->db->trans_complete();

			if($this->db->trans_status() === FALSE)
				$result['error'] = $this->db->error();
			else
			{
				$result['status'] = TRUE;
				$result['id'] = $this->db->insert_id();
			}
		}
		else
		{
			if($this->db->affected_rows() > 0)
			{
				$result['status'] = TRUE;
				$result['id'] = $this->db->insert_id();
			}
			else
			{
				$result['error'] = $this->db->error();
			}
		}

		return $result;
	}

	public function read($identifier = array(), $grouped_identifier = FALSE, $page = 1, $limit = 10)
	{
		$offset = $page * $limit - $limit;

		if($grouped_identifier)
		{
			$this->_grouped_identifier($identifier);
		}
		else
		{
			$this->db->where(is_array($identifier) ? $identifier['column'] : $this->table . '.id', is_array($identifier) ? $identifier['value'] : $identifier);
		}

		$this->db->limit($limit, $offset);

		$query = $this->db->get($this->table);
		return $query;
	}

	public function update($data = array(), $identifier = array(), $grouped_identifier = FALSE, $global_transaction = FALSE)
	{
		if(!$global_transaction)
			$this->db->trans_start();

		if($grouped_identifier)
		{
			$this->_grouped_identifier($identifier);
		}
		else
		{
			$this->db->where(is_array($identifier) ? $identifier['column'] : $this->table . '.id', is_array($identifier) ? $identifier['value'] : $identifier);
		}

		$this->db->update($this->table, $data);
		
		$result = array(
			'status' => FALSE,
			'error' => ''
		);

		if(!$global_transaction)
		{
			$this->db->trans_complete();

			if($this->db->trans_status() === FALSE)
				$result['error'] = $this->db->error();
			else
			{
				$result['status'] = TRUE;
			}
		}
		else
		{
			if($this->db->affected_rows() > 0)
			{
				$result['status'] = TRUE;
			}
			else
			{
				$result['error'] = $this->db->error();
			}
		}

		return $result;
	}

	public function delete($identifier = array(), $grouped_identifier = FALSE, $global_transaction = FALSE)
	{
		if(!$global_transaction)
			$this->db->trans_start();

		if($grouped_identifier)
		{
			$this->_grouped_identifier($identifier);
		}
		else
		{
			$this->db->where(is_array($identifier) ? $identifier['column'] : $this->table . '.id', is_array($identifier) ? $identifier['value'] : $identifier);
		}

		$this->db->delete($this->table);
		
		$result = array(
			'status' => FALSE,
			'error' => ''
		);

		if(!$global_transaction)
		{
			$this->db->trans_complete();

			if($this->db->trans_status() === FALSE)
				$result['error'] = $this->db->error();
			else
			{
				$result['status'] = TRUE;
			}
		}
		else
		{
			if($this->db->affected_rows() > 0)
			{
				$result['status'] = TRUE;
			}
			else
			{
				$result['error'] = $this->db->error();
			}
		}

		return $result;
	}

	public function count($identifier = array(), $grouped_identifier = FALSE)
	{
		if($grouped_identifier)
		{
			$this->_grouped_identifier($identifier);
		}
		else
		{
			$this->db->where(is_array($identifier) ? $identifier['column'] : $this->table . '.id', is_array($identifier) ? $identifier['value'] : $identifier);
		}

		return $this->db->count_all_results($this->table);
	}

	private function _grouped_identifier($group = array())
	{
		foreach ($group as $key => $value)
		{
			switch ($key) {
				case 'AND_GROUP':
					$this->db->group_start();
					$this->_grouped_identifier($value);
					$this->db->group_end();
					break;

				case 'OR_GROUP':
					$this->db->or_group_start();
					$this->_grouped_identifier($value);
					$this->db->group_end();
					break;

				case 'NOT_GROUP':
					$this->db->not_group_start();
					$this->_grouped_identifier($value);
					$this->db->group_end();
					break;

				case 'OR_NOT_GROUP':
					$this->db->or_not_group_start();
					$this->_grouped_identifier($value);
					$this->db->group_end();
					break;
				
				case 'OR':
					$this->db->or_where($value);
					break;

				case 'AND':
					$this->db->where($value);
					break;

				case 'IN':
					foreach ($value as $key_in => $value_in)
					{
						$this->db->where_in($key_in, $value_in);
					}
					break;

				case 'OR_IN':
					foreach ($value as $key_or_in => $value_or_in)
					{
						$this->db->or_where_in($key_or_in, $value_or_in);
					}
					break;

				case 'NOT_IN':
					foreach ($value as $key_not_in => $value_not_in)
					{
						$this->db->where_not_in($key_not_in, $value_not_in);
					}
					break;

				case 'OR_NOT_IN':
					foreach ($value as $key_or_not_in => $value_or_not_in)
					{
						$this->db->or_where_not_in($key_or_not_in, $value_or_not_in);
					}
					break;

				case 'LIKE':
					foreach ($value as $key_like => $value_like)
					{
						$this->db->like($key_like, $value_like);
					}
					break;
				case 'OR_LIKE':
					foreach ($value as $key_or_like => $value_or_like)
					{
						$this->db->or_like($key_or_like, $value_or_like);
					}
					break;
			}
		}
	}
}