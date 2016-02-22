<div class="col-lg-6 page-item">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">{post_title}</h3>
		</div>
		<div class="panel-body">
			<div class="post-info">
				<span class="created-by">
					created by <a href="{dashboard_url}/user/{post_author_id}">{post_author_name}</a>
				</span>
				<span class="created-on">
					on {log_date}
				</span>
				<span class="status">
					(status : {post_status})
				</span>
			</div>
			<div class="post-content">
				{post_content}
			</div>
			<div class="panel-body-action hidden">
				<div class="main-btn-group">
					<a href="{dashboard_url}/page/update/{post_id}.html" class="btn btn-primary">Update</a>
					<a href="{dashboard_url}/page/delete/{post_id}.html" class="btn btn-danger">Delete</a>
					<a href="{base_url}{post_url}.html" target="_blank" class="btn btn-success">View</a>
					<a href="#" class="hidden btn btn-default btn-show-other">...</a>
				</div>
				<div class="other-btn-group hidden">
					<a href="#" class="btn btn-default">Change Order</a>
					<a href="#" class="btn btn-default btn-show-other">...</a>
				</div>
			</div>
		</div>
	</div>
</div>