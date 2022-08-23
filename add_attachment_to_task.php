<?php
    include_once(__DIR__ . "/classes/Db.php");
    include_once('core/autoload.php');

    $taskId = $_GET['task'];

    // add a file, bron: https://blog.filestack.com/thoughts-and-knowledge/php-file-upload/#2_The_PHP_File_Upload_Script
    if(isset($_POST['submit'])){
        if(isset($_FILES['upload_attachment'])) {
            $task = Task::getTaskById($_POST["taskId"]);

            if($task->getUserId() != $_SESSION["userId"]){
                header("Location: index.php");
            }

            $currentDirectory = getcwd();
            $uploadDirectory = "/task_files/";
            $fileName = $_FILES['upload_attachment']['name'];
            $fileTmpName = $_FILES['upload_attachment']['tmp_name'];
            $uploadPath = $currentDirectory . $uploadDirectory . $fileName;
            move_uploaded_file($fileTmpName, $uploadPath);
            $task->setAttachment("task_files/" .$fileName);
            $task->update();
        }

        header("Location: task.php?task=".$_POST['taskId']);
        die;
    }

    $task = Task::getTaskArrayById($taskId);

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add attachment</title>
    <link rel="stylesheet" href="css/add_attachment.css?v=<?php echo time(); ?>">
</head>
<body>
    <?php include_once("nav.inc.php"); ?>
    <h2>Edit task</h1>

    <form class="ms-4" action="" method="post" enctype="multipart/form-data">
        <div class="form__field">
            <p>Select attachment</p>
            <input type="file" name="upload_attachment" value="Upload attachment" class="upload_attachment" >
        </div>

        <input type="hidden" name="taskId" value="<?php echo $taskId ;?>">

        <input class="submit" type="submit" name="submit" value="Submit">
    </form>
</body>
</html>