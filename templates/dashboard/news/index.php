<div class="row">
	<div class="col-lg-12">
		{template_!data|(
			"library" : [
				"news", "pagination"
			]
		)}
	</div>
</div>
<div class="row">
	<div id="panel-item-container" class="col-lg-8">
    	<div class="row">
    		{template_news/item|(
				"library" : [
					"news", "read"
				]
    		)}
    	</div>
	</div>
	<div class="col-lg-4">
    	{template_news/sidebar-right}
	</div>
</div>