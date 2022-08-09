<?php
    include_once('logged_in.inc.php');
    include_once('core/autoload.php');

    if($_SESSION['is_admin'] === false){
        header("Location: index.php");
     }

    if(!empty($_GET)) {
        try {
            $admin = new Admin();
            $admin->setUserId($_GET["adminId"]);
            $admin->delete();

            header("Location: admin.php");
        }
        catch(Throwable $error) {
            $error = $error->getMessage();
        }
    }

?>