<?php
    include_once('logged_in.inc.php');
    include_once('core/autoload.php');

    $lijstId = $_GET['lijst'];
    $lijst = Lijst::getLijstById($lijstId);

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TODO - Lijst</title>
</head>
<body>
    <?php include_once("nav.inc.php"); ?>

    <div class="content">
        <div class="card">
            <div class="back">
                <a href="forum.php" class="back"><i class="fas fa-arrow-left" style="color: #C78743;"></i></a>

                    <a href="delete_lijst.php?lijst=<?php echo $_GET["lijst"]; ?>" class="delete"><i>Verwijderen</i></a>
            </div>

            <br>

            <div class="header">
                <h2><?php echo htmlspecialchars($lijst['title']); ?></h2>
            </div>
            
            <br>
            <p><?php echo htmlspecialchars($lijst['description']); ?></p>
            <br>

            <div class="tasks">
                <a href="//">Add a todo</a>
            </div>
        </div>
    </div>
</body>
</html>