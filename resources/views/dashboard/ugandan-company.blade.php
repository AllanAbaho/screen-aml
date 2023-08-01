<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang=""> <!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>KYC UGANDA - Search Person</title>
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
    <link rel="stylesheet" href="{{ asset('assets/backend/css/cs-skin-elastic.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/style.css') }}">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>

</head>

<body>
    <!-- Left Panel -->

    @include('dashboard.custom-sidebar')

    <div id="right-panel" class="right-panel">

        @include('dashboard.custom-header')

        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1><span><i class="fa fa-search"></i> Search</span></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Search</a></li>
                                    <li class="active">Form</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="animated fadeIn">
                @include('messages')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header"><strong>Search</strong><small> Form</small></div>
                            <div class="card-body card-block">
                                <form action="{{ route('dashboard.search') }}" method="post">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    <div class="form-group">
                                        <label for="brn" class=" form-control-label">Business Registration Number</label>
                                        <input type="text" name="brn" value="80017272628069" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="entity-type" class=" form-control-label">Entity Type</label>

                                        <select name="entity_type" class="form-control" tabindex="1">
                                            <option value="company">Company</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="match-type" class=" form-control-label">Match Type</label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" class="form-control" name="match_types[]" type="checkbox" id="inlineCheckbox1" value="sanction">
                                            <label class="form-check-label" for="inlineCheckbox1">Sanctions</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" class="form-control" name="match_types[]" type="checkbox" id="inlineCheckbox2" value="warning">
                                            <label class="form-check-label" for="inlineCheckbox2">Warnings</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" class="form-control" name="match_types[]" type="checkbox" id="inlineCheckbox3" value="pep">
                                            <label class="form-check-label" for="inlineCheckbox3">PEP</label>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-success btn-sm">Search</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div><!-- .animated -->
        </div><!-- .content -->

        <div class="clearfix"></div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        @include('dashboard.custom-footer')

    </div><!-- /#right-panel -->

    <!-- Right Panel -->
    <!-- <script>
        require(['bootstrap-multiselect'], function(purchase) {
            $('#mySelect').multiselect();
        });
    </script> -->

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="{{asset('assets/backend/js/main.js') }}"></script>
</body>

</html>