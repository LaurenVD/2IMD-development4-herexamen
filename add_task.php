<?php
    include_once('logged_in.inc.php');
    include_once('core/autoload.php');

    if(!empty($_POST)) {
        try {
            $task = new Task();
            if(isset($_SESSION['userId'])) {
                $task->setUserId($_SESSION['userId']);
            }
            else {
                $task->setUserId(1);
            }
            $task->setTitle($_POST["title"]);
            $task->setDate(date("Y-m-d"));
            $task->setHour($_POST["hour"]);
            $task->add();

            header("Location: lijst.php");
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
    <title>Add task</title>
</head>
<body>
    <?php include_once("nav.inc.php"); ?>

    <br>

    <h2>Add a new task</h2>

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
            <input type="text" id="title" name="title" placeholder="Title">
        </div>

     <div class="form__field">
            <input type="number" id="hour" name="hour">
        </div>

        <div class="form__field">
            <input type="date" id="date" name="date">
        </div>

        <div class="form__field">
            <input type="submit" name="toevoegen" value="Add task" class="btn-toevoegen">

            <a href="index.php" class="annuleren">Cancel</a>
        </div>
    </form>
    </div>
</body>
</html>