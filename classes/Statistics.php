<?php
    include_once(__DIR__ . "/Db.php");

    class Statistics{
        public static function getNumberOfUsers(){
            $conn = Db::getInstance();
            $statement = $conn->prepare("select count(*) from users"); //admin is ook een user
            $statement->execute();
            return $statement->fetchColumn();
        }

        public static function getNumberOfLists(){
            $conn = Db::getInstance();
            $statement = $conn->prepare("select count(*) from todo_lists");
            $statement->execute();
            return $statement->fetchColumn();
        }

        public static function getAverageNumberOfListsPerUser(){
           return self::getNumberOfLists() / self::getNumberOfUsers();
        }
        
        public static function getSumOfHoursOfOpenTasks(){
            $conn = Db::getInstance();
            $statement = $conn->prepare("select sum(hour) from tasks where done = 0");
            $statement->execute();
            return $statement->fetchColumn();
        }

        public static function getAverageSumOfOpenTaskHoursPerUser(){
            return self::getSumOfHoursOfOpenTasks() / self::getNumberOfUsers();
         }
}
