<!DOCTYPE html>
<html>

<head>
    <title><?= $title; ?></title>
    <link rel="shortcut icon" href="{{asset('assets/backend/images/favicon.JPG') }}">
</head>

<body style="display: block;
  margin-left: auto;
  margin-right: auto;
  width: 50%;">
    <img src="{{asset('assets/backend/images/favicon.JPG') }}" height="50px" alt="logo">
    <h1>{{ $title }}</h1>
    <p>{{ $date }}</p>
    <?php if ($niraDetails) : ?>
        <p>NIRA Details</p>
        <p><b>Name:</b> <?= $niraDetails['surname'] . ' ' .  $niraDetails['givenNames'] ?></p>
        <p><b>Date Of Birth:</b> <?= $niraDetails['dateOfBirth'] ?></p>
        <p><b>Gender:</b> <?= $niraDetails['gender'] ?></p>
        <p><b>Nationality:</b> <?= $niraDetails['nationality'] ?></p>
        <p><b>Living Status:</b> <?= $niraDetails['livingStatus'] ?></p>
        <p><b>Marital Status:</b> <?= $niraDetails['maritalStatus'] ?></p>
        <p><b>Email:</b> <?= $niraDetails['eMail1'] ?></p>
        <p><b>Address:</b> <?= $niraDetails['addressLine1'] ?></p>

    <?php endif; ?>

    <?php if ($pageDetails) : ?>

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
                    echo ($link['url']) . '<br> <br>';
                }
            }
            ?>
        </p>
    <?php endif; ?>

</body>

</html>