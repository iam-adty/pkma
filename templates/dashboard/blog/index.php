<div class="row">
	<div class="col-lg-12">
		{template_!data|(
			"library" : [
				"blog", "pagination"
			]
		)}
	</div>
</div>
<div class="row">
	<div id="panel-item-container" class="col-lg-8">
    	<div class="row">
    		{template_blog/item|(
				"library" : [
					"blog", "read"
				]
    		)}
    	</div>
	</div>
	<div class="col-lg-4">
    	{template_blog/sidebar-right}
	</div>
</div>