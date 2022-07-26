<?php
    include_once('core/autoload.php');
    
    Task::deleteTask($_GET["task"]);
    header("Location: index.php");
?>