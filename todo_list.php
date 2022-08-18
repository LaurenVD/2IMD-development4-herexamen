<?php
    include_once('logged_in.inc.php');
    include_once('core/autoload.php');

    $listId = $_GET['list'];
    $list = TodoList::getListArrayById($listId);

    // controleren of de gebruiker weldegelijk de lijst bezit, zo niet, redirect naar de index
    if($list["userId"] != $_SESSION["userId"]){
       header("Location: index.php");
       die;
    }

    //we nemen de variabele als deze is meegegeven
    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'date';
    $order = isset($_GET['order']) ? $_GET['order'] : 'asc';
    $tasks = Task::getAllForId($listId, $sort, $order);

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TODO</title>
    <link rel="stylesheet" href="css/todoList.css?v=<?php echo time(); ?>">
</head>
<body>
    <?php include_once("nav.inc.php"); ?>

    <div class="header">
        <h2><?php echo htmlspecialchars($list['title']); ?></h2>
        <p class="description"><?php echo htmlspecialchars($list['description']); ?></p>
    </div>

    <a href="delete_todo_list.php?list=<?php echo $_GET["list"]; ?>" class="add" id="red">Delete list</a>

    <div class="content">
        <h2>Todo's</h2>

        <!-- todo toevoegen -->
        <div class="task">
            <a href="add_task.php?listId=<?php echo $list['id']; ?>" class="add">Add a new to-do!</a>
        </div>

        <br>

        <a class="sort" href="todo_list.php?list=<?php echo $list['id']; ?>&sort=date&order=asc">Sorteer op datum</a>
        <a class="sort" href="todo_list.php?list=<?php echo $list['id']; ?>&sort=hour&order=desc">Sorteer op uren</a>

        <!-- tabel -->
        <table class="table">

            <?php if(!empty($tasks)): ?>
                <?php foreach($tasks as $task): ?>
                    <tbody>
                        <tr>
                            <td><a class="doneBtnAnchor" data-task-id="<?php echo $task['id'] ?>" href=""><?php if($task["done"] == 1):?><img src="./images/doneblue.svg" alt=""><?php else:?><img src="./images/donegrey.svg" alt=""><?php endif;?></a></td>
                            <td style="text-decoration: underline"><a href="task.php?task=<?php echo $task["id"]; ?>" class="btn"><?php echo htmlspecialchars($task['title']); ?></a></td>
                            <td><p class="date<?php if(Task::getIsPast($task['date']) == 1): ?>isPast <?php endif; ?>"><?php echo htmlspecialchars($task['date']); ?></p></td>
                            <td><p class="date<?php if(Task::getIsPast($task['date']) == 1): ?>isPast <?php endif; ?>"> <?php echo Task::getDaysRemaining($task['date']); ?></p></td>
                            <td><p class="workhour"> <?php echo $task['hour']; ?></p></td>
                        </tr>
                    </tbody>
                <?php endforeach; ?>
            <?php endif; ?>

            <?php if(empty($tasks)): ?>
                <p>No tasks found</p>
            <?php endif; ?>
        </table>
    </div>

    <script src="js/done.js"></script>
</body>
</html>