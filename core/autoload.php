<?php
    spl_autoload_register(function($className) {
        include_once(__DIR__ ."/../classes/".$className.".php");
    });
?>