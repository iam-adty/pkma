<div class="col-lg-12 panel-item">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">{user_name} / @{user_username}</h3>
		</div>
		<div class="panel-body">
			<div class="media">
				<div class="media-left media-top">
					<img width="80" class="media-object" src="{base_url}upload/image/{user_image_cropped}" alt="{user_name}">
				</div>
				<div class="media-body">
					<span class="created-on">
						join on <i>{log_date}</i>
					</span>
					<span class="status">
						and is <b><i>{user_status}</i></b>
					</span>
				</div>
			</div>
			<div class="panel-body-action hidden">
				<div class="main-btn-group">
					<a href="{dashboard_url}/custom/member/update/{user_id}.html" class="btn btn-primary">Update</a>
					<a href="{dashboard_url}/custom/member/delete/{user_id}.html" class="btn btn-danger">Delete</a>
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