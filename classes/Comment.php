<?php
    include_once(__DIR__ . "/Db.php");

    class Comment {
        private $commentId;
        private $text;
        private $taskId;
        private $userId;

        // id
        public function getCommentId() {
            return $this->commentId;
        }

        public function setCommentId($commentId) {
            $this->commentId = $commentId;
            return $this;
        }

        // text
        public function getText() {
            return $this->text;
        }

        public function setText($text) {
            $this->text = $text;
            return $this;
        }

        // topicId
        public function getTaskId() {
            return $this->taskId;
        }

        public function setTaskId($taskId) {
            $this->taskId = $taskId;
            return $this;
        }

        // userId
        public function getUserId() {
            return $this->userId;
        }

        public function setUserId($userId) {
            $this->userId = $userId;
            return $this;
        }

        // add a comment to database
        public function save() {
            $conn = Db::getInstance();
            $statement = $conn->prepare("insert into comment (text, userId, taskId) values (:text, :userId, :taskId)");

            $text = $this->getText();
            $userId = $this->getUserId();
            $taskId = $this->getTaskId();

            $statement->bindValue(':text', $text);
            $statement->bindValue(':userId', $userId);
            $statement->bindValue(':taskId', $taskId);

            $statement->execute();
            return $conn->lastInsertId();
        }

        // get all comment information
        public static function getAll($taskId) {
            $conn = Db::getInstance();
            $statement = $conn->prepare("select * from comment where taskId = :taskId");
            $statement->bindValue(':taskId', $taskId);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        // count comments
        public static function countComments($taskId) {
            $conn = DB::getInstance();
            $query = $conn->prepare("select count(id) from comment where topicId = :topicId");
            $query->bindValue(":topicId", $taskId);
            $query->execute();
            $comments = intval($query->fetchColumn());
            return($comments);
        }
    }