<?php 
    require_once('../core/autoload.php');
    session_start();

    if(!empty($_POST)){
        $c = new Comment();
        $c->setTaskId($_POST['taskId']);
        $c->setText($_POST['text']);
        $c->setUserId($_SESSION['userId']);
        $id = $c->save();

        $response = [
            'status' => 'succes',
            'body' => htmlspecialchars($c->getText()),
            'username' => $_SESSION['username'],
             'id' => $id,
            'message' => 'Comment saved'
        ];

        header('Content-Type: application/json');
       echo json_encode($response);
    };
?>