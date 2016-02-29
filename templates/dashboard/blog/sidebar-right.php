<h3>Manage Blog Post</h3>
{message}
<?php if(in_array('dashboard_custom_blog_create', $this->session->userdata('blog_user')['access']) && !in_array('revoke_dashboard_custom_blog_create', $this->session->userdata('blog_user')['access'])) : ?>
<a href="{dashboard_url}/custom/blog/create.html" title="">Add New Blog Post</a>
<?php endif; ?>