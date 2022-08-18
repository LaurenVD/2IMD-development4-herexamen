<?php 
    include_once('logged_in.inc.php');
    include_once('core/autoload.php');

    $userId = $_SESSION["userId"];
    $user = User::getUserById($userId);

    $todoLists = TodoList::getAllForUser($userId);

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TODO APP</title>
    <link rel="stylesheet" href="css/index.css?v=<?php echo time(); ?>">
</head>
<body>
    <?php include_once("nav.inc.php"); ?>

    <div class="content">
        <h2>Your to-do's</h2>

        <!-- lijst toevoegen -->
        <div class="task">
            <a href="add_todo_list.php" class="add">Add a new list!</a>
        </div>

        <br>

        <table class="table">
            <thead>
                <tr>
                    <th>To-do lists</th>
                </tr>
            </thead>

            <?php if(!empty($todoLists)): ?>
                <?php foreach($todoLists as $todoList): ?>
                    <tbody>
                        <tr>
                            <td style="text-decoration: underline"><a href="todo_list.php?list=<?php echo $todoList["id"]; ?>" class="btn"><?php echo htmlspecialchars($todoList['title']); ?></a></td>
                        </tr>
                    </tbody>
                <?php endforeach; ?>
            <?php endif; ?>

            <?php if(empty($todoLists)): ?>
                <tbody>
                    <td>Oops! You have no lists!</td>
                </tbody>
            <?php endif; ?>
        </table>
    </div>
</body>
</html>