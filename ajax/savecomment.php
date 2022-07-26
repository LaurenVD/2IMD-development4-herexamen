<?php 
    require_once('../core/autoload.php');
    session_start();

    if(!empty($_POST)){
        $c = new Comment();
        $c->setTaskId($_POST['taskId']);
        $c->setText($_POST['text']);
        $user = User::getUserByUsername($_SESSION['username']);
        $c->setUserId($user['id']);
        $id = $c->save();

        $response = [
            'status' => 'succes',
            'body' => htmlspecialchars($c->getText()),
            'id' => $id,
            'message' => 'Comment saved'
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
    };
?>