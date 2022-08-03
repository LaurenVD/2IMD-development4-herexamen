<?php
require_once('../core/autoload.php');
session_start();

if (!empty($_POST)) {
    $task = Task::getTaskById($_POST['taskId']);
    $currentDoneValue = $task->getDone();
    // var_dump($task);
    // die; 


    //als done op 0 staat
    if ($currentDoneValue == 0) {
        // done op 1 plaatsen 
        $task->setDone(1);

        // zo niet staat het op 1
    } else {
        // done op 0 plaatsen
        $task->setDone(0);
    }

    // opslaan
    $task->update();

    $response = [
        'status' => 'succes',
        'username' => $_SESSION['username'],
        'id' => $task->getId(),
        'done' => $task->getDone(),
        'message' => 'Task field done toggled'
    ];

    header('Content-Type: application/json');
    echo json_encode($response);
};
