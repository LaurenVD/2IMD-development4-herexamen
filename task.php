<?php
    include_once('logged_in.inc.php');
    include_once('core/autoload.php');

    $taskId = $_GET['task'];
    $task = Task::getTaskById($taskId);

    $comments = Comment::getAll($_GET['task']);

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
        <h2><?php echo htmlspecialchars($task['title']); ?></h2>
        <p><?php echo htmlspecialchars($task['date']); ?></p>
        <p><?php echo htmlspecialchars($task['hour']); ?></p>
    </div>

    <a href="delete_task.php?task=<?php echo $_GET["task"]; ?>" class="delete">Delete task</a>

    <div class="commentSection">
                <div id="commentForm">
                    <input type="text" id="commentText" placeholder=" Laat een reactie achter">
                    <a href="#" id="submitComment" data-taskid="<?php echo $task['id'] ?>">Submit comment</a>
                </div>

                <br>

                <ul id="commentList">
                    <?php foreach($comments as $comment): ?>
                        <?php $commentUser = User::getUserById($comment['userId']) ?>
                            <li>
                                    <h4 class="detailsText"><?php echo $commentUser['username'] ?> reacted:</h4>
                                    <p><?php echo $comment['text'] ?></p>
                            </li>
                    <?php endforeach; ?>
                </ul>
            </div>

        <script src="js/comment.js"></script>

</body>
</html>