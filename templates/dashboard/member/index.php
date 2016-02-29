<div class="row">
	<div class="col-lg-12">
		{template_!data|(
			"library" : [
				"member", "pagination"
			]
		)}
	</div>
</div>
<div class="row">
	<div id="panel-item-container" class="col-lg-8">
    	<div class="row">
    		{template_member/item|(
				"library" : [
					"member", "read"
				]
    		)}
    	</div>
	</div>
	<div class="col-lg-4">
    	{template_member/sidebar-right}
	</div>
</div>