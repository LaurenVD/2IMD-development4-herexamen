<?php include_once('core/autoload.php');

if (!empty($_POST)) {
    try {
        $user = new User();
        $user->setUsername($_POST["username"]);
        $user->setPassword($_POST["password"]);
        $user->signup();

        session_start();
        header("Location: login.php");
        die;
        
    } catch (Throwable $error) {
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
    <link rel="stylesheet" href="css/signup.css?v=<?php echo time(); ?>">
</head>
<body>
    <h2>Welcome to the To-Do application</h2>
    <div class="form-signup">
        <form action="" method="post">

            <!-- errors -->
            <?php if (isset($error)) : ?>
                <div class="form-error">
                    <p><strong>Opgepast:</strong></p>
                    <?php if (isset($error)) {
                        echo $error;
                    } ?>
                </div>
            <?php endif; ?>

            <!-- voornaam -->
            <div class="form__field">
                <input type="text" id="username" name="username" placeholder="Username">
            </div>

            <!-- wachtwoord -->
            <div class="form__field">
                <input type="password" id="wachtwoord" name="password" placeholder="Password">
            </div>

            <!-- btn -->
            <div class="form__field">
                <input type="submit" value="Registreren" class="add">
            </div>

            <!-- login -->
            <p class="login">Do you already have an account? <a href="login.php" target="_blank"><strong>Sign in!</strong></a></p>

        </form>
    </div>
</body>
</html>