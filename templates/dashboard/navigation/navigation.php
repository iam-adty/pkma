<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>

<nav class="navbar navbar-default" style="position: fixed; width: 100%; z-index: 10;">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#adtyblog-dashboard-main-navigation" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="dropdown">
                <a style="cursor: pointer;" class="navbar-brand dropdown-toggle" id="adtyblog-name-dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <span class="adtyblog-dash-nav-blog-name">{blog_name}</span> <span style="padding-bottom: 10px;" class="caret"></span>
                </a>
                <ul class="dropdown-menu" aria-labelledby="adtyblog-name-dropdown-toggle">
                    <li class="dropdown-header">Go to homepage</li>
                    <li><a href="{base_url}" target="_blank"><b style="font-size: 14pt;">{blog_name}</b><br>{blog_description}</a></li>
                </ul>
            </div>
            <!-- <a class="navbar-brand" href="{base_url}" target="_blank"></a> -->
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        {template_navigation/menu/index}
    </div>
</nav>