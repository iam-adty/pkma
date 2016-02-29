{template_navigation/breadcrumb}

<section class="section onepage" id="brand">
	<div class="container-fluid">
		
		{template_brand/item|(
			"library" : [
				"brand", "read", (
					"limit" : 6,
					"is_public" : TRUE
				)
			]
		)}

		<div class="block text-center">
			<nav>
				{template_pagination|(
					"library" : [
						"brand", "pagination", (
							"limit" : 6,
							"is_public" : TRUE
						)
					]
				)}
			</nav>
		</div>
	</div>
</section>