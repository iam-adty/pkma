{form_message}
<h4>Update Category<span class="pull-right"><a href="{dashboard_url}/category.html">Create Category</a></span></h4>
<div class="row">
	<form name="form-page-edit" id="form-page-edit" class="form" action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="action" value="update">
		<input type="hidden" name="id" value="{id}">
		<input type="hidden" name="{blog_csrf_name}" value="{blog_csrf_hash}">
		<div class="col-lg-12 col-xs-12 col-sm-12 col-md-12">
		    <div class="form-group">
				<label for="parent">Parent</label>
				{parent_message}
				<select name="parent" class="form-control">
					<option value="0">-No Parent-</option>
					{template_category/form/option-parent|(
						"library" : [
							"category", "read_parent"
						]
					)}
				</select>
			</div>
			<div class="form-group">
				<label for="name">Name</label>
				{name_message}
				<input type="text" name="name" value="{name}" class="form-control" id="name">
			</div>
			<div class="form-group">
				<label for="description">Description</label>
				{description_message}
				<textarea name="description" id="description" class="form-control autogrow-textarea">{description}</textarea>
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
		    <div class="form-group">
		    	<button type="submit" class="btn btn-primary">Save</button>
		    	<button type="reset" class="btn btn-default">Cancel</button>
		    </div>
		</div>
	</form>
</div>