<div class="row">
	<form name="form-member-update" id="form-meme=ber-update" class="form" action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="action" value="update">
		<input type="hidden" name="id" value="{id}">
		<input type="hidden" name="{blog_csrf_name}" value="{blog_csrf_hash}">
		<div class="col-lg-4 col-xs-12 col-sm-12 col-md-4 pull-right">
			{form_message}
			<h4>Update Member</h4>
			<div class="form-group">
				<label for="name">Name</label>
				{name_message}
				<input type="text" name="name" class="form-control" id="name" value="{name}">
			</div>
			<div class="form-group">
				<label for="username">Username</label>
				{username_message}
				<input type="text" name="username" class="form-control" id="username" value="{username}">
			</div>
			<div class="form-group">
				<label for="email">Email</label>
				{email_message}
				<input type="text" name="email" class="form-control" id="email" value="{email}">
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				{password_message}
				<input type="password" name="password" class="form-control" id="password" value="">
			</div>
			<div class="form-group">
				<label for="image">Image</label>
				{image_message}
				<div class="input-group">
					<input type="file" name="image" class="form-control" id="file" value="{image}">
					<span class="input-group-addon">
						<input type="checkbox" name="remove_image" value="true" aria-label="Remove Image"> remove
					</span>
				</div>
			</div>
			<div class="form-group hidden">
				<label for="status">Level</label>
				{level_message}
				<select name="level" id="level" class="form-control">
					{template_user/form/option-level|(
						"library" : [
							"member", "read_level", (
								"selected_level" : "{level}"
							)
						]
					)}
				</select>
			</div>
			<div class="form-group">
				<label for="status">Status</label>
				{status_message}
				<select name="status" id="status" class="form-control">
					<option value="active" {status_active}>Active</option>
					<option value="pending" {status_pending}>Pending</option>
					<option value="blocked" {status_blocked}>Blocked</option>
				</select>
			</div>
			<div class="form-group hidden-xs hidden-sm">
				<button type="submit" class="btn btn-primary">Save</button>
				<button type="reset" class="btn btn-default">Cancel</button>
			</div>
		</div>
		<div class="col-lg-8 col-xs-12 col-sm-12 col-md-8 pull-right">
			<div class="form-group">
				<img src="{base_url}upload/image/{image}" alt="{name}" class="pull-right" height="200">
			</div>
		</div>
	</form>
</div>