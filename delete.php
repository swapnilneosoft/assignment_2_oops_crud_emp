<?php
include("Employee.php");

    if(!empty($_GET['id']) && isset($_GET['id']))
    {
        $id = $_GET['id'];
        $emp = new Employee;
        $emp->remove($id);
    }

?>