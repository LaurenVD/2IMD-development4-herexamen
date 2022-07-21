<?php
    include_once(__DIR__ . "/Db.php");

    class Lijst {
        private $lijstId;
        private $userId;
        private $title;
        private $description;

        // lijst id
        public function setLijstId($lijstId) {
            $this->lijstId = $lijstId;
        }

        public function getLijstId() {
            return $this->lijstId;
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
                throw new Exception("Voer een geldige titel in.");
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
                throw new Exception("Voer een geldige omschrijving in.");
            }
        }
        
        // add a list to database
        public function add() {
            $conn = Db::getInstance();
            $statement = $conn->prepare("insert into lijst (userId, title, description) values (:userId, :title, :description)");
            $statement->bindValue(":userId", $this->userId);
            $statement->bindValue(":title", $this->title);
            $statement->bindValue(":description", $this->description);
            $statement->execute();
        }

        // get all lists information
        public static function getAll() {
            $conn = Db::getInstance();
            $statement = $conn->prepare("select * from lijst");
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        // get a list based on the topic id
        public static function getLijstById($id) {
            $conn = Db::getInstance();
            $statement = $conn->prepare("select * from lijst where id = :id");
            $statement->bindValue(":id", $id);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        }

        // delete a list
        public static function deleteLijst($lijstId) {
            $conn = Db::getInstance();
            $statement = $conn->prepare("delete from lijst where id = :lijstId");
            $statement->bindValue(":lijstId", $lijstId);
            $statement->execute();
        }

    }