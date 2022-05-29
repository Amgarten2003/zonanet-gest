<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form method="POST" enctype="multipart/form-data">
        <input name="email" type="email" placeholder="E-mail" required />
        <input name="password" type="password" placeholder="Senha" required />

        <br><br>
        <input name="button" type="submit" value="Login" /> 
    </form>

    <a href="cadastro.php">
      <input type="submit" value="Cadastrar"/>
    </a>
</body>
</html>


<script>
    <?php
    require __DIR__ . "\Source\autoload.php";
    require __DIR__ . "\Source\Support\Config.php";

    $user = new \Source\Support\User();
    $login = new \Source\Support\Login();
    
    if (isset($_POST['button'])) {
        $login->setEmail($_POST['email']);
        $login->setPassword($_POST['password']);
        $login->verifyCredentials($_POST['email'], $_POST['password']);
    }
    ?>
</script>


<!-- JS SCRIPT -->

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href);
    }
</script>
