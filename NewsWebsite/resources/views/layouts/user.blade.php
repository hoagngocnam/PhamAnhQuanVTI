<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="Magz is a HTML5 & CSS3 magazine template is based on Bootstrap 3.">
    <meta name="author" content="Kodinger">
    <meta name="keyword" content="magz, html5, css3, template, magazine template">
    <!-- Shareable -->
    <meta property="og:title" content="HTML5 & CSS3 magazine template is based on Bootstrap 3" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="http://github.com/nauvalazhar/Magz" />
    <meta property="og:image" content="https://raw.githubusercontent.com/nauvalazhar/Magz/master/images/preview.png" />
    <title>NewsWebsite</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('scripts/bootstrap/bootstrap.min.css') }}">
    <!-- IonIcons -->
    <link rel="stylesheet" href="{{ asset('scripts/ionicons/css/ionicons.min.css') }}">
    <!-- Toast -->
    <link rel="stylesheet" href="{{ asset('scripts/toast/jquery.toast.min.css') }}">
    <!-- OwlCarousel -->
    <link rel="stylesheet" href="{{ asset('scripts/owlcarousel/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('scripts/owlcarousel/dist/assets/owl.theme.default.min.css') }}">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="{{ asset('scripts/magnific-popup/dist/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('scripts/sweetalert/dist/sweetalert.css') }}">
    <!-- Custom style -->
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
    <link rel="stylesheet" href="{{ asset('css/skins/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/demo.css') }}">
    <link rel="stylesheet" href="{{ asset('css/demo.css.map') }}">
</head>

