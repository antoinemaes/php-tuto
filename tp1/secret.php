<!DOCTYPE HTML>
<head>
    <title>Secret</title>
</head>
<body>
    <?php
        if(isset($_GET['password']) AND $_GET['password']=='kangourou')
                echo 'The secret is 42.';
        else
                echo 'You did not provide the correct password.';
    ?>
</body>

