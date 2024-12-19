<!-- Main Stylesheet File -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="{{ asset('css/hover-style.css') }}" rel="stylesheet">
<link href="{{ asset('css/login.css') }}" rel="stylesheet">
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>

    <!-- Login Section Start -->
    <div id="login">
        <div class="container">
            <div class="section-header">
                <h2> Login staff</h2>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in mi libero. Quisque convallis, enim at venenatis tincidunt.
                </p>
            </div>
            <div class="container clearfix">
                <div class="form login">
                    <a class="logo" href="">
                        <img src="{{ asset('photos/logo.jpg') }}" alt="Logo" />
                    </a>
                    <form>
                        <p>
                            <label>Username or email address<span>*</span></label>
                            <input type="email" required>
                        </p>
                        <p>
                            <label>Password<span>*</span></label>
                            <input type="password" required>
                        </p>
                        <p>
                            <label>
                                <a href="pass-reset.html">Forgot password?</a>
                                <a href="">Create an account</a>
                            </label>
                            <input type="submit" value="Login" />
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Login Section End -->



    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>


    <!-- Contact Javascript File -->
    <script src="js/jqBootstrapValidation.min.js"></script>
    <script src="js/contact.js"></script>

    <!-- Main Javascript File -->
    <script src="js/main.js"></script>
</body>
