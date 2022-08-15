<?php
include_once(__DIR__ . "/Db.php");

class Task
{
    private $id;
    private $userId;
    private $listId;
    private $title;
    private $hour;
    private $date;
    private $done;
    private $attachment;

    // task id
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    // user id
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    // lijst id
    public function setListId($listId)
    {
        $this->listId = $listId;
    }

    public function getListId()
    {
        return $this->listId;
    }

    // title
    public function setTitle($title)
    {
        self::checkTitle($title);
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    // title check
    public function checkTitle($title)
    {
        if (empty($title)) {
            throw new Exception("Voer een geldige titel in.");
        }
    }

    // description
    public function setHour($hour)
    {
        $this->hour = $hour;
    }

    public function getHour()
    {
        return $this->hour;
    }


    // date
    public function setDate($date)
    {
        $date = new DateTime($date);
        $this->date = $date->format('Y-m-d');
    }

    public function getDate()
    {
        return $this->date;
    }

    // done
    public function setDone($done)
    {
        $this->done = $done;
    }

    public function getDone()
    {
        return $this->done;
    }

    //attachment
    public function setAttachment($attachment)
    {
        $this->attachment = $attachment;
    }

    public function getAttachment()
    {
        return $this->attachment;
    }

    // add a task to database
    public function add()
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("insert into tasks (userId, title, listId, hour, date) values (:userId, :title, :listId, :hour, :date)");
        $statement->bindValue(":userId", $this->userId);
        $statement->bindValue(":title", $this->title);
        $statement->bindValue(":listId", $this->listId);
        $statement->bindValue(":hour", $this->hour);
        $statement->bindValue(":date", $this->date);
        $statement->execute();
    }

    // update to get the to-do to done or not done
    public function update()
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("UPDATE tasks SET userId = :userId, title = :title, listId = :listId, hour = :hour, date = :date, done = :done, attachment = :attachment WHERE id = :id");

        $statement->bindValue(':userId', $this->userId);
        $statement->bindValue(':id', $this->id);
        $statement->bindValue(":title", $this->title);
        $statement->bindValue(":listId", $this->listId);
        $statement->bindValue(":hour", $this->hour);
        $statement->bindValue(":date", $this->date);
        $statement->bindValue(":done", $this->done);
        $statement->bindValue(":attachment", $this->attachment);
        $statement->execute();
    }

    // get all task information
    public static function getAllForId($listId, $sort, $order)
    {
        $sanitisedSort = self::whiteList($sort, ["date", "hour"]);
        $sanitisedOrder = self::whiteList(strtolower($order), ["asc", "desc"]);
        $conn = Db::getInstance();
        // de variabelen sort en order worden gesanitised door de whiteList functie
        $statement = $conn->prepare("select * from tasks where listId = :listId order by $sanitisedSort $sanitisedOrder");
        $statement->bindValue(':listId', $listId);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    // get a task based on the id
    public static function getTaskById($id)
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("select * from tasks where id = :id");
        $statement->bindValue(":id", $id);
        $statement->execute();
        $taskArray = $statement->fetch(PDO::FETCH_ASSOC);

        $task = new self();
        $task->setUserId($taskArray['userId']);
        $task->setListId($taskArray["listId"]);
        $task->setId($taskArray["id"]);
        $task->setTitle($taskArray["title"]);
        $task->setDate($taskArray["date"]);
        $task->setHour($taskArray["hour"]);
        $task->setDone($taskArray["done"]);
        $task->setAttachment($taskArray["attachment"]);
        return $task;
    }

    // get a task based on the task id
    public static function getTaskArrayById($id)
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("select * from tasks where id = :id");
        $statement->bindValue(":id", $id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    //count days until deadline
    public static function getDaysRemaining($deadline){
        $date1 = new DateTime($deadline);
        $interval = $date1->diff(new DateTime());

        return $interval->days;
    }

    //deadline is in the past
    public static function getIsPast($deadline){
        $date1 = new DateTime($deadline);
        return $date1 < new DateTime();
    }

    public static function updateDateForId($id, $date){
        $conn = Db::getInstance();
        $statement = $conn->prepare("UPDATE tasks SET date = :date WHERE id = :id");
        $statement->bindValue(":date", $date);
        $statement->bindValue(':id', $id);
        $result = $statement->execute();
        return $result;
    }

    // delete task
    public static function deleteTask($taskId)
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("delete from tasks where id = :taskId");
        $statement->bindValue(":taskId", $taskId);
        $statement->execute();
    }

    // delete attachment
    public static function deleteAttachment($taskId){
        $conn = Db::getInstance();
        $statement = $conn->prepare("update tasks set attachment = null where id = :taskId");
        $statement->bindValue(":taskId", $taskId);
        $statement->execute();
    }

    // delete date
    public static function setDateToNull($taskId){
        $conn = Db::getInstance();
        $statement = $conn->prepare("update tasks set date = null where id = :taskId");
        $statement->bindValue(":taskId", $taskId);
        $statement->execute();
    }

    // bron: https://phpdelusions.net/pdo/whitelisting_helper_function to filter data
    // dit wordt gebruikt om alleen toegestane waarden toe te staan
    private static function whiteList($input, $allowed)
    { //indien er geen input is, gebruiken we de eerste waarde van de toegestane waarden als default waarde
        if ($input === null) {
            return $allowed[0];
        }
        // er wordt gecontroleerd of de waarde van de input wel in de toegestane waarden zit
        $key = array_search($input, $allowed, true);
        if ($key === false) {
            // indien niet, dan wordt de eerste waarde van de toegestane waarden als default waarde gebruikt
            return $allowed[0];
        } else {
            // zo ja, dan wordt de input toegestaan
            return $input;
        }
    }
}