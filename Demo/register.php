<?php
//mysqli_connect(4PARAMETERS) the host, username for the databse, dbPassword, name of db
//mysqli_connect_errno()
//mysqli_query(2PARAMETERS)


//INSERT INTO means insert into test table 
//VALUES means values of each column, the values are in order

$connect = mysqli_connect("localhost", "root", "", "social"); 


//This statements means if it return an error then it will print the string and the error number
if(mysqli_connect_errno()){
    echo "Failed to connect; " . mysqli_connect_errno();
}//End 

//Declaring variables to prevent errors


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to NORSOCMED</title>
</head>
<body>
    
<form action="register.php" method="POST">
    <input type="text" name="reg_fname" placeholder="First Name">
    <br>
    <input type="text" name="reg_lname" placeholder="Last Name">
    <br>
    <input type="email" name="reg_email" placeholder="Email">
    <br>
    <input type="text" name="reg_password" placeholder="Password">
    <br>
    <input type="text" name="reg_password2" placeholder="Confirm Password">
    <br>
    <input type="submit" name="reg_button" value="Register">
</form>

</body>
</html>