<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang=""> <!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SMS Portal</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="{{asset('assets/backend/images/favicon.JPG') }}">
    <link rel="shortcut icon" href="{{asset('assets/backend/images/favicon.JPG') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>


</head>

<body>
    <!-- Left Panel -->

    <div id="custom-sidebar"></div>

    <div id="right-panel" class="right-panel">

        <div id="custom-header"></div>

        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Reports</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Reports</a></li>
                                    <li class="active">Transactions</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header"><strong>Search</strong><small> Reports</small></div>
                            <div class="card-body card-block">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="company" class=" form-control-label">Phone Number</label>
                                            <input type="text" id="company" placeholder="Enter phone number"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="company" class=" form-control-label">Sender ID</label>
                                            <input type="text" id="company" placeholder="Enter sender id"
                                                class="form-control">
                                        </div>
        
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="company" class=" form-control-label">Type</label>
                                            <select data-placeholder="Choose a channel..." class="form-control" tabindex="1">
                                                <option value="SMS">SMS</option>
                                                <option value="Whatsapp">Whatsapp</option>
                                            </select>
                                        </div>   
    
                                    </div>
    
                                </div>
                                <button type="submit" class="btn btn-success btn-sm">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header"><strong>Reports</strong><small> Transactions</small></div>
                            <div class="card-body">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Message ID</th>
                                            <th scope="col">Phone Number</th>
                                            <th scope="col">Text Message</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Sender</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>000999</td>
                                            <td>0700123834</td>
                                            <td>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Reiciendis
                                                provident deleniti totam aperiam, est itaque atque iusto quos velit
                                                repudiandae soluta quia id, consequuntur cupiditate natus in!
                                                Reiciendis, praesentium perferendis!</td>
                                            <td>SMS</td>
                                            <td>0061</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>000999</td>
                                            <td>0700123834</td>
                                            <td>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Reiciendis
                                                provident deleniti totam aperiam, est itaque atque iusto quos velit
                                                repudiandae soluta quia id, consequuntur cupiditate natus in!
                                                Reiciendis, praesentium perferendis!</td>
                                            <td>SMS</td>
                                            <td>0063</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>000999</td>
                                            <td>0700123834</td>
                                            <td>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Reiciendis
                                                provident deleniti totam aperiam, est itaque atque iusto quos velit
                                                repudiandae soluta quia id, consequuntur cupiditate natus in!
                                                Reiciendis, praesentium perferendis!</td>
                                            <td>SMS</td>
                                            <td>0061</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>000999</td>
                                            <td>0700123834</td>
                                            <td>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Reiciendis
                                                provident deleniti totam aperiam, est itaque atque iusto quos velit
                                                repudiandae soluta quia id, consequuntur cupiditate natus in!
                                                Reiciendis, praesentium perferendis!</td>
                                            <td>SMS</td>
                                            <td>0069</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .animated -->
        </div><!-- .content -->

        <div class="clearfix"></div>

        <div id="custom-footer"></div>

    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script>
        jQuery(document).ready(function ($) {
            $("#custom-sidebar").load("custom-sidebar.html");
            $("#custom-footer").load("custom-footer.html");
            $("#custom-header").load("custom-header.html");
        });
    </script>
</body>

</html>