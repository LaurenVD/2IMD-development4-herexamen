<?php
    include_once('logged_in.inc.php');
    include_once('core/autoload.php');

    if($_SESSION['is_admin'] === false){
       header("Location: index.php");
       die;
    }

    $admins = Admin::getAll();

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="css/admin.css?v=<?php echo time(); ?>">
</head>
<body>
    <?php include_once("nav.inc.php"); ?>

    <div class="header">
        <h2>Admin page</h2>
    </div>

    <div class="content">
        <h2>Admins</h2>

            <a href="add_admin.php" class="submit">Add a new admin</a>

        <!-- tabel -->
        <table class="table">

            <?php if(!empty($admins)): ?>
                <?php foreach($admins as $admin): ?>
                    <tbody>
                        <tr>
                            <td style="text-decoration: underline"><?php echo $admin['username']; ?></td>
                            <td><a class="delete" href="delete_admin.php?adminId=<?php echo $admin["id"]; ?>" onClick="return confirm('Are you sure?');">Delete admin</a></td>
                        </tr>
                    </tbody>
                <?php endforeach; ?>
            <?php endif; ?>

            <?php if(empty($admins)): ?>
                <p>No admins found</p>
            <?php endif; ?>
        </table>

        <h2>Statistics</h2>
        <ul>
            <li>Amount of users: <?php echo htmlspecialchars(Statistics::getNumberOfUsers());?></li>
            <li>Amount of lists: <?php echo htmlspecialchars(Statistics::getNumberOfLists());?></li>
            <li>Average number of lists per user: <?php echo htmlspecialchars(round(Statistics::getAverageNumberOfListsPerUser(), 1));?></li> <!-- 1 decimaal na de komma -->
            <li>Average sum of open task hours per user: <?php echo htmlspecialchars(round(Statistics::getAverageSumOfOpenTaskHoursPerUser(), 1));?></li>
        </ul>

    </div>
</body>
</html>