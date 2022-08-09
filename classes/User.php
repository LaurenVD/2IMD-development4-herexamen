<?php
    include_once(__DIR__ . "/Db.php");

    class User {
        protected $userId;
        protected $username;
        protected $password;

        // id
        public function setUserId($userId) {
            $this->userId = $userId;
        }

        public function getUserId() {
            return $this->userId;
        }

        // username
        public function setUsername($username) {
            self::checkUsername($username);
            $this->username = $username;
        }

        public function getUsername() {
            return $this->username;
        }

        // check if username is filled in
        public function checkUsername($username) {
            if($username === "") {
                throw new Exception("Voer een geldige username in.");
            }
        }

        // password
        public function setPassword($password) {
            self::checkPassword($password);

            $options = [
                'cost' => 12,
            ];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT, $options);

            $this->password = $password;
        }

        public function getPassword() {
            return $this->password;
        }

        // check if password is filled in
        private function checkPassword($password){
            if($password === "") {
                throw new Exception("Voer een geldig wachtwoord in.");
            }

            if(strpos($password, " ")) {
                throw new Exception("Het wachtwoord mag geen spaties bevatten.");
            }

            if(strlen($password) <= 5) {
                throw new Exception("Stel een minimale wachtwoordlengte in van 6 tekens.");
            }
        }

        // signup
        public function signup() {
            $conn = Db::getInstance();
            $statement = $conn->prepare("insert into users (username, password) values (:username, :password)");
            $statement->bindValue(":username", $this->username);
            $statement->bindValue(":password", $this->password);
            $result = $statement->execute();
            return $result;
        }

        // login
        public static function login($username, $password) {
            $conn = Db::getInstance();
            $statement = $conn->prepare("select * from users where username = :username");
            $statement->bindValue(":username", $username);
            $statement->execute();
            $user = $statement->fetch();
            $hash = $user['password'];

            if(!$user) {
                return false;
            }
            
            if(password_verify($password, $hash)) {
                return true;
            } 
            else {
                return false;
            }
        }

        // get the user id based on the username
        public static function getUserIdByUsername($username) {
            $conn = Db::getInstance();
            $statement = $conn->prepare("select id from users where username = :username");
            $statement->bindValue(":username", $username);
            $statement->execute();
            $result = $statement->fetch();
            return $result['id'];
            }

            // get a user by id
        public static function getUserById($id) {
            $conn = Db::getInstance();
            $statement = $conn->prepare("select * from users where id = :userId");
            $statement->bindValue(':userId', $id);
            $statement->execute();
            return $statement->fetch();
        }

        public function delete()
        {
            $conn = Db::getInstance();
            $statement = $conn->prepare("delete from users where id = :id");
            $statement->bindValue(":id", $this->userId);
            $statement->execute();
        }
    }