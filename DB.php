<?php
    class DB{

        public static $conn;

        public static function dbconn()
        {
            self::$conn = new PDO("mysql:host=localhost;dbname=oops_crud_emp","root","") or die("not connected");
        }

        public static function select($q)
        {
            self::dbconn();
            $query = self::$conn->query($q);
            return $query->fetchAll();
        }
        public static function selectOne($q)
        {            
            self::dbconn();
            $query = self::$conn->query($q);
            return $query->fetchAll()[0];
        }
        public static function query($q)
        {            
            self::dbconn();
            $query = self::$conn->query($q);
            return true;
        }


    }
