<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>
<body>
    <form method="POST" enctype="multipart/form-data">
        <input name="firstName" type="text" placeholder="Primeiro Nome" required />
        <input name="lastName" type="text" placeholder="Último Nome" required />
        <input name="username" type="text" placeholder="Nome de Usuário" required />
        <input name="email" type="email" placeholder="E-mail Nome" required />
        <input name="password" type="password" placeholder="Senha" required />
        <input name="confpassword" type="password" placeholder="Confirmar senha" required />
        <input name="button" type="submit" value="Cadastrar" />
    </form>
</body>
</html>

<script>
    <?php
    require __DIR__ . '\Source\autoload.php';
    require __DIR__ . "\Source\Support\Config.php";

    $cadastro = new \Source\Support\Cadastro();

    $cadastro->setFirstName($_POST['firstName']);
    $cadastro->setLastName($_POST['lastName']);
    $cadastro->setUser($_POST['username']);
    $cadastro->setEmail($_POST['email']);
    
    if ($cadastro->confirmPassword($_POST['password'], $_POST['confpassword'])) {
        $password = $cadastro->setPassword($_POST['password']);
    }


    if (isset($_POST['button'])) {
        if ($cadastro->verifyExistingAccount($_POST['username'], $_POST['email'])) {
            $cadastro->createUser($cadastro->getFirstName(), $cadastro->getLastName(), $cadastro->getUser(), $cadastro->getEmail(), $cadastro->getPassword());
            header("Location: " . URL_TOKEN);
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