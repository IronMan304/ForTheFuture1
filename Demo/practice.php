<?php
//mysqli_connect(4PARAMETERS) the host, username for the databse, dbPassword, name of db
//mysqli_connect_errno()
//mysqli_query(2PARAMETERS)


//INSERT INTO means insert into test table 
//VALUES means values of each column, the values are in order

$connect = mysqli_connect("localhost", "root", "", "social.test"); 


//This statements means if it return an error then it will print the string and the error number
if(mysqli_connect_errno()){
    echo "Failed to connect; " . mysqli_connect_errno();
}//End 

//This statement calls the variable connect since it represents the database. 
$query = mysqli_query($connect, "INSERT INTO test VALUES('','Jerecho')"); //id parameter is blank since it is already an auto incremented means it will automatically get a value once executed
//Tip: If empty single quotes doesnt work then use NULL
//End 

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
