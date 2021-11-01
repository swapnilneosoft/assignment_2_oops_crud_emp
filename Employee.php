<?php

include 'DB.php';

class Employee extends DB
{
    public $id;
    public $username;
    public $email;
    public $name;
    public $age;
    public $city;
    public $image;


    public static function getAllEmp()
    {
        return DB::select("SELECT * FROM emp");
    }

    public static function getEmp($id)
    {
        return DB::selectOne("SELECT * FROM emp WHERE id= $id");
    }

    public function addImage($image)
    {
        $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
        $dest = "upload/attatch-" . time() . rand(9999, 999999) . ".$ext";
        $path = null;
        if (move_uploaded_file($image['tmp_name'], $dest)) {
            $path = "/training/oops/assignment/assign2/$dest";
        } else {
            $path = "";
        }
        return $path;
    }
    public function save()
    {
        return DB::query("INSERT INTO emp(`username`,`email`,`name`,`age`,`city`,`image`) VALUES('$this->username','$this->email','$this->name','$this->age','$this->city','$this->image')");
    }
    public function remove($id)
    {

        $res = DB::query("DELETE FROM emp WHERE id=$id");
        if ($res) {
            header("location: index.php");
        } else {
            echo "Data not deleted";
            header("location: index.php");
        }
    }

    public function update()
    {
         DB::query("UPDATE emp SET username='$this->username',`email`='$this->email' , `name`='$this->name' , `age`='$this->age' , `city`='$this->city' , `image`='$this->image' WHERE id=$this->id");
         header("location: index.php");
    }
}
