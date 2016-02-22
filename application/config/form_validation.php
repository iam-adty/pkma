<?php

$config = array(
	'dashboard/login' => array(
		array(
			'field' => 'username', 'label' => 'Username', 'rules' => array(
				'trim', 'required'
			)
		),
		array(
			'field' => 'password', 'label' => 'Password', 'rules' => array(
				'trim', 'required'
			)
		)
	),
	'dashboard/page/create' => array(
		array(
			'field' => 'title', 'label' => 'Title', 'rules' => array(
				'trim', 'required'
			)
		),
		array(
			'field' => 'content', 'label' => 'Content', 'rules' => array(
				'trim'
			)
		),
		array(
			'field' => 'status', 'label' => 'Status', 'rules' => array(
				'trim', 'required'
			)
		)
	),
	'dashboard/page/update' => array(
		array(
			'field' => 'id', 'label' => 'ID', 'rules' => array(
				'trim', 'required'
			)
		),
		array(
			'field' => 'title', 'label' => 'Title', 'rules' => array(
				'trim', 'required'
			)
		),
		array(
			'field' => 'content', 'label' => 'Content', 'rules' => array(
				'trim'
			)
		),
		array(
			'field' => 'status', 'label' => 'Status', 'rules' => array(
				'trim', 'required'
			)
		)
	),
	'dashboard/category/create' => array(
		array(
			'field' => 'name', 'label' => 'Name', 'rules' => array(
				'trim', 'required'
			)
		),
		array(
			'field' => 'description', 'label' => 'Description', 'rules' => array(
				'trim'
			)
		),
		array(
			'field' => 'status', 'label' => 'Status', 'rules' => array(
				'trim', 'required'
			)
		),
		array(
			'field' => 'parent', 'label' => 'parent', 'rules' => array(
				'trim'
			)
		)
	),
	'dashboard/category/update' => array(
		array(
			'field' => 'id', 'label' => 'ID', 'rules' => array(
				'trim', 'required'
			)
		),
		array(
			'field' => 'name', 'label' => 'Name', 'rules' => array(
				'trim', 'required'
			)
		),
		array(
			'field' => 'description', 'label' => 'Description', 'rules' => array(
				'trim'
			)
		),
		array(
			'field' => 'status', 'label' => 'Status', 'rules' => array(
				'trim', 'required'
			)
		),
		array(
			'field' => 'parent', 'label' => 'parent', 'rules' => array(
				'trim', 'required'
			)
		)
	)
);