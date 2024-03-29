<?php
    include_once('core/autoload.php');
    session_start();

    if(isset($_SESSION["loggedIn"])) {
        header("Location: index.php"); 
        die;  
    }

    if(isset($_POST["login"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        if(User::login($username, $password)) {
            $_SESSION['username'] = $username;
            $_SESSION['loggedIn'] = true;
            $_SESSION["userId"] = User::getUserIdByUsername($username);
            $_SESSION['is_admin'] = Admin::isAdmin($_SESSION["userId"]);

            header("Location: index.php");
            die;
		}
        else {
            $error = "Your email or password is incorrect.";
        }
    }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="stylesheet" href="css/login.css?v=<?php echo time(); ?>">
</head>
<body>
<div class="form-login">
                <form action="" method="post">

                    <h2>Log into the To-Do application</h2>

                    <!-- errors -->
                    <?php if(isset($error)): ?>
                        <div class="form-error">
                            <p><strong>Watch out:</strong></p>
                            <?php if(isset($error)) { echo $error; }?>
                        </div>
                    <?php endif; ?>

                    <!-- username -->
                    <div class="form__field">
                        <input type="text" id="username" name="username" placeholder="Username">
                    </div>

                    <!-- wachtwoord -->
                    <div class="form__field">
                        <input type="password" id="wachtwoord" name="password" placeholder="Password">
                    </div>

                    <!-- btn -->
                    <div class="form__field">
                        <input type="submit" name="login" value="Aanmelden" class="btn-aanmelden">
                    </div>

                    <!-- signup -->
                    <p class="signup">Don't have an account yet? <a href="signup.php" target="_blank"><strong>Sign up!</strong></a></p>

                </form>
            </div>
</body>
</html>