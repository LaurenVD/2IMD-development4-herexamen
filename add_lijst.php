<?php
    include_once('logged_in.inc.php');
    include_once('core/autoload.php');

    if(!empty($_POST)) {
        try {
            $lijst = new Lijst();
            if(isset($_SESSION['userId'])) {
                $lijst->setUserId($_SESSION['userId']);
            }
            else {
                $lijst->setUserId(1);
            }
            $lijst->setTitle($_POST["title"]);
            $lijst->setDescription($_POST["description"]);
            $lijst->add();

            header("Location: index.php");
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
    <title>Add list</title>
    <link rel="stylesheet" href="css/add_lijst.css?v=<?php echo time(); ?>">
</head>
<body>
   <?php include_once("nav.inc.php"); ?>

        <br>

        <h2>Add a new list</h2>

        <br>

        <form action="" method="post">
            <!-- errors -->
            <?php if(isset($error)): ?>
                <div class="form-error">
                    <p><strong>Opgepast:</strong></p>
                    <?php if(isset($error)) { echo $error; }?>
                </div>
                <br>
            <?php endif; ?>

            <div class="form__field">
                <input type="text" id="titel" name="title" placeholder="Title">
            </div>

            <div class="form__field">
                <textarea rows="4" cols="50" id="omschrijving" name="description" placeholder="Give a description for your list"></textarea>
            </div>

            <div class="form__field">
                <input type="submit" name="toevoegen" value="Add list" class="btn-toevoegen">

                <a href="index.php" class="annuleren">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>