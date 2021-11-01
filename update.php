<?php
require_once('Employee.php');
$data = Employee::getEmp($_GET['id']);
session_start();
if (isset($_POST['update'])) {
    if (!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['name']) && !empty($_POST['age']) && !empty($_POST['city']) && (!empty($_FILES['image']['tmp_name']) || !empty($_POST['image2']))) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $name = $_POST['name'];
        $age = $_POST['age'];
        $city = $_POST['city'];
        $image = $_FILES['image'];
        $id = $_POST['id'];

        $emp = new Employee();
        $emp->id = $id;
        $emp->username = $username;
        $emp->email = $email;
        $emp->name = $name;
        $emp->age = $age;
        $emp->city = $city;
        if (!empty($_FILES['image']['tmp_name'])) {
            $emp->image = $emp->addImage($image);
        } else {
            $emp->image = $_POST['image2'];
        }
        $emp->update();
        $_SESSION['sccs'] = "Employee updated !";
    } else {
        $_SESSION['err'] = "All fields are required !";
    }
}
?>




<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>OOPS CRUD</title>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 card p-0">
                <div class="card-header">
                    <h2>TO do list</h2>
                </div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                        <div class="form-group">
                            <label for="">username</label>
                            <input type="text" class="form-control" id="item" name="username" value="<?php echo $data['username']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" id="" class="form-control" value="<?php echo $data['email']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control" name="name" value="<?php echo $data['name']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Age</label>
                            <input type="number" class="form-control" name="age" value="<?php echo $data['age']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="">City</label>
                            <input type="text" class="form-control" name="city" value="<?php echo $data['city']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Image</label>
                            <img src="<?php echo $data['image']; ?>" alt="" class="img-fluid" width="100px">
                            <input type="file" name="image" id="" class="form-control">
                            <input type="hidden" name="image2" value="<?php echo $data['image']; ?>">
                        </div>
                        <div class="form-group p-2">
                            <button type="submit" class="btn btn-dark form-control" id="add" name="update">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>