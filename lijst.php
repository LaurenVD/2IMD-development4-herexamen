<?php
    include_once('logged_in.inc.php');
    include_once('core/autoload.php');

    $tasks = Task::getAll();

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

    <div class="content">
        <h2>Todo's</h2>

        <br>

        <!-- topic toevoegen -->
        <div class="topic">
            <a href="add_task.php" class="add">Add a new todo!<i class="fas fa-plus" style="color: #C78743;"></i></a>
        </div>

        <!-- tabel -->
        <table class="table">

            <?php if(!empty($tasks)): ?>
                <?php foreach($tasks as $task): ?>
                    <tbody>
                        <tr>
                            <td style="text-decoration: underline"><a href="topic.php?topic=<?php echo $task["id"]; ?>" class="btn btn-info"><?php echo htmlspecialchars($task['title']); ?></a></td>
                            <td><?php echo htmlspecialchars($task['date']); ?></td>
                            <td><?php echo htmlspecialchars($task['hour']); ?></td>
                        </tr>
                    </tbody>
                <?php endforeach; ?>
            <?php endif; ?>

            <?php if(empty($tasks)): ?>
                <tbody>
                    <tr>
                        <td>N.v.t.</td>
                        <td>0</td>
                        <td>0</td>
                        <td>Y-m-d</td>
                    </tr>
                </tbody>
            <?php endif; ?>
        </table>
    </div>
</body>
</html>