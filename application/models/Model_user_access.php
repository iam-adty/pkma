<?php defined('BASEPATH') OR die('No Direct Access Allowed!');

class Model_user_access extends MY_Model
{
	var $table = 'user_access';

	public function __construct()
	{
		parent::__construct();
	}
}