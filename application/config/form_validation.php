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
	),
	'dashboard/post/create' => array(
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
		),
		array(
			'field' => 'category', 'label' => 'Category', 'rules' => array(
				'trim', 'required'
			)
		)
	),
	'dashboard/post/update' => array(
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
		),
		array(
			'field' => 'category', 'label' => 'Category', 'rules' => array(
				'trim', 'required'
			)
		)
	),
	'dashboard/user/create' => array(
		array(
			'field' => 'name', 'label' => 'Name', 'rules' => array(
				'trim', 'required'
			)
		),
		array(
			'field' => 'username', 'label' => 'Username', 'rules' => array(
				'trim', 'required', 'is_unique[user.username]'
			)
		),
		array(
			'field' => 'email', 'label' => 'Email', 'rules' => array(
				'trim', 'required', 'is_unique[user.email]', 'valid_email'
			)
		),
		array(
			'field' => 'password', 'label' => 'Password', 'rules' => array(
				'trim', 'required', 'sha1'
			)
		),
		array(
			'field' => 'status', 'label' => 'Status', 'rules' => array(
				'trim', 'required'
			)
		),
		array(
			'field' => 'level', 'label' => 'Level', 'rules' => array(
				'trim', 'required'
			)
		)
	),
	'dashboard/user/update' => array(
		array(
			'field' => 'name', 'label' => 'Name', 'rules' => array(
				'trim', 'required'
			)
		),
		array(
			'field' => 'username', 'label' => 'Username', 'rules' => array(
				'trim', 'required'
			)
		),
		array(
			'field' => 'email', 'label' => 'Email', 'rules' => array(
				'trim', 'required'
			)
		),
		array(
			'field' => 'password', 'label' => 'Password', 'rules' => array(
				'trim', 'required'
			)
		),
		array(
			'field' => 'status', 'label' => 'Status', 'rules' => array(
				'trim', 'required'
			)
		),
		array(
			'field' => 'level', 'label' => 'Level', 'rules' => array(
				'trim', 'required'
			)
		)
	)
);