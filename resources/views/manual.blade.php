@extends('layouts.web')

@section('header-style')
    <style id="wp-emoji-styles-inline-css">
        img.wp-smiley,
        img.emoji {
            display: inline !important;
            border: none !important;
            box-shadow: none !important;
            height: 1em !important;
            width: 1em !important;
            margin: 0 0.07em !important;
            vertical-align: -0.1em !important;
            background: none !important;
            padding: 0 !important;
        }
    </style>

    <style id="classic-theme-styles-inline-css">
        /*! This file is auto-generated */
        .wp-block-button__link {
            color: #fff;
            background-color: #32373c;
            border-radius: 9999px;
            box-shadow: none;
            text-decoration: none;
            padding: calc(.667em + 2px) calc(1.333em + 2px);
            font-size: 1.125em
        }

        .wp-block-file__button {
            background: #32373c;
            color: #fff;
            text-decoration: none
        }
    </style>

    <style id="global-styles-inline-css">
        :root {
            --wp--preset--aspect-ratio--square: 1;
            --wp--preset--aspect-ratio--4-3: 4/3;
            --wp--preset--aspect-ratio--3-4: 3/4;
            --wp--preset--aspect-ratio--3-2: 3/2;
            --wp--preset--aspect-ratio--2-3: 2/3;
            --wp--preset--aspect-ratio--16-9: 16/9;
            --wp--preset--aspect-ratio--9-16: 9/16;
            --wp--preset--color--black: #000000;
            --wp--preset--color--cyan-bluish-gray: #abb8c3;
            --wp--preset--color--white: #ffffff;
            --wp--preset--color--pale-pink: #f78da7;
            --wp--preset--color--vivid-red: #cf2e2e;
            --wp--preset--color--luminous-vivid-orange: #ff6900;
            --wp--preset--color--luminous-vivid-amber: #fcb900;
            --wp--preset--color--light-green-cyan: #7bdcb5;
            --wp--preset--color--vivid-green-cyan: #00d084;
            --wp--preset--color--pale-cyan-blue: #8ed1fc;
            --wp--preset--color--vivid-cyan-blue: #0693e3;
            --wp--preset--color--vivid-purple: #9b51e0;
            --wp--preset--color--contrast: var(--contrast);
            --wp--preset--color--contrast-2: var(--contrast-2);
            --wp--preset--color--contrast-3: var(--contrast-3);
            --wp--preset--color--contrast-4: var(--contrast-4);
            --wp--preset--color--base: var(--base);
            --wp--preset--color--base-2: var(--base-2);
            --wp--preset--color--accent: var(--accent);
            --wp--preset--color--accent-2: var(--accent-2);
            --wp--preset--gradient--vivid-cyan-blue-to-vivid-purple: linear-gradient(135deg, rgba(6, 147, 227, 1) 0%, rgb(155, 81, 224) 100%);
            --wp--preset--gradient--light-green-cyan-to-vivid-green-cyan: linear-gradient(135deg, rgb(122, 220, 180) 0%, rgb(0, 208, 130) 100%);
            --wp--preset--gradient--luminous-vivid-amber-to-luminous-vivid-orange: linear-gradient(135deg, rgba(252, 185, 0, 1) 0%, rgba(255, 105, 0, 1) 100%);
            --wp--preset--gradient--luminous-vivid-orange-to-vivid-red: linear-gradient(135deg, rgba(255, 105, 0, 1) 0%, rgb(207, 46, 46) 100%);
            --wp--preset--gradient--very-light-gray-to-cyan-bluish-gray: linear-gradient(135deg, rgb(238, 238, 238) 0%, rgb(169, 184, 195) 100%);
            --wp--preset--gradient--cool-to-warm-spectrum: linear-gradient(135deg, rgb(74, 234, 220) 0%, rgb(151, 120, 209) 20%, rgb(207, 42, 186) 40%, rgb(238, 44, 130) 60%, rgb(251, 105, 98) 80%, rgb(254, 248, 76) 100%);
            --wp--preset--gradient--blush-light-purple: linear-gradient(135deg, rgb(255, 206, 236) 0%, rgb(152, 150, 240) 100%);
            --wp--preset--gradient--blush-bordeaux: linear-gradient(135deg, rgb(254, 205, 165) 0%, rgb(254, 45, 45) 50%, rgb(107, 0, 62) 100%);
            --wp--preset--gradient--luminous-dusk: linear-gradient(135deg, rgb(255, 203, 112) 0%, rgb(199, 81, 192) 50%, rgb(65, 88, 208) 100%);
            --wp--preset--gradient--pale-ocean: linear-gradient(135deg, rgb(255, 245, 203) 0%, rgb(182, 227, 212) 50%, rgb(51, 167, 181) 100%);
            --wp--preset--gradient--electric-grass: linear-gradient(135deg, rgb(202, 248, 128) 0%, rgb(113, 206, 126) 100%);
            --wp--preset--gradient--midnight: linear-gradient(135deg, rgb(2, 3, 129) 0%, rgb(40, 116, 252) 100%);
            --wp--preset--font-size--small: 13px;
            --wp--preset--font-size--medium: 20px;
            --wp--preset--font-size--large: 36px;
            --wp--preset--font-size--x-large: 42px;
            --wp--preset--spacing--20: 0.44rem;
            --wp--preset--spacing--30: 0.67rem;
            --wp--preset--spacing--40: 1rem;
            --wp--preset--spacing--50: 1.5rem;
            --wp--preset--spacing--60: 2.25rem;
            --wp--preset--spacing--70: 3.38rem;
            --wp--preset--spacing--80: 5.06rem;
            --wp--preset--shadow--natural: 6px 6px 9px rgba(0, 0, 0, 0.2);
            --wp--preset--shadow--deep: 12px 12px 50px rgba(0, 0, 0, 0.4);
            --wp--preset--shadow--sharp: 6px 6px 0px rgba(0, 0, 0, 0.2);
            --wp--preset--shadow--outlined: 6px 6px 0px -3px rgba(255, 255, 255, 1), 6px 6px rgba(0, 0, 0, 1);
            --wp--preset--shadow--crisp: 6px 6px 0px rgba(0, 0, 0, 1);
        }

        :where(.is-layout-flex) {
            gap: 0.5em;
        }

        :where(.is-layout-grid) {
            gap: 0.5em;
        }

        body .is-layout-flex {
            display: flex;
        }

        .is-layout-flex {
            flex-wrap: wrap;
            align-items: center;
        }

        .is-layout-flex> :is(*, div) {
            margin: 0;
        }

        body .is-layout-grid {
            display: grid;
        }

        .is-layout-grid> :is(*, div) {
            margin: 0;
        }

        :where(.wp-block-columns.is-layout-flex) {
            gap: 2em;
        }

        :where(.wp-block-columns.is-layout-grid) {
            gap: 2em;
        }

        :where(.wp-block-post-template.is-layout-flex) {
            gap: 1.25em;
        }

        :where(.wp-block-post-template.is-layout-grid) {
            gap: 1.25em;
        }

        .has-black-color {
            color: var(--wp--preset--color--black) !important;
        }

        .has-cyan-bluish-gray-color {
            color: var(--wp--preset--color--cyan-bluish-gray) !important;
        }

        .has-white-color {
            color: var(--wp--preset--color--white) !important;
        }

        .has-pale-pink-color {
            color: var(--wp--preset--color--pale-pink) !important;
        }

        .has-vivid-red-color {
            color: var(--wp--preset--color--vivid-red) !important;
        }

        .has-luminous-vivid-orange-color {
            color: var(--wp--preset--color--luminous-vivid-orange) !important;
        }

        .has-luminous-vivid-amber-color {
            color: var(--wp--preset--color--luminous-vivid-amber) !important;
        }

        .has-light-green-cyan-color {
            color: var(--wp--preset--color--light-green-cyan) !important;
        }

        .has-vivid-green-cyan-color {
            color: var(--wp--preset--color--vivid-green-cyan) !important;
        }

        .has-pale-cyan-blue-color {
            color: var(--wp--preset--color--pale-cyan-blue) !important;
        }

        .has-vivid-cyan-blue-color {
            color: var(--wp--preset--color--vivid-cyan-blue) !important;
        }

        .has-vivid-purple-color {
            color: var(--wp--preset--color--vivid-purple) !important;
        }

        .has-black-background-color {
            background-color: var(--wp--preset--color--black) !important;
        }

        .has-cyan-bluish-gray-background-color {
            background-color: var(--wp--preset--color--cyan-bluish-gray) !important;
        }

        .has-white-background-color {
            background-color: var(--wp--preset--color--white) !important;
        }

        .has-pale-pink-background-color {
            background-color: var(--wp--preset--color--pale-pink) !important;
        }

        .has-vivid-red-background-color {
            background-color: var(--wp--preset--color--vivid-red) !important;
        }

        .has-luminous-vivid-orange-background-color {
            background-color: var(--wp--preset--color--luminous-vivid-orange) !important;
        }

        .has-luminous-vivid-amber-background-color {
            background-color: var(--wp--preset--color--luminous-vivid-amber) !important;
        }

        .has-light-green-cyan-background-color {
            background-color: var(--wp--preset--color--light-green-cyan) !important;
        }

        .has-vivid-green-cyan-background-color {
            background-color: var(--wp--preset--color--vivid-green-cyan) !important;
        }

        .has-pale-cyan-blue-background-color {
            background-color: var(--wp--preset--color--pale-cyan-blue) !important;
        }

        .has-vivid-cyan-blue-background-color {
            background-color: var(--wp--preset--color--vivid-cyan-blue) !important;
        }

        .has-vivid-purple-background-color {
            background-color: var(--wp--preset--color--vivid-purple) !important;
        }

        .has-black-border-color {
            border-color: var(--wp--preset--color--black) !important;
        }

        .has-cyan-bluish-gray-border-color {
            border-color: var(--wp--preset--color--cyan-bluish-gray) !important;
        }

        .has-white-border-color {
            border-color: var(--wp--preset--color--white) !important;
        }

        .has-pale-pink-border-color {
            border-color: var(--wp--preset--color--pale-pink) !important;
        }

        .has-vivid-red-border-color {
            border-color: var(--wp--preset--color--vivid-red) !important;
        }

        .has-luminous-vivid-orange-border-color {
            border-color: var(--wp--preset--color--luminous-vivid-orange) !important;
        }

        .has-luminous-vivid-amber-border-color {
            border-color: var(--wp--preset--color--luminous-vivid-amber) !important;
        }

        .has-light-green-cyan-border-color {
            border-color: var(--wp--preset--color--light-green-cyan) !important;
        }

        .has-vivid-green-cyan-border-color {
            border-color: var(--wp--preset--color--vivid-green-cyan) !important;
        }

        .has-pale-cyan-blue-border-color {
            border-color: var(--wp--preset--color--pale-cyan-blue) !important;
        }

        .has-vivid-cyan-blue-border-color {
            border-color: var(--wp--preset--color--vivid-cyan-blue) !important;
        }

        .has-vivid-purple-border-color {
            border-color: var(--wp--preset--color--vivid-purple) !important;
        }

        .has-vivid-cyan-blue-to-vivid-purple-gradient-background {
            background: var(--wp--preset--gradient--vivid-cyan-blue-to-vivid-purple) !important;
        }

        .has-light-green-cyan-to-vivid-green-cyan-gradient-background {
            background: var(--wp--preset--gradient--light-green-cyan-to-vivid-green-cyan) !important;
        }

        .has-luminous-vivid-amber-to-luminous-vivid-orange-gradient-background {
            background: var(--wp--preset--gradient--luminous-vivid-amber-to-luminous-vivid-orange) !important;
        }

        .has-luminous-vivid-orange-to-vivid-red-gradient-background {
            background: var(--wp--preset--gradient--luminous-vivid-orange-to-vivid-red) !important;
        }

        .has-very-light-gray-to-cyan-bluish-gray-gradient-background {
            background: var(--wp--preset--gradient--very-light-gray-to-cyan-bluish-gray) !important;
        }

        .has-cool-to-warm-spectrum-gradient-background {
            background: var(--wp--preset--gradient--cool-to-warm-spectrum) !important;
        }

        .has-blush-light-purple-gradient-background {
            background: var(--wp--preset--gradient--blush-light-purple) !important;
        }

        .has-blush-bordeaux-gradient-background {
            background: var(--wp--preset--gradient--blush-bordeaux) !important;
        }

        .has-luminous-dusk-gradient-background {
            background: var(--wp--preset--gradient--luminous-dusk) !important;
        }

        .has-pale-ocean-gradient-background {
            background: var(--wp--preset--gradient--pale-ocean) !important;
        }

        .has-electric-grass-gradient-background {
            background: var(--wp--preset--gradient--electric-grass) !important;
        }

        .has-midnight-gradient-background {
            background: var(--wp--preset--gradient--midnight) !important;
        }

        .has-small-font-size {
            font-size: var(--wp--preset--font-size--small) !important;
        }

        .has-medium-font-size {
            font-size: var(--wp--preset--font-size--medium) !important;
        }

        .has-large-font-size {
            font-size: var(--wp--preset--font-size--large) !important;
        }

        .has-x-large-font-size {
            font-size: var(--wp--preset--font-size--x-large) !important;
        }

        :where(.wp-block-post-template.is-layout-flex) {
            gap: 1.25em;
        }

        :where(.wp-block-post-template.is-layout-grid) {
            gap: 1.25em;
        }

        :where(.wp-block-columns.is-layout-flex) {
            gap: 2em;
        }

        :where(.wp-block-columns.is-layout-grid) {
            gap: 2em;
        }

        :root :where(.wp-block-pullquote) {
            font-size: 1.5em;
            line-height: 1.6;
        }
    </style>

    <style id="generate-style-inline-css">
        body {
            background-color: var(--base-2);
            color: var(--contrast-3);
        }

        a {
            color: var(--accent-2);
        }

        a:hover,
        a:focus,
        a:active {
            color: var(--accent);
        }

        .wp-block-group__inner-container {
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
        }

        .site-header .header-image {
            width: 190px;
        }

        :root {
            --contrast: #212121;
            --contrast-2: #212121;
            --contrast-3: #666666;
            --contrast-4: #a3a791;
            --base: #faf0e2;
            --base-2: #FFC00E;
            --accent: #fbbb7b;
            --accent-2: #212121;
        }

        :root .has-contrast-color {
            color: var(--contrast);
        }

        :root .has-contrast-background-color {
            background-color: var(--contrast);
        }

        :root .has-contrast-2-color {
            color: var(--contrast-2);
        }

        :root .has-contrast-2-background-color {
            background-color: var(--contrast-2);
        }

        :root .has-contrast-3-color {
            color: var(--contrast-3);
        }

        :root .has-contrast-3-background-color {
            background-color: var(--contrast-3);
        }

        :root .has-contrast-4-color {
            color: var(--contrast-4);
        }

        :root .has-contrast-4-background-color {
            background-color: var(--contrast-4);
        }

        :root .has-base-color {
            color: var(--base);
        }

        :root .has-base-background-color {
            background-color: var(--base);
        }

        :root .has-base-2-color {
            color: var(--base-2);
        }

        :root .has-base-2-background-color {
            background-color: var(--base-2);
        }

        :root .has-accent-color {
            color: var(--accent);
        }

        :root .has-accent-background-color {
            background-color: var(--accent);
        }

        :root .has-accent-2-color {
            color: var(--accent-2);
        }

        :root .has-accent-2-background-color {
            background-color: var(--accent-2);
        }

        h1 {
            font-family: Rubik, sans-serif;
            font-weight: 700;
            font-size: 42px;
        }

        @media (max-width:768px) {
            h1 {
                font-size: 35px;
            }
        }

        h2 {
            font-family: Rubik, sans-serif;
            font-weight: 700;
            font-size: 35px;
        }

        @media (max-width:768px) {
            h2 {
                font-size: 30px;
            }
        }

        h3 {
            font-family: Rubik, sans-serif;
            font-weight: 700;
            font-size: 29px;
            margin-bottom: 20px;
        }

        @media (max-width:768px) {
            h3 {
                font-size: 24px;
            }
        }

        h4 {
            font-family: Rubik, sans-serif;
            font-weight: 700;
            font-size: 24px;
        }

        @media (max-width:768px) {
            h4 {
                font-size: 22px;
            }
        }

        h5 {
            font-family: Rubik, sans-serif;
            font-weight: 700;
            font-size: 20px;
        }

        @media (max-width:768px) {
            h5 {
                font-size: 19px;
            }
        }

        h6 {
            font-family: Rubik, sans-serif;
            font-weight: 700;
            font-size: 18px;
        }

        @media (max-width:768px) {
            h6 {
                font-size: 17px;
            }
        }

        body,
        button,
        input,
        select,
        textarea {
            font-family: Source Sans Pro, sans-serif;
            font-size: 17px;
        }

        h1.entry-title {
            font-family: Rubik, sans-serif;
            font-weight: 700;
        }

        h2.entry-title {
            font-family: Rubik, sans-serif;
            font-weight: 700;
        }

        .main-title {
            font-family: Source Sans Pro, sans-serif;
            text-transform: uppercase;
            font-size: 20px;
        }

        .main-navigation a,
        .main-navigation .menu-toggle,
        .main-navigation .menu-bar-items {
            font-family: Rubik, sans-serif;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 13px;
        }

        .top-bar {
            background-color: var(--contrast-3);
            color: var(--base-2);
        }

        .top-bar a {
            color: var(--base-2);
        }

        .top-bar a:hover {
            color: var(--contrast-2);
        }

        .site-header {
            background-color: var(--base-2);
        }

        .main-title a,
        .main-title a:hover {
            color: var(--contrast-2);
        }

        .site-description {
            color: var(--contrast-3);
        }

        .mobile-menu-control-wrapper .menu-toggle,
        .mobile-menu-control-wrapper .menu-toggle:hover,
        .mobile-menu-control-wrapper .menu-toggle:focus,
        .has-inline-mobile-toggle #site-navigation.toggled {
            background-color: rgba(0, 0, 0, 0.02);
        }

        .main-navigation,
        .main-navigation ul ul {
            background-color: var(--base-2);
        }

        .main-navigation .main-nav ul li a,
        .main-navigation .menu-toggle,
        .main-navigation .menu-bar-items {
            color: var(--contrast-2);
        }

        .main-navigation .main-nav ul li:not([class*="current-menu-"]):hover>a,
        .main-navigation .main-nav ul li:not([class*="current-menu-"]):focus>a,
        .main-navigation .main-nav ul li.sfHover:not([class*="current-menu-"])>a,
        .main-navigation .menu-bar-item:hover>a,
        .main-navigation .menu-bar-item.sfHover>a {
            color: var(--accent-2);
        }

        button.menu-toggle:hover,
        button.menu-toggle:focus {
            color: var(--contrast-2);
        }

        .main-navigation .main-nav ul li[class*="current-menu-"]>a {
            color: var(--accent-2);
        }

        .navigation-search input[type="search"],
        .navigation-search input[type="search"]:active,
        .navigation-search input[type="search"]:focus,
        .main-navigation .main-nav ul li.search-item.active>a,
        .main-navigation .menu-bar-items .search-item.active>a {
            color: var(--accent-2);
        }

        .main-navigation ul ul {
            background-color: var(--base);
        }

        .main-navigation .main-nav ul ul li a {
            color: var(--contrast-3);
        }

        .separate-containers .inside-article,
        .separate-containers .comments-area,
        .separate-containers .page-header,
        .one-container .container,
        .separate-containers .paging-navigation,
        .inside-page-header {
            color: var(--contrast-3);
            background-color: var(--base-2);
        }

        .entry-title a {
            color: var(--contrast-2);
        }

        .entry-title a:hover {
            color: var(--accent-2);
        }

        .entry-meta {
            color: var(--contrast-2);
        }

        h1 {
            color: var(--contrast);
        }

        h2 {
            color: var(--contrast);
        }

        h3 {
            color: var(--contrast);
        }

        h4 {
            color: var(--contrast);
        }

        h5 {
            color: var(--contrast);
        }

        h6 {
            color: var(--contrast);
        }

        .sidebar .widget {
            background-color: var(--base-2);
        }

        .footer-widgets {
            background-color: var(--base-2);
        }

        .footer-widgets .widget-title {
            color: var(--contrast);
        }

        .site-info {
            color: var(--base-2);
            background-color: var(--contrast-3);
        }

        .site-info a {
            color: var(--base-2);
        }

        .site-info a:hover {
            color: var(--base);
        }

        .footer-bar .widget_nav_menu .current-menu-item a {
            color: var(--base);
        }

        input[type="text"],
        input[type="email"],
        input[type="url"],
        input[type="password"],
        input[type="search"],
        input[type="tel"],
        input[type="number"],
        textarea,
        select {
            color: var(--contrast-3);
            background-color: #fafafa;
            border-color: var(--contrast-4);
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="url"]:focus,
        input[type="password"]:focus,
        input[type="search"]:focus,
        input[type="tel"]:focus,
        input[type="number"]:focus,
        textarea:focus,
        select:focus {
            color: var(--contrast-3);
            background-color: #ffffff;
            border-color: var(--contrast-4);
        }

        button,
        html input[type="button"],
        input[type="reset"],
        input[type="submit"],
        a.button,
        a.wp-block-button__link:not(.has-background) {
            color: var(--base-2);
            background-color: var(--accent-2);
        }

        button:hover,
        html input[type="button"]:hover,
        input[type="reset"]:hover,
        input[type="submit"]:hover,
        a.button:hover,
        button:focus,
        html input[type="button"]:focus,
        input[type="reset"]:focus,
        input[type="submit"]:focus,
        a.button:focus,
        a.wp-block-button__link:not(.has-background):active,
        a.wp-block-button__link:not(.has-background):focus,
        a.wp-block-button__link:not(.has-background):hover {
            color: var(--base-2);
            background-color: var(--accent);
        }

        a.generate-back-to-top {
            background-color: rgba(0, 0, 0, 0.4);
            color: #ffffff;
        }

        a.generate-back-to-top:hover,
        a.generate-back-to-top:focus {
            background-color: rgba(0, 0, 0, 0.6);
            color: #ffffff;
        }

        :root {
            --gp-search-modal-bg-color: var(--base-3);
            --gp-search-modal-text-color: var(--contrast);
            --gp-search-modal-overlay-bg-color: rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 980px) {

            .main-navigation .menu-bar-item:hover>a,
            .main-navigation .menu-bar-item.sfHover>a {
                background: none;
                color: var(--contrast-2);
            }
        }

        .nav-below-header .main-navigation .inside-navigation.grid-container,
        .nav-above-header .main-navigation .inside-navigation.grid-container {
            padding: 0px 20px 0px 20px;
        }

        .separate-containers .inside-article,
        .separate-containers .comments-area,
        .separate-containers .page-header,
        .separate-containers .paging-navigation,
        .one-container .site-content,
        .inside-page-header {
            padding: 80px 40px 80px 40px;
        }

        .site-main .wp-block-group__inner-container {
            padding: 80px 40px 80px 40px;
        }

        .separate-containers .paging-navigation {
            padding-top: 20px;
            padding-bottom: 20px;
        }

        .entry-content .alignwide,
        body:not(.no-sidebar) .entry-content .alignfull {
            margin-left: -40px;
            width: calc(100% + 80px);
            max-width: calc(100% + 80px);
        }

        .one-container.archive .post:not(:last-child):not(.is-loop-template-item),
        .one-container.blog .post:not(:last-child):not(.is-loop-template-item) {
            padding-bottom: 80px;
        }

        .main-navigation .main-nav ul li a,
        .menu-toggle,
        .main-navigation .menu-bar-item>a {
            line-height: 30px;
        }

        .navigation-search input[type="search"] {
            height: 30px;
        }

        .rtl .menu-item-has-children .dropdown-menu-toggle {
            padding-left: 20px;
        }

        .rtl .main-navigation .main-nav ul li.menu-item-has-children>a {
            padding-right: 20px;
        }

        @media (max-width:768px) {

            .separate-containers .inside-article,
            .separate-containers .comments-area,
            .separate-containers .page-header,
            .separate-containers .paging-navigation,
            .one-container .site-content,
            .inside-page-header {
                padding: 60px 20px 60px 20px;
            }

            .site-main .wp-block-group__inner-container {
                padding: 60px 20px 60px 20px;
            }

            .inside-top-bar {
                padding-right: 30px;
                padding-left: 30px;
            }

            .inside-header {
                padding-top: 20px;
                padding-right: 30px;
                padding-bottom: 20px;
                padding-left: 30px;
            }

            .widget-area .widget {
                padding-top: 30px;
                padding-right: 30px;
                padding-bottom: 30px;
                padding-left: 30px;
            }

            .footer-widgets-container {
                padding-top: 30px;
                padding-right: 30px;
                padding-bottom: 30px;
                padding-left: 30px;
            }

            .inside-site-info {
                padding-right: 30px;
                padding-left: 30px;
            }

            .entry-content .alignwide,
            body:not(.no-sidebar) .entry-content .alignfull {
                margin-left: -20px;
                width: calc(100% + 40px);
                max-width: calc(100% + 40px);
            }

            .one-container .site-main .paging-navigation {
                margin-bottom: 20px;
            }
        }

        /* End cached CSS */
        .is-right-sidebar {
            width: 30%;
        }

        .is-left-sidebar {
            width: 30%;
        }

        .site-content .content-area {
            width: 100%;
        }

        @media (max-width: 980px) {

            .main-navigation .menu-toggle,
            .sidebar-nav-mobile:not(#sticky-placeholder) {
                display: block;
            }

            .main-navigation ul,
            .gen-sidebar-nav,
            .main-navigation:not(.slideout-navigation):not(.toggled) .main-nav>ul,
            .has-inline-mobile-toggle #site-navigation .inside-navigation>*:not(.navigation-search):not(.main-nav) {
                display: none;
            }

            .nav-align-right .inside-navigation,
            .nav-align-center .inside-navigation {
                justify-content: space-between;
            }

            .has-inline-mobile-toggle .mobile-menu-control-wrapper {
                display: flex;
                flex-wrap: wrap;
            }

            .has-inline-mobile-toggle .inside-header {
                flex-direction: row;
                text-align: left;
                flex-wrap: wrap;
            }

            .has-inline-mobile-toggle .header-widget,
            .has-inline-mobile-toggle #site-navigation {
                flex-basis: 100%;
            }

            .nav-float-left .has-inline-mobile-toggle #site-navigation {
                order: 10;
            }
        }

        .dynamic-author-image-rounded {
            border-radius: 100%;
        }

        .dynamic-featured-image,
        .dynamic-author-image {
            vertical-align: middle;
        }

        .one-container.blog .dynamic-content-template:not(:last-child),
        .one-container.archive .dynamic-content-template:not(:last-child) {
            padding-bottom: 0px;
        }

        .dynamic-entry-excerpt>p:last-child {
            margin-bottom: 0px;
        }

        .main-navigation .main-nav ul li a,
        .menu-toggle,
        .main-navigation .menu-bar-item>a {
            transition: line-height 300ms ease
        }

        .main-navigation.toggled .main-nav>ul {
            background-color: var(--base-2)
        }

        .sticky-enabled .gen-sidebar-nav.is_stuck .main-navigation {
            margin-bottom: 0px;
        }

        .sticky-enabled .gen-sidebar-nav.is_stuck {
            z-index: 500;
        }

        .sticky-enabled .main-navigation.is_stuck {
            box-shadow: 0 2px 2px -2px rgba(0, 0, 0, .2);
        }

        .navigation-stick:not(.gen-sidebar-nav) {
            left: 0;
            right: 0;
            width: 100% !important;
        }

        @media (max-width: 980px) {
            #sticky-placeholder {
                height: 0;
                overflow: hidden;
            }

            .has-inline-mobile-toggle #site-navigation.toggled {
                margin-top: 0;
            }

            .has-inline-mobile-menu #site-navigation.toggled .main-nav>ul {
                top: 1.5em;
            }
        }

        .nav-float-right .navigation-stick {
            width: 100% !important;
            left: 0;
        }

        .nav-float-right .navigation-stick .navigation-branding {
            margin-right: auto;
        }

        .main-navigation.has-sticky-branding:not(.grid-container) .inside-navigation:not(.grid-container) .navigation-branding {
            margin-left: 10px;
        }

        .main-navigation.navigation-stick.has-sticky-branding .inside-navigation.grid-container {
            padding-left: 40px;
            padding-right: 40px;
        }

        @media (max-width:768px) {
            .main-navigation.navigation-stick.has-sticky-branding .inside-navigation.grid-container {
                padding-left: 0;
                padding-right: 0;
            }
        }

        @media (max-width: 980px) {

            .main-navigation .main-nav ul li a,
            .main-navigation .menu-toggle,
            .main-navigation .mobile-bar-items a,
            .main-navigation .menu-bar-item>a {
                line-height: 52px;
            }

            .main-navigation .site-logo.navigation-logo img,
            .mobile-header-navigation .site-logo.mobile-header-logo img,
            .navigation-search input[type="search"] {
                height: 52px;
            }
        }

        @media (max-width: 1024px),
        (min-width:1025px) {

            .main-navigation.sticky-navigation-transition .main-nav>ul>li>a,
            .sticky-navigation-transition .menu-toggle,
            .main-navigation.sticky-navigation-transition .menu-bar-item>a,
            .sticky-navigation-transition .navigation-branding .main-title {
                line-height: 70px;
            }

            .main-navigation.sticky-navigation-transition .site-logo img,
            .main-navigation.sticky-navigation-transition .navigation-search input[type="search"],
            .main-navigation.sticky-navigation-transition .navigation-branding img {
                height: 70px;
            }
        }
    </style>

    <style id="generateblocks-inline-css">
        .gb-container .wp-block-image img {
            vertical-align: middle;
        }

        .gb-container .gb-shape {
            position: absolute;
            overflow: hidden;
            pointer-events: none;
            line-height: 0;
        }

        .gb-container .gb-shape svg {
            fill: currentColor;
        }

        .gb-container-4bc5556e {
            position: relative;
            overflow-x: hidden;
            overflow-y: hidden;
            background-image: linear-gradient(90deg, var(--contrast), var(--contrast-2));
        }

        .gb-container-bbab8404 {
            max-width: 1200px;
            padding: 60px 40px;
            margin-right: auto;
            margin-left: auto;
        }

        .gb-grid-wrapper>.gb-grid-column-c3240eab {
            width: 25%;
        }

        .gb-container-589f6540 {
            max-width: 1200px;
            display: flex;
            justify-content: space-between;
            padding: 20px 40px;
            margin-right: auto;
            margin-left: auto;
            border-top: 1px solid var(--accent-2);
        }

        .gb-container-36412dcb {
            display: flex;
            column-gap: 10px;
            flex-grow: 0;
        }

        .gb-container-ef1aae2b {
            position: relative;
            overflow-x: hidden;
            overflow-y: hidden;
            background-color: var(--contrast);
        }

        .gb-container-956de9c7 {
            max-width: 1200px;
            z-index: 1;
            position: relative;
            order: 1;
            padding: 80px 40px;
            margin-right: auto;
            margin-left: auto;
            background-color: var(--accent-2);
        }

        .gb-grid-wrapper {
            display: flex;
            flex-wrap: wrap;
        }

        .gb-grid-column {
            box-sizing: border-box;
        }

        .gb-grid-wrapper .wp-block-image {
            margin-bottom: 0;
        }

        .gb-grid-wrapper-953a594b {
            margin-left: -40px;
        }

        .gb-grid-wrapper-953a594b>.gb-grid-column {
            padding-left: 40px;
        }

        .gb-icon svg {
            fill: currentColor;
        }

        .gb-highlight {
            background: none;
            color: unset;
        }

        h2.gb-headline-3f8ea196 {
            display: flex;
            align-items: center;
            column-gap: 0.5em;
            font-size: 20px;
            text-transform: uppercase;
            color: var(--base-2);
        }

        p.gb-headline-e347d72f {
            display: flex;
            align-items: center;
            column-gap: 0.5em;
            font-size: 15px;
            margin-bottom: 0px;
            color: var(--contrast-4);
        }

        p.gb-headline-5ad40171 {
            font-size: 15px;
            font-weight: 300;
            margin-bottom: 0px;
            color: var(--base);
        }

        p.gb-headline-5ad40171 a {
            color: var(--accent);
        }

        p.gb-headline-5ad40171 a:hover {
            color: var(--base-2);
        }

        p.gb-headline-33c832d3 {
            font-size: 15px;
            font-weight: 300;
            text-transform: capitalize;
            margin-bottom: 0px;
            color: var(--base);
        }

        p.gb-headline-33c832d3 a {
            color: var(--accent);
        }

        p.gb-headline-33c832d3 a:hover {
            color: var(--base-2);
        }

        p.gb-headline-635549e2 {
            font-size: 15px;
            font-weight: 300;
            text-transform: capitalize;
            margin-bottom: 0px;
            color: var(--base);
        }

        p.gb-headline-635549e2 a {
            color: var(--accent);
        }

        p.gb-headline-635549e2 a:hover {
            color: var(--base-2);
        }

        p.gb-headline-4eb5ae28 {
            font-size: 15px;
            font-weight: 300;
            text-transform: capitalize;
            margin-bottom: 0px;
            color: var(--base);
        }

        p.gb-headline-4eb5ae28 a {
            color: var(--accent);
        }

        p.gb-headline-4eb5ae28 a:hover {
            color: var(--base-2);
        }

        h1.gb-headline-f80518be {
            text-align: center;
            margin-bottom: 0px;
            color: var(--base-2);
        }

        .gb-button {
            text-decoration: none;
        }

        .gb-icon svg {
            fill: currentColor;
        }

        a.gb-button-8a17cab7 {
            display: inline-flex;
            font-weight: 700;
            padding: 10px 30px;
            border-radius: 9999px;
            border: 2px solid var(--accent-2);
            color: var(--accent-2);
        }

        a.gb-button-8a17cab7:hover,
        a.gb-button-8a17cab7:active,
        a.gb-button-8a17cab7:focus {
            background-color: var(--contrast-2);
            color: var(--base-2);
        }

        a.gb-button-3e53fdf1 {
            display: inline-flex;
            font-weight: 700;
            padding: 10px 30px;
            margin-left: 20px;
            border-radius: 9999px;
            border: 2px solid var(--accent-2);
            color: var(--accent-2);
        }

        a.gb-button-3e53fdf1:hover,
        a.gb-button-3e53fdf1:active,
        a.gb-button-3e53fdf1:focus {
            background-color: var(--contrast-2);
            color: var(--base-2);
        }

        @media (max-width: 1024px) {
            .gb-grid-wrapper>.gb-grid-column-c3240eab {
                width: 50%;
            }

            .gb-grid-wrapper-953a594b {
                row-gap: 60px;
            }

            p.gb-headline-33c832d3 {
                margin-bottom: 0px;
            }

            p.gb-headline-635549e2 {
                margin-bottom: 0px;
            }

            p.gb-headline-4eb5ae28 {
                margin-bottom: 0px;
            }
        }

        @media (max-width: 767px) {
            .gb-container-bbab8404 {
                padding-right: 20px;
                padding-left: 20px;
            }

            .gb-grid-wrapper>.gb-grid-column-c3240eab {
                width: 100%;
            }

            .gb-container-589f6540 {
                display: block;
                text-align: center;
                padding-right: 20px;
                padding-left: 20px;
            }

            .gb-container-36412dcb {
                justify-content: center;
            }

            .gb-container-956de9c7 {
                padding: 60px 20px;
            }

            p.gb-headline-5ad40171 {
                margin-bottom: 10px;
            }
        }
    </style>

    <style id="generate-offside-inline-css">
        :root {
            --gp-slideout-width: 265px;
        }

        .slideout-navigation.main-navigation {
            background-color: var(--base);
        }

        .slideout-navigation,
        .slideout-navigation a {
            color: var(--contrast-2);
        }

        .slideout-navigation button.slideout-exit {
            color: var(--contrast-2);
            padding-left: 20px;
            padding-right: 20px;
        }

        .slide-opened nav.toggled .menu-toggle:before {
            display: none;
        }

        @media (max-width: 980px) {
            .menu-bar-item.slideout-toggle {
                display: none;
            }
        }
    </style>

    <style id="generate-navigation-branding-inline-css">
        .main-navigation.has-branding .inside-navigation.grid-container,
        .main-navigation.has-branding.grid-container .inside-navigation:not(.grid-container) {
            padding: 0px 40px 0px 40px;
        }

        .main-navigation.has-branding:not(.grid-container) .inside-navigation:not(.grid-container) .navigation-branding {
            margin-left: 10px;
        }

        .main-navigation .sticky-navigation-logo,
        .main-navigation.navigation-stick .site-logo:not(.mobile-header-logo) {
            display: none;
        }

        .main-navigation.navigation-stick .sticky-navigation-logo {
            display: block;
        }

        .navigation-branding img,
        .site-logo.mobile-header-logo img {
            height: 30px;
            width: auto;
        }

        .navigation-branding .main-title {
            line-height: 30px;
        }

        @media (max-width: 980px) {

            .main-navigation.has-branding.nav-align-center .menu-bar-items,
            .main-navigation.has-sticky-branding.navigation-stick.nav-align-center .menu-bar-items {
                margin-left: auto;
            }

            .navigation-branding {
                margin-right: auto;
                margin-left: 10px;
            }

            .navigation-branding .main-title,
            .mobile-header-navigation .site-logo {
                margin-left: 10px;
            }

            .main-navigation.has-branding .inside-navigation.grid-container {
                padding: 0px;
            }

            .navigation-branding img,
            .site-logo.mobile-header-logo {
                height: 52px;
            }

            .navigation-branding .main-title {
                line-height: 52px;
            }
        }
    </style>

    <style id="wpforms-css-vars-root">
        :root {
            --wpforms-field-border-radius: 3px;
            --wpforms-field-border-style: solid;
            --wpforms-field-border-size: 1px;
            --wpforms-field-background-color: #ffffff;
            --wpforms-field-border-color: rgba(0, 0, 0, 0.25);
            --wpforms-field-border-color-spare: rgba(0, 0, 0, 0.25);
            --wpforms-field-text-color: rgba(0, 0, 0, 0.7);
            --wpforms-field-menu-color: #ffffff;
            --wpforms-label-color: rgba(0, 0, 0, 0.85);
            --wpforms-label-sublabel-color: rgba(0, 0, 0, 0.55);
            --wpforms-label-error-color: #d63637;
            --wpforms-button-border-radius: 3px;
            --wpforms-button-border-style: none;
            --wpforms-button-border-size: 1px;
            --wpforms-button-background-color: #066aab;
            --wpforms-button-border-color: #066aab;
            --wpforms-button-text-color: #ffffff;
            --wpforms-page-break-color: #066aab;
            --wpforms-background-image: none;
            --wpforms-background-position: center center;
            --wpforms-background-repeat: no-repeat;
            --wpforms-background-size: cover;
            --wpforms-background-width: 100px;
            --wpforms-background-height: 100px;
            --wpforms-background-color: rgba(0, 0, 0, 0);
            --wpforms-background-url: none;
            --wpforms-container-padding: 0px;
            --wpforms-container-border-style: none;
            --wpforms-container-border-width: 1px;
            --wpforms-container-border-color: #000000;
            --wpforms-container-border-radius: 3px;
            --wpforms-field-size-input-height: 43px;
            --wpforms-field-size-input-spacing: 15px;
            --wpforms-field-size-font-size: 16px;
            --wpforms-field-size-line-height: 19px;
            --wpforms-field-size-padding-h: 14px;
            --wpforms-field-size-checkbox-size: 16px;
            --wpforms-field-size-sublabel-spacing: 5px;
            --wpforms-field-size-icon-size: 1;
            --wpforms-label-size-font-size: 16px;
            --wpforms-label-size-line-height: 19px;
            --wpforms-label-size-sublabel-font-size: 14px;
            --wpforms-label-size-sublabel-line-height: 17px;
            --wpforms-button-size-font-size: 17px;
            --wpforms-button-size-height: 41px;
            --wpforms-button-size-padding-h: 15px;
            --wpforms-button-size-margin-top: 10px;
            --wpforms-container-shadow-size-box-shadow: none;

        }
    </style>
