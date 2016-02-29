<div class="row">
	<form name="form-news-update" id="form-news-update" class="form" action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="action" value="update">
		<input type="hidden" name="id" value="{id}">
		<input type="hidden" name="{blog_csrf_name}" value="{blog_csrf_hash}">
		<div class="col-lg-4 col-xs-12 col-sm-12 col-md-4 pull-right">
			{form_message}
			<h4>Update News</h4>
			<div class="form-group">
				<label for="title">Title</label>
				{title_message}
				<textarea name="title" id="title" class="form-control autogrow-textarea">{title}</textarea>
			</div>
			<div class="form-group hidden-xs hidden-sm">
				<button type="submit" class="btn btn-primary">Save</button>
				<button type="reset" class="btn btn-default">Cancel</button>
			</div>
		</div>
		<div class="col-lg-8 col-xs-12 col-sm-12 col-md-8 pull-right">
			<div class="form-group">
				<label for="content">Content</label>
				{content_message}
				<textarea name="content" id="content" class="form-control summernote-container">{content}</textarea>
			</div>
			<div class="form-group">
				<label for="image">Image</label>
				{image_message}
				<input type="file" name="image" id="image" class="form-control">
			</div>
			<div class="form-group">
				<img height="150" src="{base_url}upload/image/{image}" alt="">
			</div>
			<div class="form-group hidden-lg hidden-md">
				<button type="submit" class="btn btn-primary">Save</button>
				<button type="reset" class="btn btn-default">Cancel</button>
			</div>
		</div>
	</form>
</div>