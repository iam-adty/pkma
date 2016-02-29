<div class="row">
	<div class="col-lg-12">
		{template_!data|(
			"library" : [
				"brand", "pagination"
			]
		)}
	</div>
</div>
<div class="row">
	<div id="panel-item-container" class="col-lg-8">
    	<div class="row">
    		{template_brand/item|(
				"library" : [
					"brand", "read"
				]
    		)}
    	</div>
	</div>
	<div class="col-lg-4">
    	{template_brand/sidebar-right}
	</div>
</div>