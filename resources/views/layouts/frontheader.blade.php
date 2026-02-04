@php
$current_route = Route::currentRouteName();
$is_green = ($current_route === 'front.product.details' || $current_route === 'front.gift.details' || $current_route ===
'front.register');
@endphp

<head class="mb-3">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('public/front/images/favicon.png') }}">
    <title>HNOWW</title>
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
        rel="stylesheet">
    <!-- bootstrap css start -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <!-- slick slider  -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css"
        integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!--Aos animation-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
    <!-- style css start -->
    <link rel="stylesheet" href="{{ asset('public/front/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('public/front/css/header.css')}}">
    <link rel="stylesheet" href="{{ asset('public/front/css/home.css')}}">
    <link rel="stylesheet" href="{{ asset('public/front/css/productdetails.css')}}">
    <link rel="stylesheet" href="{{ asset('public/front/css/him.css')}}">
    <link rel="stylesheet" href="{{ asset('public/front/css/giftshop.css')}}">
    <link rel="stylesheet" href="{{ asset('public/front/css/corporate.css')}}">
    <link rel="stylesheet" href="{{ asset('public/front/css/form.css')}}">
    <link rel="stylesheet" href="{{ asset('public/front/css/faq.css')}}">
    <link rel="stylesheet" href="{{ asset('public/front/css/ceremonial.css')}}">
    <link rel="stylesheet" href="{{ asset('public/front/css/wedding-vault.css')}}">
    <link rel="stylesheet" href="{{ asset('public/front/css/blessing.css')}}">
    <link rel="stylesheet" href="{{ asset('public/front/css/atelier.css')}}">
    <link rel="stylesheet" href="{{ asset('public/front/css/wedding-vault.css')}}">
    <link rel="stylesheet" href="{{ asset('public/front/css/footer.css')}}">
    <link rel="stylesheet" href="{{ asset('public/front/css/journal.css')}}">
    <link rel="stylesheet" href="{{ asset('public/front/css/privacy.css')}}">
    <link rel="stylesheet" href="{{ asset('public/front/css/about.css')}}">
    <link rel="stylesheet" href="{{ asset('public/front/css/login-regi.css')}}">

    <!-- responsive css start -->
    <link rel="stylesheet" href="{{ asset('public/front/css/responsive.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />

    <style>
    .modal-square .modal-content {
        border-radius: 0 !important;
        /* removes rounded corners */
    }

    /*For Error Message*/
    .invalid-feedback {
        color: red;
        font-size: 15px;
        margin-top: 2px;
    }

    /* Highlight invalid input fields */
    .is-invalid {
        border-color: red;
    }

    .error {
        color: red;
    }

    #dropdownInput::placeholder {
        color: white;
    }

    /* TEMP */
    .start-100 {
        left: 52% !important;
    }

    .top-0 {
        top: 12 !important;
    }
    </style>


    @stack('style')
</head>

