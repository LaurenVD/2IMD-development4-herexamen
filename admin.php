<?php
    include_once('logged_in.inc.php');
    include_once('core/autoload.php');

    if($_SESSION['is_admin'] === false){
       header("Location: index.php");
    }

    $admins = Admin::getAll();

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TODO</title>
    <link rel="stylesheet" href="css/lijst.css?v=<?php echo time(); ?>">
</head>
<body>
    <?php include_once("nav.inc.php"); ?>

    <div class="header">
        <h2>Admin portaal</h2>
    </div>

    <div class="content">
        <h2>Admins</h2>

            <a href="add_admin.php" class="add">Add a new admin</a>

        <!-- tabel -->
        <table class="table">

            <?php if(!empty($admins)): ?>
                <?php foreach($admins as $admin): ?>
                    <tbody>
                        <tr>
                            <td><?php echo $admin['username']; ?></td>
                            <td><a href="delete_admin.php?adminId=<?php echo $admin["id"]; ?>" onClick="return confirm('Ben je zeker?');">Admin verwijderen</a></td>
                        </tr>
                    </tbody>
                <?php endforeach; ?>
            <?php endif; ?>

            <?php if(empty($admins)): ?>
                <p>Geen admins gevonden</p>
            <?php endif; ?>
        </table>

        <h2>Statistieken</h2>
        <ul>
            <li>Aantal users: <?php echo Statistieken::getNumberOfUsers();?></li>
            <li>Aantal lijsten: <?php echo Statistieken::getNumberOfLists();?></li>
            <li>Gemiddeld aantal lijsten per gebruiker: <?php echo round(Statistieken::getAverageNumberOfListsPerUser(), 1);?></li> <!-- 1 decimaal na de komma -->
            <li>Gemiddeld aantal openstaande werkuren per gebruiker: <?php echo round(Statistieken::getAverageSumOfOpenTaskHoursPerUser(), 1);?></li>
        </ul>

    </div>
</body>
</html>