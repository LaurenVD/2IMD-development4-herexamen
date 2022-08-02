<?php
    include_once('logged_in.inc.php');
    include_once('core/autoload.php');

    $lijstId = $_GET["lijstId"];
    $lijst = Lijst::getLijstById($lijstId);
    // controleren of de gebruiker weldegelijk de lijst bezit, zo niet, redirect naar de index
    if($lijst["userId"] != $_SESSION["userId"]){
        header("Location: index.php");
     }

    if(!empty($_POST)) {
        try {
            $task = new Task();
            $task->setUserId($_SESSION['userId']);
            $task->setLijstId($_POST["lijstId"]);
            $task->setTitle($_POST["title"]);
            $task->setDate($_POST["date"]);
            $task->setHour($_POST["hour"]);
            $task->add();

            header("Location: lijst.php?lijst=".$_POST['lijstId']);
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
    <link rel="stylesheet" href="css/add_task.css?v=<?php echo time(); ?>">
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
            <p>Fill in your title</p>
            <input type="text" id="title" name="title" placeholder="Title">
        </div>


        <input type="hidden" name="lijstId" value="<?php echo $_GET['lijstId']; ?>">


        <div class="form__field">
            <p>Fill in your workhours</p>
            <input type="number" id="hour" name="hour">
        </div>

        <div class="form__field">
            <p>Fill in your deadline</p>
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