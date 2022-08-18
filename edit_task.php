<?php
    include_once(__DIR__ . "/classes/Db.php");
    include_once('core/autoload.php');

    $taskId = $_GET['task'];

    // update date
    if(isset($_POST['submit'])){
        Task::updateDateForId($taskId, $_POST['date']);
        header("Location: task.php?task=".$_GET['task']);
        die;
    }

    $task = Task::getTaskArrayById($taskId);

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit task</title>
    <link rel="stylesheet" href="css/edit_task.css?v=<?php echo time(); ?>">
</head>
<body>
    <?php include_once("nav.inc.php"); ?>
    <h2>Edit this task</h1>

    <form class="ms-4" action="" method="post">
        <div class="form__field">
            <p>Change your deadline</p>
            <input type="date" id="date" name="date" value="<?php echo $task['date'] ?>">
        </div>

        <input class="submit" type="submit" name="submit" value="Submit">
    </form>

        
    
</body>
</html>