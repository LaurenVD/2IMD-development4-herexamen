<?php
    include_once('logged_in.inc.php');
    include_once('core/autoload.php');

    $listId = $_GET["listId"];
    $list = TodoList::getListArrayById($listId);
    // controleren of de gebruiker weldegelijk de lijst bezit, zo niet, redirect naar de index
    if($list["userId"] != $_SESSION["userId"]){
        header("Location: index.php");
        die;
     }

    // error wanneer een titel van een task al in gebruik is
    if(!empty($_POST)) {
        if(TodoList::isThereATaskWithTitleInList($_POST["title"], $listId) == true){
            header("Location: add_task.php?listId=".$_POST['listId']."&error=Er staat iets in task met deze naam");
            die;
        }
        try {
            $task = new Task();
            $task->setUserId($_SESSION['userId']);
            $task->setListId($_POST["listId"]);
            $task->setTitle($_POST["title"]);
            $task->setDate($_POST["date"]);
            $task->setHour($_POST["hour"]);
            $task->add();

            header("Location: todo_list.php?list=".$_POST['listId']);
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
    <title>Add task</title>
    <link rel="stylesheet" href="css/add_task.css?v=<?php echo time(); ?>">
</head>
<body>
    <?php include_once("nav.inc.php"); ?>

    <br>

    <h2>Add a new task</h2>

    <?php if(isset($_GET["error"])): ?>
        <p>There is already a task with this name.</p>
    <?php endif; ?>

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


        <input type="hidden" name="listId" value="<?php echo $_GET['listId']; ?>">


        <div class="form__field">
            <p>Fill in your workhours</p>
            <input type="number" id="hour" name="hour">
        </div>

        <div class="form__field">
            <p>Fill in your deadline</p>
            <input type="date" id="date" name="date">
        </div>

        <div class="form__field">
            <input type="submit" name="add" value="Add task" class="submit">

            <a href="index.php" class="cancel">Cancel</a>
        </div>
    </form>
    </div>
</body>
</html>