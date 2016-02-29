<div id="hero" class="owl-carousel owl-theme">
    {template_home/slider-item|(
        "library" : [
            "slider", "read", (
                "is_public" : TRUE
            )
        ]
    )}
</div>

<section class="section" id="brand">
    <h2>Our Brand</h2>
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-center">
                <div class="mxn1">
                    <a href="#" class="brand__control brand__control--previous">
                        <i class="glyphicon glyphicon-triangle-left"></i>
                    </a>
                    <a href="#" class="brand__control brand__control--next">
                        <i class="glyphicon glyphicon-triangle-right"></i>
                    </a>
                    <div id="brand-carousel" class="owl-carousel owl-theme">

                        {template_home/brand-item|(
                            "library" : [
                                "brand", "read", (
                                    "is_public" : TRUE
                                )
                            ]
                        )}

                    </div>
                </div>
            </div>
            <div class="block text-center">
                <a href="{base_url}brand.html" class="btn btn-lg btn-outline--pink">See More</a>
            </div>
        </div>
    </div>
</section>

<section class="section" id="news">
    <h2>PKMA's News</h2>
    <div class="container-fluid">

        {template_home/news-item|(
            "library" : [
                "news", "read", (
                    "is_public" : TRUE,
                    "limit" : 2
                )
            ]
        )}

        <div class="block text-center">
            <a href="{base_url}news.html" class="btn btn-lg btn-outline--pink">See More</a>
        </div>
    </div>
</section>

<section class="section" id="blog">
    <h2>Blogs</h2>
    <div class="container-fluid">
        <div class="row">

            {template_home/blog-item|(
                "library" : [
                    "blog", "read", (
                        "is_public" : TRUE, "limit" : 3
                    )
                ]
            )}

        </div>
        <div class="block text-center">
            <a href="{base_url}blog.html" class="btn btn-lg btn-outline--pink">See More</a>
        </div>
    </div>
</section>

<section class="section" id="subscribe">
    <h2>Subscribe Newsletter</h2>
    <div class="container">
        <form action="#" method="POST" class="form-horizontal" role="form">
            <div class="col-sm-9 col-center">
                <div class="form-group">
                    <input type="text" name="email" id="inputEmail" class="form-control input-lg form__big--rounded" value="" required="required" pattern="" title="">
                </div>
            </div>
            <div class="form-group">
                <div class="block text-center">
                    <button type="submit" class="btn btn-lg btn-outline--pink">
                        Subscribe
                    </button>
                </div>
            </div>
        </form>
    </div>
</section>

<section class="section" id="job-board">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10 col-center job__inner text-center">
                <h2>Job Opportunity</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus eligendi dolores vel tempora, ex praesentium repudiandae perspiciatis quasi odit, numquam, deleniti maxime. Earum iste et quisquam quo tenetur tempora vero. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus eligendi dolores vel tempora, ex praesentium repudiandae perspiciatis quasi odit, numquam, deleniti maxime. Earum iste et quisquam quo tenetur tempora vero. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus eligendi dolores vel tempora, ex praesentium repudiandae perspiciatis quasi odit, numquam, deleniti maxime. Earum iste et quisquam quo tenetur tempora vero.</p>
                <a href="http://www.umm.ac.id/id/umm-jobinfo.html" class="btn btn-outline--tosca" target="_blank">See Job Opportunity</a>
            </div>
        </div>
    </div>
</section>

<section class="section" id="contact">
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-center text-center">
                <h2>Contact Us</h2>
                <div class="contact__information row">
                    <div class="col-sm-4">
                        <i class="glyphicon glyphicon-map-marker tosca"></i>
                    </div>
                    <div class="col-sm-8 text-left">
                        <div class="row">
                            <div class="col-sm-6">
                                <p>Jl. Raya Tlogomas No. 246</p>
                                <p>Malang, Jawa Timur</p>
                                <p>Indonesia</p>
                            </div>
                            <div class="col-sm-6">
                                <p>Email : hello@umm.ac.id</p>
                                <p>Telepon : +62 341 464318</p>
                                <p>Faksimile : +62 341 464318</p>
                            </div>
                        </div>
                    </div>
                </div>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Placeat nobis explicabo aut eius, illo fugit, necessitatibus quod. Ullam eum consectetur obcaecati, fugit, sint consequuntur consequatur reiciendis quod, sunt iusto vitae.</p>

                <!-- Button navigation -->
                <ul class="btn-group btn-group-justified list-unstyled btn-group-m1" role="group" aria-label="...">
                    <li class="btn-group active" role="group">
                        <a href="#signup" aria-controls="signup" role="tab" data-toggle="tab" class="btn btn-outline--tosca">
                            <i class="hidden-md hidden-lg glyphicon glyphicon-log-in"></i>
                            <span class="hidden-xs hidden-sm">Sign Up</span>
                        </a>
                    </li>
                    <li class="btn-group" role="group">
                        <a href="#maps" aria-controls="maps" role="tab" data-toggle="tab" class="btn btn-outline--tosca">
                            <i class="hidden-md hidden-lg glyphicon glyphicon-map-marker"></i>
                            <span class="hidden-xs hidden-sm">Maps</span>
                        </a>
                    </li>
                    <li class="btn-group" role="group">
                        <a href="#message" aria-controls="message" role="tab" data-toggle="tab" class="btn btn-outline--tosca">
                            <i class="hidden-md hidden-lg glyphicon glyphicon-envelope"></i>
                            <span class="hidden-xs hidden-sm">Send Message</span>
                        </a>
                    </li>
                </ul>

                <div class="tab-content text-left">
                    <div role="tabpanel" class="tab-pane active" id="signup">
                        <form action="register.html" method="POST" class="form-horizontal" role="form">
                            <input type="hidden" name="action" value="register">
                            <input type="hidden" name="{blog_csrf_name}" value="{blog_csrf_hash}">
                            <div class="form-group text-center">
                                <legend>Sign Up Form</legend>
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="" required="required">
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" name="email" id="email" class="form-control" value="" required="required">
                            </div>
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea name="message" id="message" class="form-control" rows="3" required="required"></textarea>
                            </div>
                            <div class="form-group">
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-outline--tosca">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="maps">
                        <div class="text-center">
                            <h4>Maps</h4>
                            <iframe id="map-canvas" width="100%" frameborder="0" style="border:0"src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCohjAtjotCdhEPB7-5i_m-CzDzg07vH8M&q=Universitas+Muhammadiyah+Malang" allowfullscreen></iframe>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="message">
                        <form action="" method="POST" class="form-horizontal" role="form">
                            <div class="form-group text-center">
                                <legend>Send Message Form</legend>
                            </div>
                            <div class="form-group">
                                <label for="input-id">Name</label>
                                <input type="text" name="" id="input" class="form-control" value="" required="required" pattern="" title="">
                            </div>
                            <div class="form-group">
                                <label for="input-id">Email Address</label>
                                <input type="text" name="" id="input" class="form-control" value="" required="required" pattern="" title="">
                            </div>
                            <div class="form-group">
                                <label for="input-id">Message</label>
                                <textarea name="" id="input" class="form-control" rows="3" required="required"></textarea>
                            </div>
                            <div class="form-group">
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-outline--tosca">
                                        Send Message
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
