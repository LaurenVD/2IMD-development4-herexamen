<?php
    include_once('core/autoload.php');

    $todoListId = $_GET['list'];
    $todoList = TodoList::getListArrayById($todoListId);
    
    if($todoList["userId"] != $_SESSION["userId"]){
        header("Location: index.php");
        die;
     }

    TodoList::deleteList($_GET["list"]);
    header("Location: index.php");
    die;
?>