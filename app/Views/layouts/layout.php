<?  $session = session(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book-Store</title>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="<?= base_url('assets/css/slick.css') ?>" rel="stylesheet" />
    <link href="<?= base_url('assets/css/slick-theme.css') ?>" rel="stylesheet" />
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet" />
</head>

<body>
    <!-- header area start  -->
    <header class="py-4">
        <div class="container">
            <div class="top_header d-flex align-items-center justify-content-between">
                <div class="header_logo_area">
                    <a href="<?= base_url() ?>">
                    <img style="width: 130px;" src="<?= base_url("assets/image/icon/logo.png") ?>" alt="">
                    </a>
                </div>
                <div class="header_search">
                    <form class="form_area d-flex align-items-center" action="">
                        <div class="search_categories">
                            <select name="search_categoires" id="search_categoires">
                                <option value="-1">All Categories</option>
                                <option value="">Categories</option>
                                <option value="">Categories</option>
                                <option value="">Categories</option>
                                <option value="">Categories</option>
                                <option value="">Categories</option>
                                <option value="">Categories</option>
                                <option value="">Categories</option>
                            </select>
                        </div>
                        <div class="search_input">
                            <input type="text" name="search" id="search">
                            <div class="search_icon">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="header_signin d-flex align-items-center">
                    <?php 
                        if( !session()->has('logged_in')){
                    ?>
                    <a class="common_btn" href="<?= base_url("login") ?>">Sign in</a>
                    <?php }else{ ?>
                    <div class="dropdown">
                        <button class="custom_dropdown dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?= session('username') ?>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?= base_url("profile") ?>">My Profile</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('logout') ?>">Logout</a></li>
                        </ul>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <nav class="py-4">
                <ul>
                    <li class="rotate-on-hover"><a class="item" href="<?= base_url("authors") ?>">লেখক <i class="fa-solid fa-angle-down"></i>
                            <ul id="authors" class="nav_dropdown shadow-lg"></ul>
                        </a></li>
                    <li class="rotate-on-hover"><a class="item" href="<?= base_url("categories") ?>">বিষয় <i class="fa-solid fa-angle-down"></i>
                            <ul id="categories" class="nav_dropdown shadow-lg"></ul>
                        </a></li>
                    <li class="rotate-on-hover"><a class="item" href="<?= base_url("publishers") ?>">প্রকাশনী <i class="fa-solid fa-angle-down"></i>
                            <ul id="publishers" class="nav_dropdown shadow-lg"></ul>
                        </a></li>
                </ul>
            </nav>
        </div>
    </header>
    <!-- header area end -->

    <!-- content section start -->
    <?= $this->renderSection("content") ?>
    <!-- content section end -->

    <!-- footer area start  -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="single_footer">
                        <img class="bg-white rounded my-2" style="width: 180px;" src="<?= base_url("assets/image/icon/logo.png") ?>"  alt="">
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Suscipit, accusamus pariatur eos doloribus ea quaerat debitis recusandae magni doloremque, odio veniam obcaecati culpa eius fuga veritatis placeat rerum, alias error.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single_footer">
                        <h3>Quick Links</h3>
                        <ol>
                            <li><a href="">Home</a></li>
                            <li><a href="">Categories</a></li>
                            <li><a href="">About</a></li>
                            <li><a href="">Contact Us</a></li>
                        </ol>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single_footer">
                        <h3>Social Links</h3>
                        <ul>
                            <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer area end -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="<?= base_url("assets/js/slick.min.js") ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $('.responsive-slider').slick({
            dots: false,
            infinite: false,
            speed: 300,
            slidesToShow: 4,
            slidesToScroll: 1,
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });
    </script>
    <script>
        $(document).ready(function() {

            // Submenu item show
            function show(data, place) {
                let authors = $(`#${place}`);
                if (data.data.length) {
                    let html = ``;
                    $.each(data.data, function(index, item) {
                        html += ` <li><a href="<?= base_url() ?>${place}/${item.id}">${item.name}</a></li>`;
                    })
                    html += `<li><a href="<?= base_url() ?>${place}">See More</a></li>`;
                    authors.html(html);
                }
            }

            // Load Authors
            $.ajax({
                url: "<?= base_url("authors/get") ?>",
                type: "GET",
                success: function(data) {
                    show(data, "authors")
                }
            });

            // Load Categories
            $.ajax({
                url: "<?= base_url("categories/get") ?>",
                type: "GET",
                success: function(data) {
                    show(data, "categories")
                }
            });

            // Load Publishers
            $.ajax({
                url: "<?= base_url("publishers/get") ?>",
                type: "GET",
                success: function(data) {
                    show(data, "publishers")
                }
            });


        })
    </script>
    <?= $this->renderSection("cscript"); ?>
</body>

</html>