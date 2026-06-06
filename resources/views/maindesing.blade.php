<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link rel="shortcut icon" href="{{ asset('front_end/images/favicon.png') }}" type="image/x-icon">
    <title>Giftos</title>

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('front_end/css/bootstrap.css') }}" />
    <link href="{{ asset('front_end/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('front_end/css/responsive.css') }}" rel="stylesheet" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>
    <div class="hero_area">
        <header class="header_section">
            <nav class="navbar navbar-expand-lg custom_nav-container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <span>Giftos</span>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class=""></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ url('/') }}">Home <span
                                    class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/shop') }}">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/why') }}">Why Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/testimonial') }}">Testimonial</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/contact') }}">Contact Us</a>
                        </li>
                    </ul>

                    <div class="user_option">
                        @if (Auth::check())
                            <a href="{{ route('dashboard') }}">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <span>Dashboard</span>
                            </a>
                        @else
                            <a href="{{ route('login') }}">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <span>Login</span>
                            </a>
                            <a href="{{ route('register') }}">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <span>Sign Up</span>
                            </a>
                        @endif

                        <a href="{{ route('cartproducts') }}">
                            <i class="fa fa-shopping-bag" aria-hidden="true">
                                <span class="badge"
                                    style="background-color: red; margin-left: 5px;">{{ $count }}</span>
                            </i>
                        </a>

                        <form class="form-inline">
                            <button class="btn nav_search-btn" type="submit">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </nav>
        </header>
        <section class="slider_section">
            <div class="slider_container">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="detail-box">
                                            <h1>Welcome To Our <br> Gift Shop</h1>
                                            <p>Sequi perspiciatis nulla reiciendis, rem, tenetur impedit, eveniet non
                                                necessitatibus error distinctio mollitia suscipit. Nostrum fugit
                                                doloribus consequatur distinctio esse.</p>
                                            <a href="{{ url('/contact') }}">Contact Us</a>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="img-box">
                                            <img style="width:600px" src="{{ asset('front_end/images/image3.jpeg') }}"
                                                alt="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <section class="shop_section layout_padding">
        <div class="container">
            @yield('index')
            @yield('product_details')
            @yield('all_products')
            @yield('viewcart_product')
            @yield('script_view')
        </div>
    </section>

    <section class="contact_section layout_padding-bottom">
        <div class="container px-0">
            <div class="heading_container">
                <h2>Contact Us</h2>
            </div>
        </div>
        <div class="container container-bg">
            <div class="row">
                <div class="col-lg-7 col-md-6 px-0">
                    <div class="map_container">
                        <div class="map-responsive" style="height: 100%; min-height: 400px;">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d27498.086581815973!2d31.137731643920905!3d30.513663064976686!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sar!2seg!4v1779989112882!5m2!1sar!2seg"
                                style="border:0; width: 100%; height:100%; min-height: 400px;" allowfullscreen=""
                                loading="lazy" referrerpolicy="no-referrer-when-downgrade" frameborder="0"></iframe>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-5 px-0">
                    <form action="#" class="contact_form_box" style="padding: 20px;">
                        <div>
                            <input type="text" placeholder="Name" />
                        </div>
                        <div>
                            <input type="email" placeholder="Email" />
                        </div>
                        <div>
                            <input type="text" placeholder="Phone" />
                        </div>
                        <div>
                            <input type="text" class="message-box" placeholder="Message" />
                        </div>
                        <div class="d-flex">
                            <button type="submit">SEND</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="info_section layout_padding2-top">
        <div class="social_container">
            <div class="social_box">
                <a href=""><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a href=""><i class="fa fa-twitter" aria-hidden="true"></i></a>
                <a href=""><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a href=""><i class="fa fa-youtube" aria-hidden="true"></i></a>
            </div>
        </div>

        <div class="info_container">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-3">
                        <h6>ABOUT US</h6>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do.</p>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="info_form">
                            <h5>Newsletter</h5>
                            <form action="#">
                                <input type="email" placeholder="Enter your email">
                                <button type="submit">Subscribe</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <h6>NEED HELP</h6>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do.</p>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <h6>CONTACT US</h6>
                        <div class="info_link-box">
                            <a href=""><i class="fa fa-map-marker" aria-hidden="true"></i> <span> Gb road 123
                                    london Uk </span></a>
                            <a href=""><i class="fa fa-phone" aria-hidden="true"></i> <span>+01
                                    12345678901</span></a>
                            <a href=""><i class="fa fa-envelope" aria-hidden="true"></i> <span>
                                    demo@gmail.com</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer_section">
            <div class="container">
                <p>
                    &copy; <span id="displayYear"></span> All Rights Reserved By
                    <a href="https://html.design/">Web Tech Knowledge</a>
                </p>
            </div>
        </footer>
    </section>

    <script src="{{ asset('front_end/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('front_end/js/bootstrap.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="{{ asset('front_end/js/custom.js') }}"></script>

    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script type="text/javascript">
        $(function() {
            var $form = $(".require-validation");
            $('form.require-validation').bind('submit', function(e) {
                var $form = $(".require-validation"),
                    inputSelector = ['input[type=email]', 'input[type=password]', 'input[type=text]',
                        'input[type=file]', 'textarea'
                    ].join(', '),
                    $inputs = $form.find('.required').find(inputSelector),
                    $errorMessage = $form.find('div.error'),
                    valid = true;

                $errorMessage.addClass('hide');
                $('.has-error').removeClass('has-error');

                $inputs.each(function(i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $errorMessage.removeClass('hide');
                        e.preventDefault();
                    }
                });

                if (!$form.data('cc-on-file')) {
                    e.preventDefault();
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    Stripe.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeResponseHandler);
                }
            });

            function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('.error').removeClass('hide').find('.alert').text(response.error.message);
                } else {
                    var token = response['id'];
                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.get(0).submit();
                }
            }
        });
    </script>
</body>

</html>
