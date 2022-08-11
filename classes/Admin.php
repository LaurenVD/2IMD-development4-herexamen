<?php
    include_once(__DIR__ . "/Db.php");

    class Admin extends User{
        private $isAdmin;
        
        public function getIsAdmin() {
            return $this->isAdmin;
        }

        public function save(){
            $conn = DB::getInstance();
            $statement = $conn->prepare("insert into users (is_admin) values (1)");
            return $statement->execute();
        }

        public static function getAll(){
            $conn = DB::getInstance();
            $statement = $conn->prepare("select * from users where is_admin = 1");
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function isAdmin($userId){
            $userArray = self::getUserById($userId);
            return $userArray["is_admin"] === "1";
        }

        public function store() {
            $conn = Db::getInstance();
            $statement = $conn->prepare("insert into users (username, password, is_admin) values (:username, :password, 1)");
            $statement->bindValue(":username", $this->username);
            $statement->bindValue(":password", $this->password);
            $result = $statement->execute();
            return $result;
        }

        public function delete()
        {
            $conn = Db::getInstance();
            $statement = $conn->prepare("delete from users where id = :id");
            $statement->bindValue(":id", $this->userId);
            $statement->execute();
        }
}
