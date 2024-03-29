<?php
    include_once('logged_in.inc.php');
    include_once('core/autoload.php');

    $taskId = $_GET['task'];
    $task = Task::getTaskArrayById($taskId);

    $comments = Comment::getAll($_GET['task']);

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task</title>
    <link rel="stylesheet" href="css/task.css?v=<?php echo time(); ?>">
</head>
<body>
    <?php include_once("nav.inc.php"); ?>    

    <div class="header">
        <h2><?php echo htmlspecialchars($task['title']); ?></h2>
        <p class="bold">Deadline: </p>
        <p><?php echo htmlspecialchars($task['date']); ?></p>
        <p class="bold">Workhours: </p>
        <p><?php echo htmlspecialchars($task['hour']); ?></p>
    </div>

    <a href="edit_task.php?task=<?php echo $_GET["task"]; ?>" class="submit">Edit task</a>
    <br>
    <a href="add_attachment_to_task.php?task=<?php echo $_GET["task"]; ?>" class="submit" id="green">Add attachment</a>
    <br>
    <a href="delete_task.php?task=<?php echo $_GET["task"]; ?>" class="submit" id="red">Delete task</a>
    <br>
    <a href="delete_date.php?task=<?php echo $_GET["task"]; ?>" class="submit" id="red">Delete date</a>
    <br>
    <a href="delete_attachment.php?task=<?php echo $_GET["task"]; ?>" class="submit" id="red">Delete attachment</a>
    <br>

    <?php if(!is_null($task["attachment"])):?>
    <a href="<?php echo $task["attachment"]?>" target="_blank" class="attachment">Attachment</a>
    <?php endif; ?>

    <div class="commentSection">
                <div id="commentForm">
                    <input type="text" id="commentText" placeholder="Leave a comment here">
                    <a href="#" class="add" id="submitComment" data-taskid="<?php echo $task['id'] ?>">Submit comment</a>
                </div>

                <br>

                <ul id="commentList">
                    <?php foreach($comments as $comment): ?>
                        <?php $commentUser = User::getUserById($comment['userId']) ?>
                            <li>
                                <h4 class="detailsText"><?php echo htmlspecialchars($commentUser['username']) ?> reacted:</h4>
                                <p><?php echo htmlspecialchars($comment['text']) ?></p>
                            </li>
                    <?php endforeach; ?>
                </ul>
            </div>

        <script src="js/comment.js"></script>

</body>
</html>