@extends('layouts.web')

@section('main-content')

    <body
        class="home page-template-default page page-id-1175 wp-custom-logo wp-embed-responsive slideout-enabled slideout-mobile sticky-menu-fade sticky-enabled desktop-sticky-menu no-sidebar nav-float-right one-container header-aligned-left dropdown-hover full-width-content"
        itemtype="https://schema.org/WebPage" itemscope="">
        <a class="screen-reader-text skip-link" href="#content" title="Skip to content">Skip to content</a>
        <header class="site-header has-inline-mobile-toggle" id="masthead" aria-label="Site"
            itemtype="https://schema.org/WPHeader" itemscope="">
            <div class="inside-header grid-container">
                <div class="site-logo">
                    <a href="https://www.arbihunt.com/" rel="home">
                        <img class="header-image is-logo-image" alt="ArbiHunt – Crypto Arbitrage Scanner"
                            src="images/cropped-arbihuntlogo-black.png" width="417" height="88">
                    </a>
                </div>
                <nav class="main-navigation mobile-menu-control-wrapper" id="mobile-menu-control-wrapper"
                    aria-label="Mobile Toggle">
                    <div class="menu-bar-items">
                        <a class="gb-button gb-button-8a17cab7 gb-button-text hide-on-mobile"
                            href="https://app.arbihunt.com/" target="_blank" rel="noopener noreferrer">LOGIN/SIGNUP</a>
                    </div> <button data-nav="site-navigation" class="menu-toggle" aria-controls="generate-slideout-menu"
                        aria-expanded="false">
                        <span class="gp-icon icon-menu-bars"><svg viewBox="0 0 512 512" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="1em" height="1em">
                                <path
                                    d="M0 96c0-13.255 10.745-24 24-24h464c13.255 0 24 10.745 24 24s-10.745 24-24 24H24c-13.255 0-24-10.745-24-24zm0 160c0-13.255 10.745-24 24-24h464c13.255 0 24 10.745 24 24s-10.745 24-24 24H24c-13.255 0-24-10.745-24-24zm0 160c0-13.255 10.745-24 24-24h464c13.255 0 24 10.745 24 24s-10.745 24-24 24H24c-13.255 0-24-10.745-24-24z">
                                </path>
                            </svg><svg viewBox="0 0 512 512" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="1em" height="1em">
                                <path
                                    d="M71.029 71.029c9.373-9.372 24.569-9.372 33.942 0L256 222.059l151.029-151.03c9.373-9.372 24.569-9.372 33.942 0 9.372 9.373 9.372 24.569 0 33.942L289.941 256l151.03 151.029c9.372 9.373 9.372 24.569 0 33.942-9.373 9.372-24.569 9.372-33.942 0L256 289.941l-151.029 151.03c-9.373 9.372-24.569 9.372-33.942 0-9.372-9.373-9.372-24.569 0-33.942L222.059 256 71.029 104.971c-9.372-9.373-9.372-24.569 0-33.942z">
                                </path>
                            </svg></span><span class="screen-reader-text">Menu</span> </button>
                </nav>
                <nav class="has-sticky-branding main-navigation has-menu-bar-items sub-menu-right" id="site-navigation"
                    aria-label="Primary" itemtype="https://schema.org/SiteNavigationElement" itemscope="">
                    <div class="inside-navigation grid-container">
                        <div class="navigation-branding">
                            <div class="sticky-navigation-logo">
                                <a href="https://www.arbihunt.com/" title="ArbiHunt – Crypto Arbitrage Scanner"
                                    rel="home">
                                    <img src="images/cropped-arbihuntlogo-black.png" class="is-logo-image"
                                        alt="ArbiHunt – Crypto Arbitrage Scanner" width="417" height="88">
                                </a>
                            </div>
                        </div> <button class="menu-toggle" aria-controls="generate-slideout-menu" aria-expanded="false">
                            <span class="gp-icon icon-menu-bars"><svg viewBox="0 0 512 512" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="1em" height="1em">
                                    <path
                                        d="M0 96c0-13.255 10.745-24 24-24h464c13.255 0 24 10.745 24 24s-10.745 24-24 24H24c-13.255 0-24-10.745-24-24zm0 160c0-13.255 10.745-24 24-24h464c13.255 0 24 10.745 24 24s-10.745 24-24 24H24c-13.255 0-24-10.745-24-24zm0 160c0-13.255 10.745-24 24-24h464c13.255 0 24 10.745 24 24s-10.745 24-24 24H24c-13.255 0-24-10.745-24-24z">
                                    </path>
                                </svg><svg viewBox="0 0 512 512" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="1em" height="1em">
                                    <path
                                        d="M71.029 71.029c9.373-9.372 24.569-9.372 33.942 0L256 222.059l151.029-151.03c9.373-9.372 24.569-9.372 33.942 0 9.372 9.373 9.372 24.569 0 33.942L289.941 256l151.03 151.029c9.372 9.373 9.372 24.569 0 33.942-9.373 9.372-24.569 9.372-33.942 0L256 289.941l-151.029 151.03c-9.373 9.372-24.569 9.372-33.942 0-9.372-9.373-9.372-24.569 0-33.942L222.059 256 71.029 104.971c-9.372-9.373-9.372-24.569 0-33.942z">
                                    </path>
                                </svg></span><span class="screen-reader-text">Menu</span> </button>
                        <div id="primary-menu" class="main-nav">
                            <ul id="menu-main" class=" menu sf-menu">
                                <li id="menu-item-383"
                                    class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-1175 current_page_item menu-item-383">
                                    <a href="https://www.arbihunt.com/" aria-current="page">Home</a>
                                </li>
                                <li id="menu-item-385"
                                    class="menu-item menu-item-type-post_type menu-item-object-page menu-item-385"><a
                                        href="https://www.arbihunt.com/contact/">Got Questions?</a></li>
                            </ul>
                        </div>
                        <div class="menu-bar-items">
                            <a class="gb-button gb-button-8a17cab7 gb-button-text hide-on-mobile"
                                href="https://app.arbihunt.com/" target="_blank" rel="noopener noreferrer">LOGIN/SIGNUP</a>
                        </div>
                    </div>
                </nav>
            </div>
        </header>

        <div class="site grid-container container hfeed" id="page">
            <div class="site-content" id="content">

                <div class="content-area" id="primary">
                    <main class="site-main" id="main">

                        <article id="post-1175" class="post-1175 page type-page status-publish"
                            itemtype="https://schema.org/CreativeWork" itemscope="">
                            <div class="inside-article">

                                <div class="entry-content" itemprop="text">
                                    <section class="gb-container gb-container-fc3a6f7c">
                                        <div class="gb-container gb-container-a27f440a">
                                            <div class="gb-container gb-container-b096a21c">

                                                <h1 class="gb-headline gb-headline-8baca67d gb-headline-text">
                                                    Cryptocurrency Arbitrage Scanner</h1>



                                                <h2 class="gb-headline gb-headline-36f75209 gb-headline-text">
                                                   The future of crypto is smart!</h2>



                                                <p class="gb-headline gb-headline-b4372897 gb-headline-text">Unleash the
                                                    power of real-time arbitrage opportunities with ArbiHunt. Our
                                                    cutting-edge app scans top cryptocurrency exchanges, alerting you to
                                                    lucrative price differences to profit from.</p>



                                                <a class="gb-button gb-button-0743fed5" href="https://app.arbihunt.com/"
                                                    target="_blank" rel="noopener noreferrer"><span class="gb-icon"><svg
                                                            aria-hidden="true" role="img" height="1em"
                                                            width="1em" viewBox="0 0 496 512"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path fill="currentColor"
                                                                d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 18.8-35.4 55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z">
                                                            </path>
                                                        </svg></span><span class="gb-button-text">LOGIN/SIGNUP TO Web
                                                        App</span></a>



                                                <a class="gb-button gb-button-fd6804a5"
                                                    href="https://play.google.com/store/apps/details?id=com.digitalwarriors.arbihunt"
                                                    target="_blank" rel="noopener noreferrer"><span class="gb-icon"><svg
                                                            viewBox="0 0 30 30" height="100" width="100" y="0px"
                                                            x="0px" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M 9.6777344 1.515625 A 0.50005 0.50005 0 0 0 9.28125 2.3046875 L 10.759766 4.4414062 C 9.3401698 5.5292967 8.3458783 7.145415 8.0800781 9 L 21.919922 9 C 21.654122 7.145415 20.65983 5.5292967 19.240234 4.4414062 L 20.71875 2.3046875 A 0.50005 0.50005 0 0 0 20.306641 1.515625 A 0.50005 0.50005 0 0 0 19.896484 1.7363281 L 18.40625 3.8925781 C 17.398252 3.3277312 16.238794 3 15 3 C 13.761206 3 12.601748 3.3277312 11.59375 3.8925781 L 10.103516 1.7363281 A 0.50005 0.50005 0 0 0 9.6777344 1.515625 z M 12 5 C 12.552 5 13 5.448 13 6 C 13 6.552 12.552 7 12 7 C 11.448 7 11 6.552 11 6 C 11 5.448 11.448 5 12 5 z M 18 5 C 18.552 5 19 5.448 19 6 C 19 6.552 18.552 7 18 7 C 17.448 7 17 6.552 17 6 C 17 5.448 17.448 5 18 5 z M 5 11 C 4.448 11 4 11.448 4 12 L 4 20 C 4 20.552 4.448 21 5 21 C 5.552 21 6 20.552 6 20 L 6 12 C 6 11.448 5.552 11 5 11 z M 8 11 L 8 21 C 8 22.105 8.895 23 10 23 L 10 26.5 C 10 27.328 10.672 28 11.5 28 C 12.328 28 13 27.328 13 26.5 L 13 23 L 17 23 L 17 26.5 C 17 27.328 17.672 28 18.5 28 C 19.328 28 20 27.328 20 26.5 L 20 23 C 21.105 23 22 22.105 22 21 L 22 11 L 8 11 z M 25 11 C 24.448 11 24 11.448 24 12 L 24 20 C 24 20.552 24.448 21 25 21 C 25.552 21 26 20.552 26 20 L 26 12 C 26 11.448 25.552 11 25 11 z">
                                                            </path>
                                                        </svg></span><span class="gb-button-text">Android app</span></a>



                                                <a class="gb-button gb-button-ee6fd49b"
                                                    href="https://apps.apple.com/us/app/arbihunt-by-digital-warriors/id6469056735"
                                                    target="_blank" rel="noopener noreferrer"><span class="gb-icon"><svg
                                                            viewBox="0 0 18 21" fill="currentColor"
                                                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                                            class="w-6 h-6 text-gray-800 dark:text-white">
                                                            <path
                                                                d="M14.537 10.625a4.421 4.421 0 0 0 2.684 4.047 10.96 10.96 0 0 1-1.384 2.845c-.834 1.218-1.7 2.432-3.062 2.457-1.339.025-1.769-.794-3.3-.794s-2.009.769-3.275.82c-1.316.049-2.317-1.318-3.158-2.532C1.323 14.984.01 10.451 1.772 7.391a4.9 4.9 0 0 1 4.139-2.507c1.292-.025 2.511.869 3.3.869.789 0 2.271-1.075 3.828-.917A4.67 4.67 0 0 1 16.7 6.82a4.524 4.524 0 0 0-2.161 3.805M12.02 3.193A4.4 4.4 0 0 0 13.06 0a4.482 4.482 0 0 0-2.946 1.516 4.185 4.185 0 0 0-1.061 3.093 3.708 3.708 0 0 0 2.967-1.416Z">
                                                            </path>
                                                        </svg></span><span class="gb-button-text">iOS app</span></a>

                                            </div>
                                        </div>
                                    </section>

                                    <section class="gb-container gb-container-94c6ef1a">
                                        <div class="gb-container gb-container-eafa3e9e">
                                            <div class="gb-container gb-container-4b5fac27">

                                                <p class="gb-headline gb-headline-6b1cfa00 gb-headline-text">At ArbiHunt,
                                                    we scan 5,300+ pairs across 14 top crypto exchanges so you can seize
                                                    arbitrage opportunities in real-time. Your path to profit starts here!
                                                </p>

                                            </div>
                                        </div>
                                    </section>
                                </div>

                            </div>
                        </article>
                    </main>
                </div>


            </div>
        </div>


        <div class="site-footer">
            <footer class="gb-container gb-container-4bc5556e">
                <div class="gb-container gb-container-bbab8404">
                    <div class="gb-grid-wrapper gb-grid-wrapper-953a594b">
                        <div class="gb-grid-column gb-grid-column-c3240eab">
                            <div class="gb-container gb-container-c3240eab">

                                <h2 class="gb-headline gb-headline-3f8ea196 gb-headline-text">ARBIHUNT</h2>



                                <p class="gb-headline gb-headline-e347d72f gb-headline-text">Discover profitable
                                    cryptocurrency arbitrage opportunities across top exchanges with ArbiHunt. Our powerful
                                    tools and real-time data empower you to make informed decisions in the fast-paced world
                                    of digital assets. Start your journey to financial success today.</p>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="gb-container gb-container-589f6540">

                    <p class="gb-headline gb-headline-5ad40171 gb-headline-text">2024 ArbiHunt - All Rights Reserved</p>


                    <div class="gb-container gb-container-36412dcb">

                        <p class="gb-headline gb-headline-33c832d3 gb-headline-text"><a
                                href="https://www.arbihunt.com/privacy-policy/" data-type="page" data-id="3">Privacy
                                policy</a></p>



                        <p class="gb-headline gb-headline-635549e2 gb-headline-text"><a
                                href="https://www.arbihunt.com/terms-of-use/" data-type="page" data-id="1256">Terms of
                                Use</a></p>



                        <p class="gb-headline gb-headline-4eb5ae28 gb-headline-text"><a
                                href="https://www.arbihunt.com/contact/" data-type="page" data-id="163">Contact Us</a>
                        </p>

                    </div>
                </div>
            </footer>
        </div>

        <nav id="generate-slideout-menu" class="main-navigation slideout-navigation"
            itemtype="https://schema.org/SiteNavigationElement" itemscope="">
            <div class="inside-navigation grid-container grid-parent">
                <button class="slideout-exit has-svg-icon"><span class="gp-icon pro-close">
                        <svg viewBox="0 0 512 512" aria-hidden="true" role="img" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1em"
                            height="1em">
                            <path
                                d="M71.029 71.029c9.373-9.372 24.569-9.372 33.942 0L256 222.059l151.029-151.03c9.373-9.372 24.569-9.372 33.942 0 9.372 9.373 9.372 24.569 0 33.942L289.941 256l151.03 151.029c9.372 9.373 9.372 24.569 0 33.942-9.373 9.372-24.569 9.372-33.942 0L256 289.941l-151.029 151.03c-9.373 9.372-24.569 9.372-33.942 0-9.372-9.373-9.372-24.569 0-33.942L222.059 256 71.029 104.971c-9.372-9.373-9.372-24.569 0-33.942z">
                            </path>
                        </svg>
                    </span> <span class="screen-reader-text">Close</span></button>
                <div class="main-nav">
                    <ul id="menu-main-1" class=" slideout-menu">
                        <li
                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-1175 current_page_item menu-item-383">
                            <a href="https://www.arbihunt.com/" aria-current="page">Home</a>
                        </li>
                        <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-385"><a
                                href="https://www.arbihunt.com/contact/">Got Questions?</a></li>
                    </ul>
                </div>
                <a class="gb-button gb-button-3e53fdf1 gb-button-text" href="https://app.arbihunt.com/" target="_blank"
                    rel="noopener noreferrer">LOGIN/SIGNUP</a>
            </div><!-- .inside-navigation -->
        </nav><!-- #site-navigation -->

        <div class="slideout-overlay">
        </div>
        <script id="generate-a11y">
            ! function() {
                "use strict";
                if ("querySelector" in document && "addEventListener" in window) {
                    var e = document.body;
                    e.addEventListener("mousedown", function() {
                        e.classList.add("using-mouse")
                    }), e.addEventListener("keydown", function() {
                        e.classList.remove("using-mouse")
                    })
                }
            }();
        </script>
        <script src="js/sticky.min.js" id="generate-sticky-js"></script>
        <script id="generate-offside-js-extra">
            var offSide = {
                "side": "left"
            };
        </script>
        <script src="js/offside.min.js" id="generate-offside-js"></script>

        <script id="generate-menu-js-extra">
            var generatepressMenu = {
                "toggleOpenedSubMenus": "1",
                "openSubMenuLabel": "Open Sub-Menu",
                "closeSubMenuLabel": "Close Sub-Menu"
            };
        </script>
        <script src="{{ asset('assets/js/menu.min.js') }}" id="generate-menu-js"></script>


    </body>
@endsection
