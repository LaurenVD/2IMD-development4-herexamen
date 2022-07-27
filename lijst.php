<?php
    include_once('logged_in.inc.php');
    include_once('core/autoload.php');

    $lijstId = $_GET['lijst'];
    $lijst = Lijst::getLijstById($lijstId);

    $tasks = Task::getAll($lijstId);

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TODO</title>
</head>
<body>
    <?php include_once("nav.inc.php"); ?>

    <div class="header">
        <h2><?php echo htmlspecialchars($lijst['title']); ?></h2>
        <p><?php echo htmlspecialchars($lijst['description']); ?></p>
    </div>

    <a href="delete_lijst.php?lijst=<?php echo $_GET["lijst"]; ?>" class="delete">Delete list</a>

    <div class="content">
        <h2>Todo's</h2>

        <br>

        <!-- todo toevoegen -->
        <div class="topic">
            <a href="add_task.php" class="add">Add a new task!</a>
        </div>

        <!-- tabel -->
        <table class="table">

            <?php if(!empty($tasks)): ?>
                <?php foreach($tasks as $task): ?>
                    <tbody>
                        <tr>
                            <td style="text-decoration: underline"><a href="task.php?task=<?php echo $task["id"]; ?>" class="btn btn-info"><?php echo htmlspecialchars($task['title']); ?></a></td>
                            <td><p><?php echo htmlspecialchars($task['date']); ?></p></td>
                        </tr>
                    </tbody>
                <?php endforeach; ?>
            <?php endif; ?>

            <?php if(empty($tasks)): ?>
                <p>No tasks found</p>
            <?php endif; ?>
        </table>
    </div>
</body>
</html>