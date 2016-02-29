<div class="row">
	<div class="col-lg-12">
		{template_!data|(
			"library" : [
				"slider", "pagination"
			]
		)}
	</div>
</div>
<div class="row">
	<div id="panel-item-container" class="col-lg-8">
    	<div class="row">
    		{template_slider/item|(
				"library" : [
					"slider", "read"
				]
    		)}
    	</div>
	</div>
	<div class="col-lg-4">
    	{template_slider/sidebar-right}
	</div>
</div>