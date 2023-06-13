<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang=""> <!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>KYC UGANDA - Register</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="{{asset('assets/backend/images/favicon.JPG') }}">
    <link rel="shortcut icon" href="{{asset('assets/backend/images/favicon.JPG') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/backend/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/backend/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
</head>

<body class="bg-dark">

    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container" style="padding-top: 5%;">
            <h1 style="color:#58D68D; text-align:center; "> <strong> KYC UGANDA</strong></h1>
            <div class="row">
                <div class="col-md-7">
                <div class="login-content">
                    <h2 style="color:#fff; padding-bottom:10px"> Why Choose Us</h2>
                        <p style="color:#ffd">WE BUILD AML COMPLIANCE PROGRAMS THAT ARE EASY TO USE AND REGULATOR FRIENDLY.</p>
                        <p style="color: #D7DBDD">Anti Money Laundering Compliance is Difficult, Complicated and Expensive. Working with clients, we have been able to help them understand their obligations, implement an AML/CTF Compliance Program, made it affordable for them to manage internally and reviewed their progress towards perfection.</p>
                        
                        <h2 style="color:#fff; padding-bottom:10px; padding-top:10px"> How It works</h2>
                        <p style="color: #D7DBDD">Understand new risks in real-time with our proprietary database of Sanctions, Watchlists, PEPs, and Adverse Media, offering richer data quality and provenance</p>
                        <p style="color: #D7DBDD">Reduce false positives with consolidated profiles and tailored matching and monitoring.</p>
                        <p style="color: #D7DBDD">Seamlessly integrate AML checks into your onboarding workflow via a highly functional RESTful API.</p>
                        <p style="color: #D7DBDD">Receive automated ongoing monitoring alerts related to relevant changes in risk status.</p>
                    </div>

                </div>
                <div class="col-md-5">
                    <div class="login-content">
                        <div class="login-logo">
                        <h3 style="color:#fff; text-align:center; "> <strong> REGISTER</strong></h3>
                            @include('messages')

                        </div>
                        <div class="login-form">
                            <form action="{{ route('register.perform') }}" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                                <div class="form-group">
                                    <label>Email address</label>
                                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                                </div>
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input type="text" name="phone" class="form-control" placeholder="Phone Number" required>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
                                </div>

                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> Agree the terms and policy
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Register</button>
                                <!-- <div class="social-login-content">
                            <div class="social-button">
                                <button type="button" class="btn social facebook btn-flat btn-addon mb-3"><i class="ti-facebook"></i>Register with facebook</button>
                                <button type="button" class="btn social twitter btn-flat btn-addon mt-2"><i class="ti-twitter"></i>Register with twitter</button>
                            </div>
                        </div> -->
                                <div class="register-link m-t-15 text-center">
                                    <p>Already have account ? <a style="color:blue" href="{{ route('login.show') }}"> Sign in</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="assets/backend/js/main.js"></script>

</body>

</html>