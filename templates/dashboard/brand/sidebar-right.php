<h3>Manage Brand</h3>
{message}
<?php if(in_array('dashboard_custom_brand_create', $this->session->userdata('blog_user')['access']) && !in_array('revoke_dashboard_custom_brand_create', $this->session->userdata('blog_user')['access'])) : ?>
	<a href="{dashboard_url}/custom/brand/create.html" title="">Add New Brand</a>
<?php endif; ?>