<?php
    include_once('core/autoload.php');

    $taskId = $_GET['task'];
    $task = Task::getTaskArrayById($taskId);

    if($task["userId"] != $_SESSION["userId"]){
        header("Location: index.php");
     }
    
     Task::setDateToNull($_GET["task"]);
     header("Location: task.php?task=".$_GET['task']);
     die;
?>