{template_navigation/breadcrumb}

<section class="section onepage" id="blog">
    <div class="container-fluid">

        {template_home/blog-item|(
            "library" : [
                "blog", "read", (
                    "is_public" : TRUE,
                    "limit" : 6
                )
            ]
        )}

        <div class="block text-center">
            <nav>
                {template_pagination|(
                    "library" : [
                        "blog", "pagination", (
                            "is_public" : TRUE,
                            "limit" : 6
                        )
                    ]
                )}
            </nav>
        </div>
    </div>
</section>