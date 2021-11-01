<?php
require_once('Employee.php');
$data = Employee::getAllEmp();

session_start();
if (isset($_POST['add'])) {
    if (!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['name']) && !empty($_POST['age']) && !empty($_POST['city']) && !empty($_FILES['image']['tmp_name'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $name = $_POST['name'];
        $age = $_POST['age'];
        $city = $_POST['city'];
        $image = $_FILES['image'];

        $emp = new Employee();
        $emp->username = $username;
        $emp->email = $email;
        $emp->name = $name;
        $emp->age = $age;
        $emp->city = $city;
        $emp->image = $emp->addImage($image);
        $emp->save();
        $_SESSION['sccs'] = "Employee added !";
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
        <?php
        if (isset($_SESSION['err'])) {
            echo "<div class='row'>
                <div class='col-12 alert alert-danger'>" . $_SESSION['err'] . "</div>
            </div>";
            unset($_SESSION['err']);
        }
        if (isset($_SESSION['sccs'])) {
            echo "<div class='row'>
            <div class='col-12 alert alert-success'>" . $_SESSION['sccs'] . "</div>
            </div>";
            unset($_SESSION['sccs']);
        }
        ?>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 card p-0">
                <div class="card-header">
                    <h2>Add employee</h2>
                </div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="">username</label>
                            <input type="text" class="form-control" id="item" name="username" value="">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" id="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control" name="name" value="">
                        </div>
                        <div class="form-group">
                            <label for="">Age</label>
                            <input type="number" class="form-control" name="age" value="">
                        </div>

                        <div class="form-group">
                            <label for="">City</label>
                            <input type="text" class="form-control" name="city" value="">
                        </div>
                        <div class="form-group">
                            <label for="">Image</label>
                            <input type="file" name="image" id="" class="form-control">
                        </div>
                        <div class="form-group p-2">
                            <button type="submit" class="btn btn-dark form-control" id="add" name="add">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8 p-2">
                <div class="row bg-light p-1 " style="font-weight: bold;">
                    <div class="col">Sr</div>
                    <div class="col">username</div>
                    <div class="col">email</div>
                    <div class="col">name</div>
                    <div class="col">age</div>
                    <div class="col">city</div>
                    <div class="col">image</div>
                    <div class="col">Action</div>
                </div>
            </div>
        </div>

        <div class="container" id="listDiv">
            <?php
            $count = 1;
            if ($data != null) {
                foreach ($data as $list) {
                    $username = $list['username'];
                    $email = $list['email'];
                    $age = $list['age'];
                    $name = $list['name'];
                    $age = $list['age'];
                    $city = $list['city'];
                    $image = $list['image'];
                    $id = $list['id'];
                    echo "
                        <div class='row'>
                        <div class='col-12 p-2'>
                            <div class='row  p-1 '>
                                <div class='col'>$count</div>
                                <div class='col'>$username</div>
                                <div class='col'>$email</div>
                                <div class='col'>$name</div>
                                <div class='col'>$age</div>
                                <div class='col'>$city</div>
                                <div class='col'><img class='img-fluid' src='$image'></div>
                                <div class='col'>
                                    <a href='update.php?id=$id' class='btn btn-primary'>Update</a>
                                    <a href='delete.php?id=$id' class='delete btn btn-danger'  data-id='$id' >Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                        ";
                    $count++;
                }
            } else {
                echo "
                        <div class='row'>
                        <div class='col-md-2'></div>
                        <div class='col-md-8 p-2'>
                            <div class='row  p-1 '>
                                <div class='col-12 text-center text-secondary'>NO DATA FOUND</div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                        ";
            }
            ?>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="./jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.alert-danger').fadeOut(3000,function(){
                window.history.back();
            });
            $('.alert-success').fadeOut(3000,function(){
                window.location.href = "http://localhost/training/oops/assignment/assign2/index.php";
            });
        })
    </script>
</body>

</html>