<body class="skin-orange">
    <header class="primary">
        <div class="firstbar">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-12">
                        <div class="brand">
                            <a href="/">
                                <img src="{{asset('uploads/thumbnail/logo.png')}}" alt="Magz Logo">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <form class="search" autocomplete="off">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" name="q" class="form-control" placeholder="Nhập tin tức cần tìm">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary"><i class="ion-search"></i></button>
                                    </div>
                                </div>
                            </div>
                            @php
                            $categories = \App\Categories::all()->random(5);
                            @endphp
                            <div class="help-block">
                                <div>Phổ biến :</div>
                                @foreach($categories as $key => $cat)
                                <ul>
                                    @if($key<=5) <li><a
                                            href="{{route('detail.categories',$cat->slug)}}">{{$cat->name}}</a>
                                        </li>
                                        @endif
                                </ul>
                                @endforeach
                            </div>
                        </form>
                    </div>
                    <div class="col-md-3 col-sm-12 text-right">
                        <ul style="font-size : 14px" class="nav-icons">
                            @if(Auth::check() == false)
                            <li><a href="{{route('user.login')}}"><i class="ion-person"></i>
                                    <div>Đăng nhập</div>
                                </a></li>
                            <li><a href="{{route('user.register')}}"><i class="ion-person-add"></i>
                                    <div>Đăng ký</div>
                                </a></li>
                            @endif
                            @if (Auth::check())
                            <li>
                                <div>Xin chào, <label style="font-size:18px ;" for="">{{Auth::user()->first_name}}
                                        {{Auth::user()->last_name}}</label></div>

                            </li>
                            <a style="display:inline-block;margin-left:20px; margin-top:2px" class="dropdown-item"
                                href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Start nav -->
        <nav class="menu">
            <div class="container">
                <div class="brand">
                    <a href="/">
                        <img src="{{asset('uploads/thumbnail/logo.png')}}" alt="Magz Logo">
                    </a>
                </div>
                <div class="mobile-toggle">
                    <a href="#" data-toggle="menu" data-target="#menu-list"><i class="ion-navicon-round"></i></a>
                </div>
                <div class="mobile-toggle">
                    <a href="#" data-toggle="sidebar" data-target="#sidebar"><i class="ion-ios-arrow-left"></i></a>
                </div>
                @php
                $categories1 = \App\Categories::all();
                @endphp
                <div id="menu-list">
                    <ul class="nav-list">
                        @foreach($categories1 as $key => $cat)
                        @if($key < 11) <li class="">
                            <a href="{{route('detail.categories',$cat->slug)}}">{{$cat->name}}</a>
                            </li>
                            @endif
                            @endforeach
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End nav -->
    </header>
    @yield('content')
    <!-- Start footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="block">
                        <h1 class="block-title">Company Info</h1>
                        <div class="block-body">
                            <figure class="foot-logo">
                                <img src="{{asset('uploads/thumbnail/logo-light.png')}}" class="img-responsive"
                                    alt="Logo">
                            </figure>
                            <a href="page.html" class="btn btn-magz white">About Us <i
                                    class="ion-ios-arrow-thin-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="block">
                        <h1 class="block-title">Popular Tags <div class="right"><a href="#">See All <i
                                        class="ion-ios-arrow-thin-right"></i></a></div>
                        </h1>
                        <div class="block-body">
                            <ul class="tags">
                                <li><a href="#">HTML5</a></li>
                                <li><a href="#">CSS3</a></li>
                                <li><a href="#">Bootstrap 3</a></li>
                                <li><a href="#">Web Design</a></li>
                                <li><a href="#">Creative Mind</a></li>
                                <li><a href="#">Standing On The Train</a></li>
                                <li><a href="#">at 6.00PM</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="line"></div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="block">
                        <h1 class="block-title">Latest News</h1>
                        <div class="block-body">
                            <article class="article-mini">
                                <div class="inner">
                                    <figure>
                                        <a href="single.html">
                                            <img src="{{asset('uploads/thumbnail/news/img12.jpg')}}"
                                                alt="Sample Article">
                                        </a>
                                    </figure>
                                    <div class="padding">
                                        <h1><a href="single.html">Donec consequat lorem quis augue pharetra</a></h1>
                                    </div>
                                </div>
                            </article>
                            <article class="article-mini">
                                <div class="inner">
                                    <figure>
                                        <a href="single.html">
                                            <img src="{{asset('uploads/thumbnail/news/img14.jpg')}}"
                                                alt="Sample Article">
                                        </a>
                                    </figure>
                                    <div class="padding">
                                        <h1><a href="single.html">eu dapibus risus aliquam etiam ut venenatis</a></h1>
                                    </div>
                                </div>
                            </article>
                            <article class="article-mini">
                                <div class="inner">
                                    <figure>
                                        <a href="single.html">
                                            <img src="{{asset('uploads/thumbnail/news/img15.jpg')}}" alt=" Sample
                                                Article">
                                        </a>
                                    </figure>
                                    <div class="padding">
                                        <h1><a href="single.html">Nulla facilisis odio quis gravida vestibulum </a></h1>
                                    </div>
                                </div>
                            </article>
                            <article class="article-mini">
                                <div class="inner">
                                    <figure>
                                        <a href="single.html">
                                            <img src="{{asset('uploads/thumbnail/news/img16.jpg')}}"
                                                alt="Sample Article">
                                        </a>
                                    </figure>
                                    <div class="padding">
                                        <h1><a href="single.html">Proin venenatis pellentesque arcu vitae </a></h1>
                                    </div>
                                </div>
                            </article>
                            <a href="#" class="btn btn-magz white btn-block">See All <i
                                    class="ion-ios-arrow-thin-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-xs-12 col-sm-6">
                    <div class="block">
                        <h1 class="block-title">Follow Us</h1>
                        <div class="block-body">
                            <p>Follow us and stay in touch to get the latest news</p>
                            <ul class="social trp">
                                <li>
                                    <a href="#" class="facebook">
                                        <svg>
                                            <rect width="0" height="0" />
                                        </svg>
                                        <i class="ion-social-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="twitter">
                                        <svg>
                                            <rect width="0" height="0" />
                                        </svg>
                                        <i class="ion-social-twitter-outline"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="youtube">
                                        <svg>
                                            <rect width="0" height="0" />
                                        </svg>
                                        <i class="ion-social-youtube-outline"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="googleplus">
                                        <svg>
                                            <rect width="0" height="0" />
                                        </svg>
                                        <i class="ion-social-googleplus"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="instagram">
                                        <svg>
                                            <rect width="0" height="0" />
                                        </svg>
                                        <i class="ion-social-instagram-outline"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="tumblr">
                                        <svg>
                                            <rect width="0" height="0" />
                                        </svg>
                                        <i class="ion-social-tumblr"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="dribbble">
                                        <svg>
                                            <rect width="0" height="0" />
                                        </svg>
                                        <i class="ion-social-dribbble"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="linkedin">
                                        <svg>
                                            <rect width="0" height="0" />
                                        </svg>
                                        <i class="ion-social-linkedin"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="skype">
                                        <svg>
                                            <rect width="0" height="0" />
                                        </svg>
                                        <i class="ion-social-skype"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="rss">
                                        <svg>
                                            <rect width="0" height="0" />
                                        </svg>
                                        <i class="ion-social-rss"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="line"></div>
                    <div class="block">
                        <div class="block-body no-margin">
                            <ul class="footer-nav-horizontal">
                                <li><a href="index.html">Home</a></li>
                                <li><a href="#">Partner</a></li>
                                <li><a href="contact.html">Contact</a></li>
                                <li><a href="page.html">About</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="copyright">
                        COPYRIGHT &copy; MAGZ 2017. ALL RIGHT RESERVED.
                        <div>
                            Made with <i class="ion-heart"></i> by <a href="http://kodinger.com">Kodinger</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer -->

    <!-- JS -->

    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/jquery.migrate.js') }}"></script>
    <script src="{{ asset('scripts/bootstrap/bootstrap.min.js') }}"></script>
    <script>
    var $target_end = $(".best-of-the-week");
    </script>
    <script src="{{ asset('scripts/jquery-number/jquery.number.min.js') }}"></script>
    <script src="{{ asset('scripts/owlcarousel/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('scripts/magnific-popup/dist/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('scripts/easescroll/jquery.easeScroll.js') }}"></script>
    <script src="{{ asset('scripts/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="   {{ asset('scripts/toast/jquery.toast.min.js') }}"></script>
    <script src="{{ asset('js/demo.js') }}"></script>
    <script src="{{ asset('js/e-magz.js') }}"></script>
</body>

</html>