<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
</head>
<body>
    <form method="POST" enctype="multipart/form-data">
        <input name="email" type="email" placeholder="E-mail" required />
        <input name="newPass" type="password" placeholder="Nova senha" required />
        <input name="confirmNewPass" type="password" placeholder="Confirmar senha" required />
        <input name="button" type="submit" value="Mudar Senha" />
    </form>
</body>
</html>

<script>
    <?php
        require __DIR__ . '\Source\autoload.php';
        require __DIR__ . '\Source\Support\Config.php';
        require __DIR__ . "\Source\Support\ChangePass.php";
    
        $verifyPass = new \Source\Support\Cadastro();
        $changePass = new \Source\Support\ChangePass();

        if ((isset($_POST['button']))) {
            if ($verifyPass->confirmPassword($_POST['newPass'], $_POST['confirmNewPass'])) {
                if ($changePass->verifyOldPassword($_POST['newPass'], $_POST['email'])) {
                    $changePass->changePass($_POST['newPass'], $_POST['email']);
                }
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