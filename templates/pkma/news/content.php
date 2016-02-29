{template_navigation/breadcrumb}

<section class="section onepage" id="news">
    <div class="container-fluid">

        {template_home/news-item|(
            "library" : [
                "news", "read", (
                    "is_public" : TRUE,
                    "limit" : 4
                )
            ]
        )}

        <div class="block text-center">
            <nav>
                {template_!pagination|(
                    "library" : [
                        "news", "pagination", (
                            "is_public" : TRUE,
                            "limit" : 4
                        )
                    ]
                )}
            </nav>
        </div>
    </div>
</section>