@endsection


@section('main-content')

    <body
        class="privacy-policy page-template-default page page-id-3 wp-custom-logo wp-embed-responsive slideout-enabled slideout-mobile sticky-menu-fade sticky-enabled desktop-sticky-menu no-sidebar nav-float-right one-container header-aligned-left dropdown-hover"
        itemtype="https://schema.org/WebPage" itemscope="">
        <a class="screen-reader-text skip-link" href="#content" title="Skip to content">Skip to content</a>

        {{-- header  --}}
        @include('layouts.header')

        <div class="gb-container gb-container-ef1aae2b">
            <div class="gb-container gb-container-956de9c7">

                <h1 class="gb-headline gb-headline-f80518be gb-headline-text">Korbit Arbitrage Manual Guide</h1>

            </div>
        </div>
        <div class="site grid-container container hfeed" id="page">
            <div class="site-content" id="content">

                <div class="content-area" id="primary">
                    <main class="site-main" id="main">

                        <article id="post-3" class="post-3 page type-page status-publish"
                            itemtype="https://schema.org/CreativeWork" itemscope="">
                            <div class="inside-article">

                                <header class="entry-header" aria-label="Content">
                                    <h1 class="entry-title" itemprop="headline">EXCHANGE-TO-EXCHANGE API INTEGRATION</h1>
                                </header>


                                <div class="entry-content" itemprop="text">

                                    <p>
                                        The Exchange-to-Exchange API is one of the most powerful features of the Korbit Arbitrage Bot. 
                                        It allows receive signals and manually use them by buying from prescribed exchanges and selling 
                                        on the other exchanges shown on the bot. To profit from this section, ensure that trades are 
                                        executed with the highest speed and efficiency, maximizing profitability.
                                    </p>




                                    

                                    <h2 class="wp-block-heading"><strong>HOW YOU CAN BECOME A MILLIONAIRE WITH KORBIT ARBITRAGE BOT</strong></h2>

                                    <p>
                                        While it’s important to be realistic, those who are committed, educated, and utilize the right tools
                                         can generate significant profits. By consistently capturing small price differences between exchanges, 
                                         especially with larger capital, profits can add up quickly.
                                    </p>

                                    <ol>
                                        <li>Start Small, Scale Gradually: Begin by using a small amount of capital to familiarize yourself with the bot and the process. As you gain confidence, increase your capital to scale your profits.</li>
                                        <li>Leverage Academy Knowledge: Use the insights and strategies from the Korbit Arbitrage Academy to refine your approach.</li>
                                        <li>Utilize Automation: The power of automation through Korbit's API allows you to exploit opportunities 24/7, maximizing the compounding effect of each profitable trade.</li>
                                    </ol>

                                  


                                    <h2 class="wp-block-heading"><strong>CONCLUSION</strong></h2>



                                    <p>
                                        Korbit Arbitrage Bot is a game-changing tool for anyone interested in crypto arbitrage. Whether you're new to the world of trading or an experienced investor, the combination of automation, low risk, and high rewards can significantly boost your financial success. The Korbit Arbitrage Academy further supports this by offering one-to-one training to set up your arbitrage software and master the craft. For those willing to learn and execute, becoming a crypto millionaire is within reach!
                                    </p>
                                  

                                </div>

                            </div>
                        </article>
                    </main>
                </div>


            </div>
        </div>

        {{-- footer --}}
        @include('layouts.footer')



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
                            <a href="{{ url('/') }}" aria-current="page">Home</a>
                        </li>
                        <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-385"><a
                                href="{{ url('contact') }}">NON-AI SUPPORT</a></li>
                    </ul>
                </div>
                <a class="gb-button gb-button-3e53fdf1 gb-button-text" href="https://t.me/signalKorbit_bot"
                    target="_blank" rel="noopener noreferrer">ACCESS KORBIT</a>
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
        <script src="{{ asset('assets/js/sticky.min.js') }}" id="generate-sticky-js"></script>
        <script id="generate-offside-js-extra">
            var offSide = {
                "side": "left"
            };
        </script>
        <script src="{{ asset('assets/js/offside.min.js') }}" id="generate-offside-js"></script>

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
