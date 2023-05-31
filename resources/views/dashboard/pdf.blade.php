<!DOCTYPE html>
<html>

<head>
    <title><?=$pageDetails['name']; ?></title>
    <link rel="shortcut icon" href="{{asset('assets/backend/images/favicon.JPG') }}">
</head>

<body style="display: block;
  margin-left: auto;
  margin-right: auto;
  width: 50%;">
    <img src="{{asset('assets/backend/images/favicon.JPG') }}" height="50px" alt="logo">
    <h1 style="color:green">{{ $title }}</h1>
    <p>{{ $date }}</p>
    <p><b>Name:</b> <?= $pageDetails['name'] ?></p>
    <p><b>Entity:</b> <?= $pageDetails['entity_type'] ?></p>
    <p> <b>Countries:</b> 
        <?php
        $fields = $pageDetails['fields'] ?? [];
        if ($fields) {
            foreach ($fields as $field) {
                if ($field['name'] == 'Countries') {
                    echo ($field['value']);
                }
            }
        }
        ?>
    </p>
</body>

</html>