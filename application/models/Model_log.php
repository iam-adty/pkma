<?php defined('BASEPATH') OR die('No Direct Access Allowed!');

class Model_log extends MY_Model
{
	var $table = 'log';

	public function __construct()
	{
		parent::__construct();
	}
}