<body class="<?= $is_green ? 'theme-green' : 'theme-white' ?>">

    <!-- Page Loader -->
    <div id="page-loader" class="loader-overlay d-none">
        <div class="loader-box">
            <svg width="100%" height="100%" viewBox="-3 -3 70 70" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M63.2185 31.6093C63.2185 22.9261 56.3469 15.8463 47.7574 15.461C47.3826 6.87158 40.282 0 31.6093 0C22.9365 0 15.8359 6.87158 15.4611 15.461C6.88199 15.8359 0 22.9157 0 31.6093C0 40.3028 6.88199 47.3722 15.4611 47.7575C15.8463 56.3469 22.9365 63.2185 31.6093 63.2185C40.282 63.2185 47.3722 56.3365 47.7574 47.7575C56.3469 47.3826 63.2185 40.282 63.2185 31.6093ZM60.6365 30.3599H47.7887V17.9806C54.5561 18.345 60.0326 23.6549 60.6365 30.3599ZM45.2795 45.2899H32.8586V42.052C33.2751 40.5215 34.1705 38.3247 36.1174 36.3361C38.1581 34.2538 40.4278 33.3167 42.0207 32.8795H45.2587V45.2795H45.2691L45.2795 45.2899ZM17.9182 32.8586H21.1769C22.697 33.2334 24.8834 34.0872 26.8616 35.9925C29.1105 38.1581 29.9955 40.6464 30.339 42.0207V45.2691H17.9286V32.8482H17.9182V32.8586ZM17.9182 17.9286H30.3286V21.2082C30.0267 22.697 29.3083 24.8418 27.4967 26.8096C25.2791 29.2146 22.6346 30.0579 21.1874 30.3495H17.8973V17.9182H17.9077L17.9182 17.9286ZM31.6301 38.2934C30.9637 36.9608 29.9955 35.524 28.6107 34.1809C27.4551 33.0669 26.2473 32.2548 25.1021 31.6717C26.4972 30.995 27.9965 29.9955 29.3708 28.5066C30.4328 27.351 31.1928 26.1432 31.7238 24.9875C32.4526 26.3515 33.4937 27.8195 34.9617 29.1626C35.9821 30.11 37.1482 30.9221 38.3871 31.5676C37.0649 32.2443 35.6385 33.1918 34.3162 34.5557C33.1293 35.7947 32.2548 37.0857 31.6301 38.2934ZM42.052 30.3599C40.6256 29.9434 38.5745 29.0793 36.6796 27.3405C34.4203 25.2582 33.3688 22.8636 32.869 21.1769V17.9494H45.2899V30.3703H42.052V30.3599ZM45.2379 15.4298H32.8586V2.58205C39.5532 3.18591 44.8735 8.66235 45.2379 15.4298ZM30.3495 2.58205V15.4298H17.9702C18.3346 8.66235 23.6445 3.18591 30.3495 2.58205ZM15.4194 17.9702V30.3495H2.57164C3.1755 23.6549 8.65194 18.345 15.4194 17.9702ZM2.57164 32.8586H15.4194V45.2379C8.65194 44.8735 3.1755 39.5636 2.57164 32.8586ZM17.9598 47.7887H30.339V60.6365C23.6549 60.0326 18.345 54.5561 17.9598 47.7887ZM32.8586 60.6365V47.7887H45.2379C44.8735 54.5561 39.5636 60.0222 32.8586 60.6365ZM47.7887 45.2379V32.8586H60.6365C60.0326 39.5636 54.5561 44.8735 47.7887 45.2379Z"
                    fill="#D0C2AA" />
            </svg>

        </div>
    </div>

    <header class="sticky-header <?= $is_green ? 'theme-green' : 'theme-white' ?>">

        <nav class="navbar navbar-expand-lg">
            <div class="navbar_left">
                <a href="{{ route('front.home') }}"><img class="header_logo" src="{{ $is_green 
                            ? asset('public/front/images/header-green.svg') 
                            : asset('public/front/images/header-logo.svg') }}" alt="Logo"></a>
            </div>
            <span class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
                aria-label="Toggle navigation">
                <span class="toggler-icon"></span>
            </span>

            <div class="collapse navbar-collapse justify-content-between" id="mainNavbar">
                <ul class="mx-auto nav_links">
                    <li>
                        <a href="{{ route('front.list', 'for-her') }}" data-text="for her">
                            <span>for her</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('front.list', 'for-him') }}" data-text="for him">
                            <span>for him</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('front.list', 'for-home') }}" data-text="for home">
                            <span>for home</span>
                        </a>
                    </li>

                    <li class="has-dropdown">
                        <a href="#" data-text="The Worlds">
                            <span>The Worlds</span>
                            <!-- SVG ARROW -->
                            <svg class="dropdown-arrow" width="12" height="8" viewBox="0 0 12 8" fill="none">
                                <path d="M1 1L6 6L11 1" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            </svg>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#">The Architect’s Study</a></li>
                            <li><a href="#">The The Desert Rose</a></li>
                            <li><a href="#">The Modern Majlis</a></li>
                            <li><a href="#">The Ritual Table</a></li>
                            <li><a href="#">The Table As Landscape</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('front.atelier') }}" data-text="the atelier">
                            <span>the atelier</span>
                        </a>
                    </li>

                    <!-- @auth
                    <li class="has-dropdown">
                        <a href="#" data-text="My Account">
                            <span>My Account</span>
                            <svg class="dropdown-arrow" width="12" height="8" viewBox="0 0 12 8" fill="none">
                                <path d="M1 1L6 6L11 1" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            </svg>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#">My Profile</a></li>
                            <li><a href="#">My Orders</a></li>
                            {{-- <li><a href="#">My Wishlist</a></li> --}}
                            <li><a href="{{route('front.logout')}}">Logout</a></li>
                        </ul>
                    </li>
                    @else
                    <li>
                        <a href="{{ route('front.login') }}" data-text="Login">
                            <span>Login </span>
                        </a>
                        <a href="{{ route('front.register') }}" data-text="Register">
                            <span>Register</span>
                        </a>
                    </li>
                    @endauth

                    @auth
                    <li class="cart-menu">
                        <a href="{{ route('front.cart.view') }}" class="d-flex align-items-center position-relative">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                class="bi bi-cart" viewBox="0 0 16 16">
                                <path
                                    d="M0 1.5A.5.5 0 0 1 .5 1h1a.5.5 0 0 1 .485.379L2.89 5H14.5a.5.5 0 0 1 .49.598l-1.5 7A.5.5 0 0 1 13 13H4a.5.5 0 0 1-.491-.408L1.01 1.607 0 1.5zm3.14 4l1.25 5.5H13l1.25-5.5H3.14zM5.5 14a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                            </svg>
                            <span id="cart-count"
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ \App\Models\Cart::where('user_id', auth()->id())->sum('quantity') ?? 0 }}
                            </span>
                        </a>
                    </li>
                    @endauth -->
                </ul>
                <!-- <div class="navbar_right">
                    <a href=""><img
                            src=" <?= $is_green ? asset('public/front/images/serach-icon-black.svg') : asset('public/front/images/search-icon.svg') ?>"
                        alt="Search"></a>
                    <a href=""><img
                            src="<?= $is_green ? asset('public/front/images/user-icon-black.svg') : asset('public/front/images/user-icon.svg') ?>"
                            alt="User"></a>
                    <a href=""><img
                            src="<?= $is_green ? asset('public/front/images/cart-icon-black.svg') : asset('public/front/images/cart-icon.svg') ?>"
                            alt="Cart"></a>
                </div> -->

                <div class="navbar_right">

                    <!-- Search Dropdown -->
                    <!-- <div class="search_dropdown">
                    <a href="javascript:void(0)" class="search_icon">
                        <img src=" <?= $is_green ? asset('public/front/images/serach-icon-black.svg') : asset('public/front/images/search-icon.svg') ?>"
                            alt="Search">
                    </a>

                    <div class="search_box">
                        <input type="text" placeholder="Search here...">
                        <button type="button">Search</button>
                    </div>
                </div> -->

                    <!-- User Dropdown -->
                    <div class="user_dropdown">
                        <a href="javascript:void(0)" class="user_icon">
                            <img src="<?= $is_green ? asset('public/front/images/user-icon-black.svg') : asset('public/front/images/user-icon.svg') ?>"
                                alt="User">
                        </a>


                        @auth
                        <div class="user_menu">

                            <a href="#">My Profile</a>
                            <a href="#">My Orders</a>
                            <!-- <a href="#">My Wishlist</a> -->
                            <a href="{{ route('front.logout') }}">Logout</a>
                        </div>
                        @else
                        <div class="user_menu">
                            <a href="{{ route('front.login') }}">Login</a>
                            <a href="{{ route('front.register') }}">Register</a>
                        </div>
                        @endauth


                    </div>
                    <!-- Cart with Badge -->
                    <a href="cart.php" class="cart_icon">
                        <img src="<?= $is_green ? asset('public/front/images/cart-icon-black.svg') : asset('public/front/images/cart-icon.svg') ?>"
                            alt="Cart">
                        <span class="cart_badge">3</span>
                    </a>

                    <div class="language-select ms-lg-3">
                    <svg width="20" height="20" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M16 28C18.66 27.9998 21.2446 27.1163 23.348 25.488C25.4515 23.8598 26.9546 21.5791 27.6213 19.004M16 28C13.34 27.9998 10.7554 27.1163 8.65197 25.488C6.54854 23.8598 5.04544 21.5791 4.37867 19.004M16 28C19.3133 28 22 22.6267 22 16C22 9.37334 19.3133 4 16 4M16 28C12.6867 28 10 22.6267 10 16C10 9.37334 12.6867 4 16 4M27.6213 19.004C27.868 18.044 28 17.0373 28 16C28.0033 13.9361 27.4718 11.9067 26.4573 10.1093M27.6213 19.004C24.0656 20.9752 20.0656 22.0064 16 22C11.784 22 7.82267 20.9133 4.37867 19.004M4.37867 19.004C4.12633 18.0226 3.9991 17.0133 4 16C4 13.86 4.56 11.8493 5.54267 10.1093M16 4C18.1283 3.99911 20.2186 4.56448 22.0563 5.63809C23.894 6.71169 25.4129 8.25489 26.4573 10.1093M16 4C13.8717 3.99911 11.7814 4.56448 9.94375 5.63809C8.10606 6.71169 6.58708 8.25489 5.54267 10.1093M26.4573 10.1093C23.5542 12.6239 19.8407 14.0055 16 14C12.0027 14 8.34667 12.5333 5.54267 10.1093"
                            stroke="#ffffff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>

                    <div class="dropdown-wrapper notranslate">
                        <input type="text" id="dropdownInput" class="dropdown-input-lan" placeholder="Select Language"
                            readonly />
                        <div class="dropdown-list" id="dropdownList">
                            <div class="search-box">
                                <input type="text" id="searchInput" placeholder="Search language..." />
                            </div>
                            <div class="list-items" id="listItems"></div>
                        </div>
                    </div>
                    <div id="google_translate_element" style="display:none;"></div>
                </div>

                </div>

                
            </div>

        </nav>
    </header>
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Offcanvas</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div>
                Some text as placeholder. In real life you can have the elements you have chosen. Like, text,
                images,
                lists, etc.
            </div>
            <div class="dropdown mt-3">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    Dropdown button
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
            </div>
        </div>
    </div>


    <div class="header_login_mess">
        @include('admin.includes.messages')
    </div>


    <script>
    // Your languages array (unchanged)
    const languages = [{
            code: 'ar',
            name: 'العربية (Arabic)'
        }, {
            code: 'ru',
            name: 'Русский (Russian)'
        }, {
            code: 'af',
            name: 'Afrikaans'
        }, {
            code: 'sq',
            name: 'Shqip (Albanian)'
        }, {
            code: 'am',
            name: 'አማርኛ (Amharic)'
        }, {
            code: 'hy',
            name: 'Հայերեն (Armenian)'
        }, {
            code: 'az',
            name: 'Azərbaycan (Azerbaijani)'
        }, {
            code: 'eu',
            name: 'Euskara (Basque)'
        }, {
            code: 'be',
            name: 'Беларуская (Belarusian)'
        }, {
            code: 'bn',
            name: 'বাংলা (Bengali)'
        }, {
            code: 'bs',
            name: 'Bosanski (Bosnian)'
        },
        {
            code: 'bg',
            name: 'Български (Bulgarian)'
        }, {
            code: 'ca',
            name: 'Català (Catalan)'
        }, {
            code: 'ceb',
            name: 'Cebuano'
        }, {
            code: 'ny',
            name: 'Chichewa'
        }, {
            code: 'zh-CN',
            name: '中文 (Chinese Simplified)'
        }, {
            code: 'zh-TW',
            name: '中文繁體 (Chinese Traditional)'
        }, {
            code: 'co',
            name: 'Corsican'
        }, {
            code: 'hr',
            name: 'Hrvatski (Croatian)'
        }, {
            code: 'cs',
            name: 'Čeština (Czech)'
        }, {
            code: 'da',
            name: 'Dansk (Danish)'
        },
        {
            code: 'nl',
            name: 'Nederlands (Dutch)'
        }, {
            code: 'en',
            name: 'English'
        }, {
            code: 'eo',
            name: 'Esperanto'
        }, {
            code: 'et',
            name: 'Eesti (Estonian)'
        }, {
            code: 'tl',
            name: 'Filipino'
        }, {
            code: 'fi',
            name: 'Suomi (Finnish)'
        }, {
            code: 'fr',
            name: 'Français (French)'
        }, {
            code: 'fy',
            name: 'Frysk (Frisian)'
        }, {
            code: 'gl',
            name: 'Galego (Galician)'
        }, {
            code: 'ka',
            name: 'ქართული (Georgian)'
        },
        {
            code: 'de',
            name: 'Deutsch (German)'
        }, {
            code: 'el',
            name: 'Ελληνικά (Greek)'
        }, {
            code: 'gu',
            name: 'ગુજરાતી (Gujarati)'
        }, {
            code: 'ht',
            name: 'Kreyòl ayisyen (Haitian Creole)'
        }, {
            code: 'ha',
            name: 'Hausa'
        }, {
            code: 'haw',
            name: 'ʻŌlelo Hawaiʻi (Hawaiian)'
        }, {
            code: 'he',
            name: 'עברית (Hebrew)'
        }, {
            code: 'hi',
            name: 'हिन्दी (Hindi)'
        }, {
            code: 'hmn',
            name: 'Hmong'
        }, {
            code: 'hu',
            name: 'Magyar (Hungarian)'
        },
        {
            code: 'is',
            name: 'Íslenska (Icelandic)'
        }, {
            code: 'ig',
            name: 'Igbo'
        }, {
            code: 'id',
            name: 'Bahasa Indonesia'
        }, {
            code: 'ga',
            name: 'Gaeilge (Irish)'
        }, {
            code: 'it',
            name: 'Italiano (Italian)'
        }, {
            code: 'ja',
            name: '日本語 (Japanese)'
        }, {
            code: 'jw',
            name: 'Javanese'
        }, {
            code: 'kn',
            name: 'ಕನ್ನಡ (Kannada)'
        }, {
            code: 'kk',
            name: 'Қазақ тілі (Kazakh)'
        }, {
            code: 'km',
            name: 'Khmer (ភាសាខ្មែរ)'
        },
        {
            code: 'rw',
            name: 'Kinyarwanda'
        }, {
            code: 'ko',
            name: '한국어 (Korean)'
        }, {
            code: 'ku',
            name: 'Kurdî (Kurdish)'
        }, {
            code: 'ky',
            name: 'Кыргызча (Kyrgyz)'
        }, {
            code: 'lo',
            name: 'ລາວ (Lao)'
        }, {
            code: 'la',
            name: 'Latina (Latin)'
        }, {
            code: 'lv',
            name: 'Latviešu (Latvian)'
        }, {
            code: 'lt',
            name: 'Lietuvių (Lithuanian)'
        }, {
            code: 'lb',
            name: 'Lëtzebuergesch (Luxembourgish)'
        }, {
            code: 'mk',
            name: 'Македонски (Macedonian)'
        },
        {
            code: 'mg',
            name: 'Malagasy'
        }, {
            code: 'ms',
            name: 'Bahasa Melayu (Malay)'
        }, {
            code: 'ml',
            name: 'മലയാളം (Malayalam)'
        }, {
            code: 'mt',
            name: 'Malti (Maltese)'
        }, {
            code: 'mi',
            name: 'Māori'
        }, {
            code: 'mr',
            name: 'मराठी (Marathi)'
        }, {
            code: 'mn',
            name: 'Монгол (Mongolian)'
        }, {
            code: 'my',
            name: 'မြန်မာစာ (Myanmar/Burmese)'
        }, {
            code: 'ne',
            name: 'नेपाली (Nepali)'
        }, {
            code: 'no',
            name: 'Norsk (Norwegian)'
        },
        {
            code: 'or',
            name: 'ଓଡ଼ିଆ (Odia)'
        }, {
            code: 'ps',
            name: 'پښتو (Pashto)'
        }, {
            code: 'fa',
            name: 'فارسی (Persian)'
        }, {
            code: 'pl',
            name: 'Polski (Polish)'
        }, {
            code: 'pt',
            name: 'Português (Portuguese)'
        }, {
            code: 'pa',
            name: 'ਪੰਜਾਬੀ (Punjabi)'
        }, {
            code: 'ro',
            name: 'Română (Romanian)'
        }, {
            code: 'sm',
            name: 'Gagana Sāmoa (Samoan)'
        }, {
            code: 'gd',
            name: 'Gàidhlig (Scots Gaelic)'
        },
        {
            code: 'sr',
            name: 'Српски (Serbian)'
        }, {
            code: 'st',
            name: 'Sesotho'
        }, {
            code: 'sn',
            name: 'Shona'
        }, {
            code: 'sd',
            name: 'سنڌي (Sindhi)'
        }, {
            code: 'si',
            name: 'සිංහල (Sinhala)'
        }, {
            code: 'sk',
            name: 'Slovenčina (Slovak)'
        }, {
            code: 'sl',
            name: 'Slovenščina (Slovenian)'
        }, {
            code: 'so',
            name: 'Soomaali (Somali)'
        }, {
            code: 'es',
            name: 'Español (Spanish)'
        }, {
            code: 'su',
            name: 'Sundanese'
        },
        {
            code: 'sw',
            name: 'Kiswahili (Swahili)'
        }, {
            code: 'sv',
            name: 'Svenska (Swedish)'
        }, {
            code: 'tg',
            name: 'Тоҷикӣ (Tajik)'
        }, {
            code: 'ta',
            name: 'தமிழ் (Tamil)'
        }, {
            code: 'tt',
            name: 'Татар (Tatar)'
        }, {
            code: 'te',
            name: 'తెలుగు (Telugu)'
        }, {
            code: 'th',
            name: 'ไทย (Thai)'
        }, {
            code: 'tr',
            name: 'Türkçe (Turkish)'
        }, {
            code: 'tk',
            name: 'Türkmençe (Turkmen)'
        }, {
            code: 'uk',
            name: 'Українська (Ukrainian)'
        },
        {
            code: 'ur',
            name: 'اردو (Urdu)'
        }, {
            code: 'ug',
            name: 'ئۇيغۇرچە (Uyghur)'
        }, {
            code: 'uz',
            name: 'Oʻzbek (Uzbek)'
        }, {
            code: 'vi',
            name: 'Tiếng Việt (Vietnamese)'
        }, {
            code: 'cy',
            name: 'Cymraeg (Welsh)'
        }, {
            code: 'xh',
            name: 'isiXhosa (Xhosa)'
        }, {
            code: 'yi',
            name: 'ייִדיש (Yiddish)'
        }, {
            code: 'yo',
            name: 'Yorùbá'
        }, {
            code: 'zu',
            name: 'isiZulu (Zulu)'
        }
    ];

    const dropdownInput = document.getElementById('dropdownInput');
    const dropdownList = document.getElementById('dropdownList');
    const listItems = document.getElementById('listItems');
    const searchInput = document.getElementById('searchInput');

    // Render language list
    function renderList(langList) {
        listItems.innerHTML = '';
        langList.forEach(lang => {
            const div = document.createElement('div');
            div.textContent = lang.name;
            div.dataset.code = lang.code;
            div.addEventListener('click', () => {
                dropdownInput.value = lang.name;
                dropdownList.classList.remove('show');
                changeLanguage(lang.code);
            });
            listItems.appendChild(div);
        });
    }

    renderList(languages);

    // Search filter
    searchInput.addEventListener('input', () => {
        const term = searchInput.value.toLowerCase();
        const filtered = languages.filter(l => l.name.toLowerCase().includes(term));
        renderList(filtered);
    });

    // Toggle dropdown
    dropdownInput.addEventListener('click', (e) => {
        e.stopPropagation();
        dropdownList.classList.toggle('show');
    });

    // Close when clicking outside
    document.addEventListener('click', (e) => {
        if (!e.target.closest('.language-select')) {
            dropdownList.classList.remove('show');
        }
    });

    // Change language with delay for cookie to apply
    function changeLanguage(langCode) {
        if (!langCode) return;

        // Clear old cookie
        document.cookie = 'googtrans=; expires=Thu, 01 Jan 1970 00:00:01 GMT; path=/;';

        // Set new cookie
        const cookieValue = langCode === 'en' ? '/en/en' : `/en/${langCode}`;
        document.cookie = `googtrans=${cookieValue}; path=/; domain=${location.hostname}; SameSite=Lax`;

        // Small delay → reload
        setTimeout(() => {
            window.location.reload(true);
        }, 400);
    }

    // Google Translate init
    window.googleTranslateElementInit = function() {
        new google.translate.TranslateElement({
            pageLanguage: 'en',
            includedLanguages: languages.map(l => l.code).join(','),
            layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
            autoDisplay: false
        }, 'google_translate_element');
    };

    // Load saved language on page load
    window.addEventListener('load', () => {
        const cookie = document.cookie.split('; ').find(row => row.startsWith('googtrans='));
        if (cookie) {
            const parts = cookie.split('=');
            const value = parts[1];
            const langCode = value.split('/')[2];
            const lang = languages.find(l => l.code === langCode);
            if (lang) {
                dropdownInput.value = lang.name;
            } else {
                dropdownInput.value = 'Select Language';
            }
        }
    });
    </script>


    <!-- Load Google Translate -->
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script>