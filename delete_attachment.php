<?php
    include_once('core/autoload.php');

    $taskId = $_GET['task'];
    $task = Task::getTaskArrayById($taskId);

    if($task["userId"] != $_SESSION["userId"]){
        header("Location: index.php");
        die;
     }
    
    $currentDirectory = getcwd();
    $path = $currentDirectory . "/" . $task["attachment"];

    unlink($path);
    Task::deleteAttachment($taskId);
    header("Location: task.php?task=".$_GET['task']);
    die;
?>