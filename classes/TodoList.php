<?php
    include_once(__DIR__ . "/Db.php");

    class TodoList {
        private $id;
        private $userId;
        private $title;
        private $description;

        // id
        public function getId() {
            return $this->id;
        }

        // user id
        public function setUserId($userId) {
            $this->userId = $userId;
        }

        public function getUserId() {
            return $this->userId;
        }

        // title
        public function setTitle($title) {
            self::checkTitle($title);
            $this->title = $title;
        }

        public function getTitle() {
            return $this->title;
        }

        // title can't be empty
        public function checkTitle($title) {
            if(empty($title)) {
                throw new Exception("Insert a title.");
            }
        }

        // description
        public function setDescription($description) {
            self::checkDescription($description);
            $this->description = $description;
        }

        public function getDescription() {
            return $this->description;
        }

        // description can't be empty
        public function checkDescription($description) {
            if(empty($description)) {
                throw new Exception("Insert a description.");
            }
        }
        
        // add a list to database
        public function add() {
            $conn = Db::getInstance();
            $statement = $conn->prepare("insert into todo_lists (userId, title, description) values (:userId, :title, :description)");
            $statement->bindValue(":userId", $this->userId);
            $statement->bindValue(":title", $this->title);
            $statement->bindValue(":description", $this->description);
            $statement->execute();
        }

        // get all todo lists information
        public static function getAll() {
            $conn = Db::getInstance();
            $statement = $conn->prepare("select * from todo_lists");
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function getAllForUser($userId) {
            $conn = Db::getInstance();
            $statement = $conn->prepare("select * from todo_lists where userId = :userId");
            $statement->bindValue(":userId", $userId);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        // get a list based on the id
        public static function getListArrayById($id) {
            $conn = Db::getInstance();
            $statement = $conn->prepare("select * from todo_lists where id = :id");
            $statement->bindValue(":id", $id);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        }

        public static function isThereATaskWithTitleInList($title, $listId) {
            $conn = Db::getInstance();
            $statement = $conn->prepare("select count(*) from tasks where title = :title and listId = :listId");
            $statement->bindValue(":title", $title);
            $statement->bindValue(":listId", $listId);
            $statement->execute();
            return (int) $statement->fetchColumn() > 0;
        }

        // delete a list
        public static function deleteList($listId) {
            $conn = Db::getInstance();
            $statement = $conn->prepare("delete from todo_lists where id = :listId");
            $statement->bindValue(":listId", $listId);
            $statement->execute();
        }
    }