<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Infos</title>
</head>
<body>
    <form method="POST" enctype="multipart/form-data">
        <input name="currentUser" type="text" placeholder="Usuário atual" required />
        <br><br>

        <input name="firstName" type="text" placeholder="Novo primeiro nome" />
        <br><br>
        
        <input name="lastName" type="text" placeholder="Novo último nome" />
        <br><br>
        
        <input name="username" type="text" placeholder="Novo usuário" />
        <br><br>
        
        <input name="email" type="email" placeholder="Novo e-mail" />
        <br><br>
        
        <input name="password" type="password" placeholder="Novo senha" />
        <br><br>
        
        <input name="submitButton" type="submit" value="Alterar" />
    </form>
</body>
</html>


<script>
    <?php
        require __DIR__ . '\Source\autoload.php';
        require __DIR__ . '\Source\Support\Config.php';

        $changeInfos = new \Source\Support\ChangeInfos();


        if (!empty($_POST['firstName'])) {
            $changeInfos->changeFirstName($_POST['currentUser'], $_POST['firstName']);
        }
        
        if (!empty($_POST['lastName'])) {
            $changeInfos->changeLastName($_POST['currentUser'], $_POST['lastName']);
        }

        if (!empty($_POST['username'])) {
            $changeInfos->changeUsername($_POST['currentUser'], $_POST['username']);
        }
        
        if (!empty($_POST['email'])) {
            $changeInfos->changeEmail($_POST['currentUser'], $_POST['email']);
        }

        if (!empty($_POST['password'])) {
            if ($changeInfos->verifyPassword($_POST['password'])) {
                var_dump($changeInfos->changePassword($_POST['currentUser'], $_POST['password']));
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