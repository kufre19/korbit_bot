<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <title>Korbit Bot</title>
    <meta name="robots" content="max-image-preview:large">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.gstatic.com" crossorigin="" rel="preconnect">
    <link href="https://fonts.googleapis.com" crossorigin="" rel="preconnect">
    <link rel="alternate" type="application/rss+xml" title="Korbit Bot" href="https://www.arbihunt.com/feed/">
    <link rel="alternate" type="application/rss+xml" title="Korbit Bot" href="https://www.arbihunt.com/comments/feed/">
    <link rel="alternate" type="application/rss+xml" title="Korbit Bot" href="https://www.arbihunt.com/home/feed/">
    <script>
        window._wpemojiSettings = {
            "baseUrl": "https:\/\/s.w.org\/images\/core\/emoji\/15.0.3\/72x72\/",
            "ext": ".png",
            "svgUrl": "https:\/\/s.w.org\/images\/core\/emoji\/15.0.3\/svg\/",
            "svgExt": ".svg",
            "source": {
                "concatemoji": "https:\/\/www.arbihunt.com\/wp-includes\/js\/wp-emoji-release.min.js?ver=6.6.2"
            }
        };
        /*! This file is auto-generated */
        ! function(i, n) {
            var o, s, e;

            function c(e) {
                try {
                    var t = {
                        supportTests: e,
                        timestamp: (new Date).valueOf()
                    };
                    sessionStorage.setItem(o, JSON.stringify(t))
                } catch (e) {}
            }

            function p(e, t, n) {
                e.clearRect(0, 0, e.canvas.width, e.canvas.height), e.fillText(t, 0, 0);
                var t = new Uint32Array(e.getImageData(0, 0, e.canvas.width, e.canvas.height).data),
                    r = (e.clearRect(0, 0, e.canvas.width, e.canvas.height), e.fillText(n, 0, 0), new Uint32Array(e
                        .getImageData(0, 0, e.canvas.width, e.canvas.height).data));
                return t.every(function(e, t) {
                    return e === r[t]
                })
            }

            function u(e, t, n) {
                switch (t) {
                    case "flag":
                        return n(e, "\ud83c\udff3\ufe0f\u200d\u26a7\ufe0f", "\ud83c\udff3\ufe0f\u200b\u26a7\ufe0f") ? !1 : !
                            n(e, "\ud83c\uddfa\ud83c\uddf3", "\ud83c\uddfa\u200b\ud83c\uddf3") && !n(e,
                                "\ud83c\udff4\udb40\udc67\udb40\udc62\udb40\udc65\udb40\udc6e\udb40\udc67\udb40\udc7f",
                                "\ud83c\udff4\u200b\udb40\udc67\u200b\udb40\udc62\u200b\udb40\udc65\u200b\udb40\udc6e\u200b\udb40\udc67\u200b\udb40\udc7f"
                            );
                    case "emoji":
                        return !n(e, "\ud83d\udc26\u200d\u2b1b", "\ud83d\udc26\u200b\u2b1b")
                }
                return !1
            }

            function f(e, t, n) {
                var r = "undefined" != typeof WorkerGlobalScope && self instanceof WorkerGlobalScope ? new OffscreenCanvas(
                        300, 150) : i.createElement("canvas"),
                    a = r.getContext("2d", {
                        willReadFrequently: !0
                    }),
                    o = (a.textBaseline = "top", a.font = "600 32px Arial", {});
                return e.forEach(function(e) {
                    o[e] = t(a, e, n)
                }), o
            }

            function t(e) {
                var t = i.createElement("script");
                t.src = e, t.defer = !0, i.head.appendChild(t)
            }
            "undefined" != typeof Promise && (o = "wpEmojiSettingsSupports", s = ["flag", "emoji"], n.supports = {
                everything: !0,
                everythingExceptFlag: !0
            }, e = new Promise(function(e) {
                i.addEventListener("DOMContentLoaded", e, {
                    once: !0
                })
            }), new Promise(function(t) {
                var n = function() {
                    try {
                        var e = JSON.parse(sessionStorage.getItem(o));
                        if ("object" == typeof e && "number" == typeof e.timestamp && (new Date).valueOf() <
                            e.timestamp + 604800 && "object" == typeof e.supportTests) return e.supportTests
                    } catch (e) {}
                    return null
                }();
                if (!n) {
                    if ("undefined" != typeof Worker && "undefined" != typeof OffscreenCanvas && "undefined" !=
                        typeof URL && URL.createObjectURL && "undefined" != typeof Blob) try {
                        var e = "postMessage(" + f.toString() + "(" + [JSON.stringify(s), u.toString(), p
                                .toString()
                            ].join(",") + "));",
                            r = new Blob([e], {
                                type: "text/javascript"
                            }),
                            a = new Worker(URL.createObjectURL(r), {
                                name: "wpTestEmojiSupports"
                            });
                        return void(a.onmessage = function(e) {
                            c(n = e.data), a.terminate(), t(n)
                        })
                    } catch (e) {}
                    c(n = f(s, u, p))
                }
                t(n)
            }).then(function(e) {
                for (var t in e) n.supports[t] = e[t], n.supports.everything = n.supports.everything && n
                    .supports[t], "flag" !== t && (n.supports.everythingExceptFlag = n.supports
                        .everythingExceptFlag && n.supports[t]);
                n.supports.everythingExceptFlag = n.supports.everythingExceptFlag && !n.supports.flag, n
                    .DOMReady = !1, n.readyCallback = function() {
                        n.DOMReady = !0
                    }
            }).then(function() {
                return e
            }).then(function() {
                var e;
                n.supports.everything || (n.readyCallback(), (e = n.source || {}).concatemoji ? t(e
                    .concatemoji) : e.wpemoji && e.twemoji && (t(e.twemoji), t(e.wpemoji)))
            }))
        }((window, document), window._wpemojiSettings);
    </script>
  
    <link rel="stylesheet" id="wp-block-library-css" href="{{ asset('assets/css/style.min.css') }}" media="all">
  
  
    <link rel="stylesheet" id="generate-style-css" href="{{ asset('assets/css/main.min.css') }}" media="all">
  
    <link rel="stylesheet" id="generate-google-fonts-css"
        href="https://fonts.googleapis.com/css?family=Noto+Serif%3Aregular%2Citalic%2C700%2C700italic%7CSource+Sans+Pro%3A200%2C200italic%2C300%2C300italic%2Cregular%2Citalic%2C600%2C600italic%2C700%2C700italic%2C900%2C900italic%7CRubik%3A300%2Cregular%2C500%2C600%2C700%2C800%2C900%2C300italic%2Citalic%2C500italic%2C600italic%2C700italic%2C800italic%2C900italic&amp;display=auto&amp;ver=3.3.1"
        media="all">
    <link rel="stylesheet" id="generateblocks-css" href="{{ asset('assets/css/style-1175.css') }}" media="all">
    <link rel="stylesheet" id="generate-offside-css" href="{{ asset('assets/css/offside.min.css') }}" media="all">
   
    <link rel="stylesheet" id="generate-navigation-branding-css"
        href="{{ asset('assets/css/navigation-branding-flex.min.css') }}" media="all">
   
    <script src="{{ asset('assets/js/jquery.min.js') }}" id="jquery-core-js"></script>
    <script id="breeze-prefetch-js-extra">
        var breeze_prefetch = {
            "local_url": "https:\/\/www.arbihunt.com",
            "ignore_remote_prefetch": "1",
            "ignore_list": ["\/wp-admin\/"]
        };
    </script>
    <script src="{{ asset('assets/js/breeze-prefetch-links.min.js') }}" id="breeze-prefetch-js"></script>
    <link rel="https://api.w.org/" href="https://www.arbihunt.com/wp-json/">
    <link rel="alternate" title="JSON" type="application/json"
        href="https://www.arbihunt.com/wp-json/wp/v2/pages/1175">
    <link rel="EditURI" type="application/rsd+xml" title="RSD" href="https://www.arbihunt.com/xmlrpc.php?rsd">
    <meta name="generator" content="WordPress 6.6.2">
    <link rel="canonical" href="https://www.arbihunt.com/">
    <link rel="shortlink" href="https://www.arbihunt.com/">
    <link rel="alternate" title="oEmbed (JSON)" type="application/json+oembed"
        href="https://www.arbihunt.com/wp-json/oembed/1.0/embed?url=https%3A%2F%2Fwww.arbihunt.com%2F">
    <link rel="alternate" title="oEmbed (XML)" type="text/xml+oembed"
        href="https://www.arbihunt.com/wp-json/oembed/1.0/embed?url=https%3A%2F%2Fwww.arbihunt.com%2F&amp;format=xml">
    <link rel="pingback" href="https://www.arbihunt.com/xmlrpc.php">
    <link rel="icon" href="{{ asset('assets/images/cropped-ArbiHunt-6-32x32.png') }}" sizes="32x32">
    <link rel="icon" href="{{ asset('assets/images/cropped-ArbiHunt-6-192x192.png') }}" sizes="192x192">
    <link rel="apple-touch-icon" href="{{ asset('assets/images/cropped-ArbiHunt-6-180x180.png') }}">
    <meta name="msapplication-TileImage"
        content="https://www.arbihunt.com/wp-content/uploads/2023/09/cropped-ArbiHunt-6-270x270.png">
    <style id="wp-custom-css">
        /* GeneratePress Site CSS */
        /* End GeneratePress Site CSS */
    </style>
    @yield('header-style')
   
    <script src="{{ asset('assets/js/wp-emoji-release.min.js') }}" defer=""></script>
</head>

    @yield('main-content')

</html>
