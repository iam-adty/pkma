<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>

<head>
    {template_meta}
    <title>Dashboard - {blog_name}</title>
    {template_style}
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12">
                <form class="form-signin" style="margin-top: 100px;" method="post" action="">
                    <input type="hidden" name="action" value="login">
                    <input type="hidden" name="{blog_csrf_name}" value="{blog_csrf_hash}">
                    <h2 class="form-signin-heading">Log In</h2>
                    {message}
                    <div class="form-group">
                        <label for="username" class="sr-only">Username</label>
                        {username_message}
                        <input style="text-align: center;" value="{username}" id="username" class="form-control" placeholder="Username" name="username">
                    </div>
                    <div class="form-group">
                        <label for="password" class="sr-only">Password</label>
                        {password_message}
                        <input style="text-align: center;" value="{password}" type="password" id="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="remember-me"> Remember me
                        </label>
                    </div>
                    <button class="btn btn-primary btn-block" type="submit">Log in</button>
                </form>
            </div>
        </div>
    </div>
    {template_script}
</body>

</html>