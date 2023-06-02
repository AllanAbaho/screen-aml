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
    <h1>{{ $title }}</h1>
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
    <p> <b>Sources:</b> 
        <?php
        $types = $pageDetails['types'] ?? [];
        if ($types) {
            foreach ($types as $type) {
                echo ($type) . ', ';
            }
        }
        ?>
    </p>
    <p> <b>Links:</b> <br>
        <?php
        $links = $pageDetails['media'] ?? [];
        if ($links) {
            foreach ($links as $link) {
                echo  ($link['url']) . '<br> <br>';
            }
        }
        ?>
    </p>
</body>

</html>