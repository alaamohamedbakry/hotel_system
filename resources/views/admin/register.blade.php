<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Registration Page (v2)</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <script data-cfasync="false" nonce="38f6bac8-2291-4a82-a3cc-cc8fd3a318e2">
        try {
            (function(w, d) {
                ! function(a, b, c, d) {
                    if (a.zaraz) console.error("zaraz is loaded twice");
                    else {
                        a[c] = a[c] || {};
                        a[c].executed = [];
                        a.zaraz = {
                            deferred: [],
                            listeners: []
                        };
                        a.zaraz._v = "5848";
                        a.zaraz._n = "38f6bac8-2291-4a82-a3cc-cc8fd3a318e2";
                        a.zaraz.q = [];
                        a.zaraz._f = function(e) {
                            return async function() {
                                var f = Array.prototype.slice.call(arguments);
                                a.zaraz.q.push({
                                    m: e,
                                    a: f
                                })
                            }
                        };
                        for (const g of ["track", "set", "debug"]) a.zaraz[g] = a.zaraz._f(g);
                        a.zaraz.init = () => {
                            var h = b.getElementsByTagName(d)[0],
                                i = b.createElement(d),
                                j = b.getElementsByTagName("title")[0];
                            j && (a[c].t = b.getElementsByTagName("title")[0].text);
                            a[c].x = Math.random();
                            a[c].w = a.screen.width;
                            a[c].h = a.screen.height;
                            a[c].j = a.innerHeight;
                            a[c].e = a.innerWidth;
                            a[c].l = a.location.href;
                            a[c].r = b.referrer;
                            a[c].k = a.screen.colorDepth;
                            a[c].n = b.characterSet;
                            a[c].o = (new Date).getTimezoneOffset();
                            if (a.dataLayer)
                                for (const k of Object.entries(Object.entries(dataLayer).reduce(((l, m) => ({
                                        ...l[1],
                                        ...m[1]
                                    })), {}))) zaraz.set(k[0], k[1], {
                                    scope: "page"
                                });
                            a[c].q = [];
                            for (; a.zaraz.q.length;) {
                                const n = a.zaraz.q.shift();
                                a[c].q.push(n)
                            }
                            i.defer = !0;
                            for (const o of [localStorage, sessionStorage]) Object.keys(o || {}).filter((q => q
                                .startsWith("_zaraz_"))).forEach((p => {
                                try {
                                    a[c]["z_" + p.slice(7)] = JSON.parse(o.getItem(p))
                                } catch {
                                    a[c]["z_" + p.slice(7)] = o.getItem(p)
                                }
                            }));
                            i.referrerPolicy = "origin";
                            i.src = "/cdn-cgi/zaraz/s.js?z=" + btoa(encodeURIComponent(JSON.stringify(a[c])));
                            h.parentNode.insertBefore(i, h)
                        };
                        ["complete", "interactive"].includes(b.readyState) ? zaraz.init() : a.addEventListener(
                            "DOMContentLoaded", zaraz.init)
                    }
                }(w, d, "zarazData", "script");
                window.zaraz._p = async bs => new Promise((bt => {
                    if (bs) {
                        bs.e && bs.e.forEach((bu => {
                            try {
                                const bv = d.querySelector("script[nonce]"),
                                    bw = bv?.nonce || bv?.getAttribute("nonce"),
                                    bx = d.createElement("script");
                                bw && (bx.nonce = bw);
                                bx.innerHTML = bu;
                                bx.onload = () => {
                                    d.head.removeChild(bx)
                                };
                                d.head.appendChild(bx)
                            } catch (by) {
                                console.error(`Error executing script: ${bu}\n`, by)
                            }
                        }));
                        Promise.allSettled((bs.f || []).map((bz => fetch(bz[0], bz[1]))))
                    }
                    bt()
                }));
                zaraz._p({
                    "e": ["(function(w,d){})(window,document)"]
                });
            })(window, document)
        } catch (e) {
            throw fetch("/cdn-cgi/zaraz/t"), e;
        };
    </script>
</head>

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="card card-outline card-primary">
            <div class="text-center card-header">
                <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Register a new membership</p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-3 input-group">
                        <input type="text" name="name" class="form-control" placeholder="Full Name"
                            value="{{ old('name') }}" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <div class="mb-3 input-group">
                        <input type="email" name="email" class="form-control" placeholder="Email"
                            value="{{ old('email') }}" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <div class="mb-3 input-group">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <div class="mb-3 input-group">
                        <input type="password" name="password_confirmation" class="form-control"
                            placeholder="Retype Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </div>
                    </div>
                </form>
                <div class="text-center social-auth-links">
                    <a href="#" class="btn btn-block btn-primary">
                        <i class="mr-2 fab fa-facebook"></i>
                        Sign up using Facebook
                    </a>
                    <a href="#" class="btn btn-block btn-danger">
                        <i class="mr-2 fab fa-google-plus"></i>
                        Sign up using Google+
                    </a>
                </div>

                <a href="login.html" class="text-center">I already have a membership</a>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js?v=3.2.0"></script>
</body>

</html>
