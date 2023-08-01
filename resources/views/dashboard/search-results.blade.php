<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang=""> <!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>KYC UGANDA - Search Results</title>
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
                                <h1><span><i class="fa fa-user"></i> Search Term '{{$results->name}}'</span></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Search</a></li>
                                    <li class="active">Results</li>
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
                            <div class="card-header"><strong>Search </strong><small>Results</small></div>
                            <div class="card-body card-block">
                                <?php
                                $content = json_decode($results['content'], true);
                                $rows = $content['data']['hits'];
                                $niraDetails = $content['nira'] ?? null;
                                $ursbDetails = $content['ursb'] ?? null;
                                if (count($rows) > 0) :
                                ?>

                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Full Name</th>
                                                <th scope="col">Entity Type</th>
                                                <th scope="col">Countries</th>
                                                <th scope="col">Sources</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            for ($i = 0; $i < count($rows); $i++) :
                                                $details = $rows[$i]['doc'];
                                                $docId = $details['id'];
                                            ?>
                                                <tr>
                                                    <th scope="row"><?= $i + 1 ?></th>
                                                    <td><?= $details['name'] ?></td>
                                                    <td><?= $details['entity_type'] ?></td>
                                                    <td>
                                                        <?php
                                                        $fields = $details['fields'] ?? [];
                                                        if ($fields) {
                                                            foreach ($fields as $field) {
                                                                if ($field['name'] == 'Countries') {
                                                                    echo ($field['value']);
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $types = $details['types'] ?? [];
                                                        if ($types) {
                                                            foreach ($types as $type) {
                                                                echo ($type) . ', ';
                                                            }
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><a href="../generate-pdf/{{$searchId}}/{{$docId}}"><i class="fa fa-download"></i> Download</a></td>
                                                </tr>
                                            <?php endfor; ?>
                                        </tbody>
                                    </table>

                                <?php

                                elseif ($niraDetails) :
                                    $docId = 'nira';
                                ?>
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Full Name</th>
                                                <th scope="col">Gender</th>
                                                <th scope="col">Date Of Birth</th>
                                                <th scope="col">Marital Status</th>
                                                <th scope="col">Living Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row"><?= 1 ?></th>
                                                <td><?= $niraDetails['surname'] . ' ' . $niraDetails['givenNames'] ?></td>
                                                <td><?= $niraDetails['gender'] ?></td>
                                                <td><?= $niraDetails['dateOfBirth'] ?></td>
                                                <td><?= $niraDetails['maritalStatus'] ?></td>
                                                <td><?= $niraDetails['livingStatus'] ?></td>
                                                <td><a href="../generate-pdf/{{$searchId}}/{{$docId}}"><i class="fa fa-download"></i> Download</a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                <?php

                                elseif ($ursbDetails) :
                                    $docId = 'ursb';
                                ?>
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Full Name</th>
                                                <th scope="col">Certificate No.</th>
                                                <th scope="col">Owner name</th>
                                                <th scope="col">Registration Date</th>
                                                <th scope="col">Phone Contact</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row"><?= 1 ?></th>
                                                <td><?= $ursbDetails['entity_name'] ?></td>
                                                <td><?= $ursbDetails['cert_number'] ?></td>
                                                <td><?= $ursbDetails['applicant'] ?></td>
                                                <td><?= $ursbDetails['reg_date']  ?></td>
                                                <td><?= $ursbDetails['phone_mobile'] ?></td>
                                                <td><a href="../generate-pdf/{{$searchId}}/{{$docId}}"><i class="fa fa-download"></i> Download</a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                <?php else : ?>
                                    <p>No results found</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!--?php endif; ?-->

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

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="{{asset('assets/backend/js/main.js') }}"></script>
</body>

</html>