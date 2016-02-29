<h3>Manage Member</h3>
{message}
<?php if(in_array('dashboard_custom_member_create', $this->session->userdata('blog_user')['access']) && !in_array('revoke_dashboard_custom_member_create', $this->session->userdata('blog_user')['access'])) : ?>
	<a href="{dashboard_url}/custom/member/create.html" title="">Add New Member</a>
<?php endif; ?>