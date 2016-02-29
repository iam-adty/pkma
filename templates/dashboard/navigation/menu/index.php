<div class="collapse navbar-collapse" id="adtyblog-dashboard-main-navigation">
	<ul class="nav navbar-nav">
		{template_navigation/menu/item|(
			"get" : [
				"menu", (
					"item-to-show" : ["index", "page", "post", "user", "setting", "pkma-home", "pkma-about", "pkma-news", "pkma-member", "pkma-brand", "pkma-blog"]
				)
			]
		)}
	</ul>
	<ul class="nav navbar-nav navbar-right">
		{template_navigation/menu/item|(
			"get" : [
				"menu", (
					"item-to-show" : ["account"]
				)
			]
		)}
	</ul>
	{template_navigation/search}
</div>