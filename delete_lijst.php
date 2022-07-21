<?php
    include_once('core/autoload.php');
    
    Lijst::deleteLijst($_GET["lijst"]);
    header("Location: index.php");
?>