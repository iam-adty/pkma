<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>

<head>
    {template_meta}
    <title>Dashboard - {blog_name}</title>
    {template_style}
</head>

<body>
    {template_navigation}
    <div class="container-fluid" style="padding-top: 75px;">
        <div class="row">
            <div class="col-lg-12">
            	{content}
            </div>
        </div>
    </div>
    {template_script}
</body>

</html>