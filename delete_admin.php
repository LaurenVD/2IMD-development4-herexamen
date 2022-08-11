<?php
    include_once('logged_in.inc.php');
    include_once('core/autoload.php');

    if($_SESSION['is_admin'] === false){
        header("Location: index.php");
        die;
     }

    if(!empty($_GET)) {
        try {
            $admin = new Admin();
            $admin->setUserId($_GET["adminId"]);
            $admin->delete();

            header("Location: admin.php");
            die;
        }
        catch(Throwable $error) {
            $error = $error->getMessage();
        }
    }

?>