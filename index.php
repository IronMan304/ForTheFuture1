<?php
//mysqli_connect(4PARAMETERS)
//mysqli_connect_errno()
//mysqli_query(2PARAMETERS)


//INSERT INTO
//VALUES
$connect = mysqli_connect("localhost", "root", "", "social");

if(mysqli_connect_errno()){
    echo "Failed to connect; " . mysqli_connect_errno();
}

$query = mysqli_query($connect, "INSERT INTO test VALUES('','Jerecho')");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Socmed</title>
</head>
<body>
    <h1> Hello name</h1>
</body>
</html>