<?php
include_once(__DIR__ . "/Db.php");

class Task
{
    private $id;
    private $userId;
    private $lijstId;
    private $title;
    private $hour;
    private $date;
    private $done;

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
    public function setLijstId($lijstId)
    {
        $this->lijstId = $lijstId;
    }

    public function getLijstId()
    {
        return $this->lijstId;
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

    // add a task to database
    public function add()
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("insert into task (userId, title, lijstId, hour, date) values (:userId, :title, :lijstId, :hour, :date)");
        $statement->bindValue(":userId", $this->userId);
        $statement->bindValue(":title", $this->title);
        $statement->bindValue(":lijstId", $this->lijstId);
        $statement->bindValue(":hour", $this->hour);
        $statement->bindValue(":date", $this->date);
        $statement->execute();
    }

    // update to get the to-do to done or not done
    public function update()
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("UPDATE task SET userId = :userId, title = :title, lijstId = :lijstId, hour = :hour, date = :date, done = :done WHERE id = :id");

        $userId = $this->getUserId();
        $id = $this->getId();
        $title = $this->getTitle();
        $lijstId = $this->getLijstId();
        $hour = $this->getHour();
        $date = $this->getDate();
        $done = $this->getDone();

        $statement->bindValue(':userId', $userId);
        $statement->bindValue(':id', $id);
        $statement->bindValue(":title", $title);
        $statement->bindValue(":lijstId", $lijstId);
        $statement->bindValue(":hour", $hour);
        $statement->bindValue(":date", $date);
        $statement->bindValue(":done", $done);

        $statement->execute();
    }

    // get all task information
    public static function getAllForId($lijstId, $sort, $order)
    {
        $sort = self::white_list($sort, ["date", "hour"]);
        $order = self::white_list(strtolower($order), ["asc", "desc"]);
        $conn = Db::getInstance();
        $statement = $conn->prepare("select * from task where lijstId = :lijstId order by $sort $order");
        $statement->bindValue(':lijstId', $lijstId);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    // get a task based on the topic id
    public static function getTaskById($id)
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("select * from task where id = :id");
        $statement->bindValue(":id", $id);
        $statement->execute();
        $taskArray = $statement->fetch(PDO::FETCH_ASSOC);

        $task = new self();
        $task->setUserId($taskArray['userId']);
        $task->setLijstId($taskArray["lijstId"]);
        $task->setId($taskArray["id"]);
        $task->setTitle($taskArray["title"]);
        $task->setDate($taskArray["date"]);
        $task->setHour($taskArray["hour"]);
        $task->setDone($taskArray["done"]);
        return $task;
    }

    // get a task based on the topic id
    public static function getTaskArrayById($id)
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("select * from task where id = :id");
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

    // delete user task (future)
    public static function deleteTask($taskId)
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("delete from task where id = :taskId");
        $statement->bindValue(":taskId", $taskId);
        $statement->execute();
    }

    // bron: https://phpdelusions.net/pdo/whitelisting_helper_function to filter data
    private static function white_list($value, $allowed)
    {
        if ($value === null) {
            return $allowed[0];
        }
        $key = array_search($value, $allowed, true);
        if ($key === false) {
            return $allowed[0];
        } else {
            return $value;
        }
    }
}