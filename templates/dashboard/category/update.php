<div class="row">
	<div id="page-item-container" class="col-lg-8">
    	<div class="row">
    		{template_category/item|(
				"library" : [
					"category", "read"
				]
    		)}
    	</div>
	</div>
	<div class="col-lg-4">
		{message}
    	{template_category/form/update|(
			"library" : [
				"category", "update"
			]
    	)}
	</div>
</div>