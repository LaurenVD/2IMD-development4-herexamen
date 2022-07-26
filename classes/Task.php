<?php
    include_once(__DIR__ . "/Db.php");

    class Task {
        private $taskId;
        private $userId;
        private $lijstId;
        private $title;
        private $hour;
        private $date;

        // task id
        public function setTaskId($taskId) {
            $this->taskId = $taskId;
        }

        public function getTaskId() {
            return $this->taskId;
        }

        // user id
        public function setUserId($userId) {
            $this->userId = $userId;
        }

        public function getUserId() {
            return $this->userId;
        }
         
        // user id
         public function setLijstId($lijstId) {
            $this->lijstId = $lijstId;
        }

        public function getLijstId() {
            return $this->lijstId;
        }

        // title
        public function setTitle($title) {
            self::checkTitle($title);
            $this->title = $title;
        }

        public function getTitle() {
            return $this->title;
        }

        // title check
        public function checkTitle($title) {
            if(empty($title)) {
                throw new Exception("Voer een geldige titel in.");
            }
        }

        // description
        public function setHour($hour) {
            $this->hour = $hour;
        }

        public function getHour() {
            return $this->hour;
        }

        
        // date
        public function setDate($date) {
            $date = new DateTime();
            $this->date = $date->format('Y-m-d');
        }

        public function getDate() {
            return $this->date;
        }

        // add a task to database
        public function add() {
            $conn = Db::getInstance();
            $statement = $conn->prepare("insert into task (userId, title, hour, date) values (:userId, :title, :hour, :date)");
            $statement->bindValue(":userId", $this->userId);
            $statement->bindValue(":title", $this->title);
            $statement->bindValue(":hour", $this->hour);
            $statement->bindValue(":date", $this->date);
            $statement->execute();
        }

        // get all task information
        public static function getAll() {
            $conn = Db::getInstance();
            $statement = $conn->prepare("select * from task");
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        // get a task based on the topic id
        public static function getTaskById($id) {
            $conn = Db::getInstance();
            $statement = $conn->prepare("select * from task where id = :id");
            $statement->bindValue(":id", $id);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        }

        // delete user task (future)
        public static function deleteTask($taskId) {
            $conn = Db::getInstance();
            $statement = $conn->prepare("delete from task where id = :topicId");
            $statement->bindValue(":topicId", $taskId);
            $statement->execute();
        }
    }