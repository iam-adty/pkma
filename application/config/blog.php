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
				'dashboard' => 'dashboard', 'blog' => 'pkma'
			]
		],
		'menu' => [
			'dashboard' => [
				'index' => [
					'label' => 'Dashboard', 'url' => 'index', 'access' => ['dashboard_view']
				],
				'page' => [
					'label' => 'Page', 'url' => 'page', 'child' => [
						'page' => ['label' => 'List', 'url' => 'page', 'access' => ['dashboard_page_view']],
						'create' => ['label' => 'Create', 'url' => 'page/create', 'access' => ['dashboard_page_create']]
					], 'access' => ['dashboard_page_view']
				],
				'post' => [
					'label' => 'Post', 'url' => 'post', 'child' => [
						'post' => ['label' => 'List', 'url' => 'post', 'access' => ['dashboard_post_view']],
						'create' => ['label' => 'Create', 'url' => 'post/create', 'access' => ['dashboard_post_create']],
						'-separator',
						'category' => ['label' => 'Category', 'url' => 'category', 'access' => ['dashboard_category_view']],
						'tag' => ['label' => 'Tag', 'url' => 'tag', 'access' => ['dashboard_tag_view']],
						'-separator',
						'comment' => ['label' => 'Comment', 'url' => 'comment', 'access' => ['dashboard_comment_view']]
					], 'access' => ['dashboard_post_view']
				],
				'user' => [
					'label' => 'User', 'url' => 'user', 'child' => [
						'user' => ['label' => 'List', 'url' => 'user', 'access' => ['dashboard_user_view']],
						'create' => ['label' => 'Create', 'url' => 'user/create', 'access' => ['dashboard_user_create']]
					], 'access' => ['dashboard_user_view']
				],
				'setting' => [
					'label' => 'Setting', 'url' => 'setting', 'child' => [
						'general' => ['label' => 'General', 'url' => 'setting/general', 'access' => ['dashboard_setting_general_view']],
						'template' => ['label' => 'Template', 'url' => 'setting/template', 'access' => ['dashboard_setting_template_view']]
					], 'access' => ['dashboard_setting_view']
				],
				'account' => [
					'label' => '{blog_session_user_name}', 'url' => 'account', 'child' => [
						'profile' => ['label' => 'Profile', 'url' => 'account/profile', 'access' => ['dashboard_account_profile_view']],
						'change-password' => ['label' => 'Change Password', 'url' => 'account/change-password', 'access' => ['dashboard_account_change-password_view']],
						'!separator!',
						'logout' => ['label' => 'Logout', 'url' => 'logout', 'access' => ['dashboard_account_logout']]
					], 'access' => ['dashboard_account_view']
				],
				'pkma-home' => [
					'label' => 'Home', 'url' => 'custom/home', 'child' => [
						'pkma-home-slider' => ['label' => 'Slider', 'url' => 'custom/slider', 'access' => ['dashboard_custom_slider_view']]
					], 'access' => ['dashboard_custom_home_view']
				],
				'pkma-about' => [
					'label' => 'About Us', 'url' => 'custom/about/update', 'access' => ['dashboard_custom_about_view']
				],
				'pkma-news' => [
					'label' => 'News', 'url' => 'custom/news', 'access' => ['dashboard_custom_news_view']
				],
				'pkma-member' => [
					'label' => 'Members', 'url' => 'custom/member', 'access' => ['dashboard_custom_member_view']
				],
				'pkma-brand' => [
					'label' => 'Brands', 'url' => 'custom/brand', 'access' => ['dashboard_custom_brand_view']
				],
				'pkma-blog' => [
					'label' => 'Blog', 'url' => 'custom/blog', 'access' => ['dashboard_custom_blog_view']
				]
			],
			'blog' => []
		]
	]
];