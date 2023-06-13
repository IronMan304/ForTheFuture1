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

//insert a query to the database
// $query = mysqli_query($connect, "INSERT INTO register VALUES(NULL, 'jERE')");

//Declaring variables to prevent errors
$firstname = "";
$lastname;
$email;
$confirm_email;
$password;
$confirm_password;  
$signup_date;
$error_array; //will hold any error messages i will get

if(isset($_POST['register_button'])){ //the button from the form - THE INPUTTED VALUes from the firm will be inserted inside the variables.

    $firstname = strip_tags($_POST['register_firstname']);
    $firstname = str_replace(' ', '', $firstname);
    $firstname = ucfirst(strtolower($firstname));

    $lastname = strip_tags($_POST['register_lastname']);
    $lastname = str_replace(' ', '', $lastname);
    $lastname = ucfirst(strtolower($lastname));

    $email = strip_tags($_POST['register_email']);
    $email = str_replace(' ', '', $email);
    $email = ucfirst(strtolower($email));

    $confirm_email = strip_tags($_POST['register_confirm_email']);
    $confirm_email = str_replace(' ', '', $confirm_email);
    $confirm_email = ucfirst(strtolower($confirm_email));

    $password = strip_tags($_POST['register_password']);
    $password = str_replace(' ', '', $password);
    $password = ucfirst(strtolower($password));

    $confirm_password = strip_tags($_POST['register_confirm_password']);
    $confirm_password = str_replace(' ', '', $confirm_password);
    $confirm_password = ucfirst(strtolower($confirm_password)); //The final value from the form goes in here

    $date = date("y-m-d");

    //Authentication

    if($email == $confirm_email){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){ 
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        }ELSE{
            ECHO "iNVALID FORMAT";
        }

    }else{
        echo "email dont match";
    }
}

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
    
 <form action="register.php" method="POST"> <!-- Means The data will be send in the register php -->
    <input type="text" name="register_firstname" placeholder="First Name">
    <br>
    <input type="text" name="register_lastname" placeholder="Last Name">
    <br>
    <input type="email" name="register_email" placeholder="Email">
    <br>
    <input type="email" name="register_confirm_email" placeholder="Confirm Email">
    <br>
    <input type="text" name="register_password" placeholder="Password">
    <br>
    <input type="text" name="register_confirm_password" placeholder="Confirm Password">
    <br>
    <input type="submit" name="register_button" value="Register"> <!--This bitton is conected to the method post and action -->
</form>

</body>
</html>