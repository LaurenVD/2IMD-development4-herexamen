<?php include_once('logged_in.inc.php');?>
<?php include_once('core/autoload.php');?>

<?php 

    $userId = $_SESSION["userId"];
    $user = User::getUserById($userId);

    $lijsten = Lijst::getAllForUser($userId);

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TODO APP<?php echo $user["id"]; ?></title>
    <link rel="stylesheet" href="css/index.css?v=<?php echo time(); ?>">
</head>
<body>
    <?php include_once("nav.inc.php"); ?>

    <div class="content">
        <h2>Your to-do's</h2>

        <!-- lijst toevoegen -->
        <div class="topic">
            <a href="add_lijst.php" class="add">Add a new list!</a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">To-do lists</th>
                </tr>
            </thead>

            <?php if(!empty($lijsten)): ?>
                <?php foreach($lijsten as $lijst): ?>
                    <tbody>
                        <tr>
                            <td style="text-decoration: underline"><a href="lijst.php?lijst=<?php echo $lijst["id"]; ?>" class="btn btn-info"><?php echo htmlspecialchars($lijst['title']); ?></a></td>
                        </tr>
                    </tbody>
                <?php endforeach; ?>
            <?php endif; ?>

            <?php if(empty($lijsten)): ?>
                <tbody>
                    <td>Oops! You have no lists!</td>
                </tbody>
            <?php endif; ?>
        </table>
    </div>
</body>
</html>