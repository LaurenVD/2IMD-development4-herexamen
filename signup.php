<?php include_once('core/autoload.php'); ?>

<?php

    if(!empty($_POST)) {
        try {
            $user = new User();
            $user->setUsername($_POST["username"]);
            $user->setPassword($_POST["password"]);
            $user->signup();

            session_start();
            header("Location: login.php");
        }
        catch(Throwable $error) {
            $error = $error->getMessage();
        }
    }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
</head>
<body>
    <p>Welcom to the To-Do</p>
    <div class="form-signup">
                <form action="" method="post">

                    <!-- errors -->
                    <?php if(isset($error)): ?>
                        <div class="form-error">
                            <p><strong>Opgepast:</strong></p>
                            <?php if(isset($error)) { echo $error; }?>
                        </div>
                    <?php endif; ?>

                    <!-- voornaam -->
                    <div class="form__field">
                        <input type="text" id="username" name="username" placeholder="Username">
                    </div>

                    <!-- wachtwoord -->
                    <div class="form__field">
                        <input type="password" id="wachtwoord" name="password" placeholder="Wachtwoord">
                    </div>

                    <!-- btn -->
                    <div class="form__field">
                        <input type="submit" value="Registreren" class="btn-registreren">
                    </div>

                    <!-- login -->
                    <p class="login">Heb je al een account? <a href="login.php" target="_blank"><strong>Aanmelden</strong></a></p>

                </form>
            </div>
</body>
</html>