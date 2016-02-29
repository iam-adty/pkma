<h3>Manage News</h3>
{message}
<?php if(in_array('dashboard_custom_news_create', $this->session->userdata('blog_user')['access']) && !in_array('revoke_dashboard_custom_news_create', $this->session->userdata('blog_user')['access'])) : ?>
	<a href="{dashboard_url}/custom/news/create.html" title="">Add New news</a>
<?php endif; ?>