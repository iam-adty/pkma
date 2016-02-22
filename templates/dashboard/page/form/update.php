<div class="row">
	<form name="form-page-edit" id="form-page-edit" class="form" action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="action" value="update">
		<input type="hidden" name="id" value="{id}">
		<input type="hidden" name="{blog_csrf_name}" value="{blog_csrf_hash}">
		<div class="col-lg-4 col-xs-12 col-sm-12 col-md-4 pull-right">
			{message}
			<h4>Update Page</h4>
		    <div class="form-group">
				<label for="title">Title</label>
				{title_message}
				<textarea name="title" id="title" class="form-control autogrow-textarea">{title}</textarea>
			</div>
		    <div class="form-group">
				<label for="status">Status</label>
				{status_message}
				<select name="status" id="status" class="form-control">
					<option value="draft" {status_draft}>Draft</option>
					<option value="pending" {status_pending}>Pending</option>
					<option value="published" {status_published}>Published</option>
				</select>
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
			<div class="form-group hidden-lg hidden-md">
		    	<button type="submit" class="btn btn-primary">Save</button>
		    	<button type="reset" class="btn btn-default">Cancel</button>
		    </div>
		</div>
	</form>
</div>