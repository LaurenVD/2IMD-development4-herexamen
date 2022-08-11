<?php
    include_once('logged_in.inc.php');
    include_once('core/autoload.php');

    if($_SESSION['is_admin'] === false){
        header("Location: index.php");
        die;
     }

    if(!empty($_POST)) {
        try {
            $admin = new Admin();
            $admin->setUsername($_POST["username"]);
            $admin->setPassword($_POST["password"]);
            $admin->store();

            header("Location: admin.php");
            die;
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
    <title>Add admin</title>
    <link rel="stylesheet" href="css/add_task.css?v=<?php echo time(); ?>">
</head>
<body>
    <?php include_once("nav.inc.php"); ?>

    <h2>Add a new admin</h2>

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
                <input type="password" id="wachtwoord" name="password" placeholder="Wachtwoord">
            </div>

            <!-- btn -->
            <div class="form__field">
                <input type="submit" value="toevoegen" class="btn-toevoegen">
            </div>

        </form>
    </div>

   
</body>
</html>