<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "first_data";

$conn = mysqli_connect($host, $user, $pass, $dbname);

/////////////////insert
if (isset($_POST['senddata'])) {
    $n = $_POST['name'];
    $a = $_POST['address'];
    $query = "INSERT INTO customers (name, address) VALUES ('$n','$a')";
    mysqli_query($conn, $query);
    header('location: ./index.php');
}
/////////////////read
$query1 = "SELECT * FROM customers";
$data = mysqli_query($conn, $query1);

//////////////delete
if (isset($_GET['del'])) {
    $id = $_GET['del'];
    $query2 = "DELETE FROM customers WHERE id = $id";
    mysqli_query($conn, $query2);
    header('location: ./index.php');
}
///////////// update

if (isset($_GET['up'])) {
    $id = $_GET['up'];
    $query3 = "SELECT * FROM customers WHERE id = $id";
    $data2 = mysqli_query($conn, $query3);
    $mydata = mysqli_fetch_assoc($data2);

    if (isset($_POST['updatedata'])) {
        $n = $_POST['name'];
        $a = $_POST['address'];
        $query4 = "UPDATE customers SET name='$n', address = '$a'  WHERE id = $id";
        mysqli_query($conn, $query4);
        header('location: ./index.php');
    }
}
?>

<!--                             start my page                                   -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>first data</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="container">
<!--                             the main form                                   -->

        <form method="post" class="mt-4">
            <div class="m-3">
                <div class="form-group">
                    <label>name :-</label>
                    <input value="<?php if (isset($mydata['name'])) {
                                        echo $mydata['name'];
                                    }  ?>" type="text" class="form-control" name="name" placeholder="name">
                </div>
                <div class="form-group">
                    <label>address :-</label>
                    <input value="<?php if (isset($mydata['address'])) {
                                        echo $mydata['address'];
                                    }  ?>" type="text" class="form-control" name="address" placeholder="address">
                </div>
                <?php
                if (isset($_GET['up'])) { ?>
                    <button type="submit" class="btn btn-outline-info btn-block" name="updatedata">update</button>

                <?php } else { ?>
                    <button type="submit" class="btn btn-outline-success btn-block" name="senddata">add</button>
                <?php }
                ?>


            </div>
        </form>

<!--                             the table                                   -->

        <table class="table table-bordered mt-5 table-dark table-striped">
            <thead class="text-center">
                <th>id</th>
                <th>name</th>
                <th>address</th>
                <th>time</th>
                <th colspan="2">action</th>
            </thead>
            <tbody>
                <?php foreach ($data as $datarow) { ?>
                    <tr>
                        <td><?php echo $datarow['id'] ?></td>
                        <td><?php echo $datarow['name'] ?></td>
                        <td><?php echo $datarow['address'] ?></td>
                        <td><?php echo $datarow['date'] ?></td>
                        <td><a name="delete" href="./index.php?del=<?php echo $datarow['id'] ?>" class="btn btn-outline-danger">delete</a></td>
                        <td><a name="update" href="./index.php?up=<?php echo $datarow['id'] ?>" class="btn btn-outline-info">update</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
</body>

</html>