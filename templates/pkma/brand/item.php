<article class="col-sm-4 blog__article">
	<img src="{base_url}upload/image/{post_image}" alt="" class="img-responsive center-block">
	<div class="blog__match--height">
		<img src="{base_url}upload/image/{post_logo}" alt="" class="circle-photo-custom img-circle" width="100" height="100">
		<h3 class="custom-heading">
			<a href="{base_url}brand/{post_url}.html">{post_title}</a>
		</h3>
		<div class="text-identifier ellipsis">
			<h4 class="ellipsis">
				<a href="{base_url}member/{post_author_username}">
					{post_author_name}
				</a>
			</h4>
			<small>
				<time datetime="{log_date}" pubdate="">{log_date}</time>
			</small>
		</div>
		<p>{post_content}</p>
		<a href="{base_url}brand/{post_url}.html">Read More</a>
	</div>
</article>