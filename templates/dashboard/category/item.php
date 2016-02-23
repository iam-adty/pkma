<div class="col-lg-6 panel-item">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">{category_name}</h3>
		</div>
		<div class="panel-body">
			<div class="post-info">
				<span class="created-by">
					created by <b><u>{category_author_name}</u></b>
				</span>
				<span class="created-on">
					on <i>{log_date}</i>
				</span>
				<span class="status">
					and is <b><i>{category_status}</i></b>
				</span>
			</div>
			<div class="post-content">
				{category_description}
			</div>
			<div class="panel-body-action hidden">
				<div class="main-btn-group">
					<a href="{dashboard_url}/category/update/{category_id}.html" class="btn btn-primary">Update</a>
					<a href="{dashboard_url}/category/delete/{category_id}.html" class="btn btn-danger">Delete</a>
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