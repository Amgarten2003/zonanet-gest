<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TOKEN</title>
</head>
<body>
    <form method="GET" enctype="multipart/form-data">
        <input name="token" type="text" placeholder="Seu Token" required />
        <input name="submitToken" type="submit" value="Enviar" />
    </form>
</body>
</html>


<script>
    <?php
    require __DIR__ . '\Source\autoload.php';
    require __DIR__ . '\Source\Support\Config.php';

    $generateToken = new Source\Support\Token();

    $token = $generateToken->generateToken();
    $generateToken->sendTokenToDB($token);    
    
    if (isset($_GET['submitToken'])) {
        if ($generateToken->verifyToken($_GET['token'])) {
            $generateToken->setInactiveToken($_GET['token']);
            header("Location: " . URL_HOME);
        }
    }
    ?>
</script>


<!-- JS SCRIPT -->


<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href);
    }
</script>