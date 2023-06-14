<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang=""> <!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>KYC UGANDA - Login</title>
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
    <script src="https://www.google.com/recaptcha/api.js" async defer>
  </script>

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
</head>

<body class="bg-dark">

    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container" style="padding-top: 5%;">

            <div class="login-content">
                <div class="login-logo">
                    <h3 style="color:#fff; text-align:center; "> <strong> LOGIN</strong></h3>
                    @include('messages')
                </div>
                <div class="login-form">
                    <form action="{{ route('login.perform') }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        <div class="g-recaptcha form-group" data-sitekey="6LcbjpcmAAAAAEMH-rPm-7O08kFINeHflFbqW2Rd" data-callback="onRecaptchaSuccess" data-expired-callback="onRecaptchaResponseExpiry" data-error-callback="onRecaptchaError"></div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"> Remember Me
                            </label>
                            <label class="pull-right">
                                <a style="color:blue" href="{{ url('forgot-password') }}">Forgotten Password?</a>
                            </label>

                        </div>
                        <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30" id="submitBtn" disabled>Sign in</button>
                        <div class="register-link m-t-15 text-center">
                            <p>Don't have account ? <a style="color:blue" href="{{ route('register.show') }}"> Sign Up Here</a></p>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <script type="text/javascript">
        function onRecaptchaSuccess() {
    $('#submitBtn').removeAttr('disabled');
};
    </script>

    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="assets/backend/js/main.js"></script>

</body>

</html>