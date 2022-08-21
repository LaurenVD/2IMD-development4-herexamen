<?php
    include_once('core/autoload.php');

    $listId = $_GET["listId"];
    $list = TodoList::getListArrayById($listId);

    if($list["userId"] != $_SESSION["userId"]){
        header("Location: index.php");
     }
    
    Task::deleteTask($_GET["task"]);
    header("Location: index.php");
    die;
?>