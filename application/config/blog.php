<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = [
	'non-secure' => [
		'blog' => [
			'name' => 'PKMA',
			'description' => 'PKMA'
		]
	],
	'secure' => [
		'template' => [
			'path' => 'templates',
			'default' => [
				'dashboard' => 'dashboard', 'blog' => 'blog'
			]
		],
		'menu' => [
			'dashboard' => [
				'index' => [
					'label' => 'Dashboard', 'url' => 'index', 'access' => ['dashboard_view']
				],
				'page' => [
					'label' => 'Page', 'url' => 'page', 'child' => [
						'page' => ['label' => 'List', 'url' => 'page'],
						'create' => ['label' => 'Create', 'url' => 'page/create']
					], 'access' => ['dashboard_page_view']
				],
				'post' => [
					'label' => 'Post', 'url' => 'post', 'child' => [
						'post' => ['label' => 'List', 'url' => 'post'],
						'create' => ['label' => 'Create', 'url' => 'post/create'],
						'-separator',
						'category' => ['label' => 'Category', 'url' => 'category'],
						'tag' => ['label' => 'Tag', 'url' => 'tag'],
						'-separator',
						'comment' => ['label' => 'Comment', 'url' => 'comment']
					], 'access' => ['dashboard_post_view']
				],
				'user' => [
					'label' => 'User', 'url' => 'user', 'child' => [
						'user' => ['label' => 'List', 'url' => 'user'],
						'create' => ['label' => 'Create', 'url' => 'user/create']
					], 'access' => ['dashboard_user_view']
				],
				'setting' => [
					'label' => 'Setting', 'url' => 'setting', 'child' => [
						'general' => ['label' => 'General', 'url' => 'setting/general'],
						'template' => ['label' => 'Template', 'url' => 'setting/template']
					], 'access' => ['dashboard_setting_view']
				],
				'account' => [
					'label' => '{blog_session_user_name}', 'url' => 'account', 'child' => [
						'profile' => ['label' => 'Profile', 'url' => 'account/profile'],
						'change-password' => ['label' => 'Change Password', 'url' => 'account/change-password'],
						'!separator!',
						'logout' => ['label' => 'Logout', 'url' => 'logout']
					], 'access' => ['dashboard_accout_view']
				]
			],
			'blog' => []
		]
	]
];