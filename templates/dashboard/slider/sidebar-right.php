<h3>Manage Home Slider</h3>
{message}
<?php if(in_array('dashboard_custom_slider_create', $this->session->userdata('blog_user')['access']) && !in_array('revoke_dashboard_custom_slider_create', $this->session->userdata('blog_user')['access'])) : ?>
	<a href="{dashboard_url}/custom/slider/create.html" title="">Add New Slider</a>
<?php endif; ?>