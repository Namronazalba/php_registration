<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array(); 
$error1 = array(); 
$error2 = array(); 
$error3 = array(); 
$error4 = array(); 
// connect to the database
require_once("database.php");

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password_1 = mysqli_real_escape_string($conn, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($conn, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { 
    array_push($error1, "Username is required"); 
  }else{
          if (empty($email)) { 
            array_push($error2, "Email is required"); 
          } else {
                if (! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                  array_push($error2, "Enter valid email");
                } else {
                      if (empty($password_1)) { 
                        array_push($error3, "Password is required"); 
                          } else {
                                if ( ! preg_match("/[a-z]/i", $_POST["password_1"])) {
                                  array_push($error3, "Password must contain at least one letter");
                                } else {
                                      if ( ! preg_match("/[0-9]/", $_POST["password_1"])) {
                                        array_push($error3, "Password must contain at least one number");
                                      } else {
                                            if (empty($_POST["password_2"])) {
                                              array_push($error4, "Password confirmation is required");
                                            } else {
                                                  if ($password_1 != $password_2) {
                                                    array_push($error4, "Password don't match");
                                                    }
                                                }
                                          }
                                    }
                            }      
                    }
              }
        }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM user WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($conn, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }
  // Merge all possible errors
  $check_error = array_merge($errors, $error1,$error2,$error3,$error4);
  // Finally, register user if there are no errors in the form
  if (count($check_error) == 0) {
		$username = $_POST['username'];
		$email 	= $_POST['email'];
		$password = $_POST['password_1'];
    //encrypt the password before saving in the database
    $options = array("cost"=>4);
		$hashPassword = password_hash($password_1,PASSWORD_BCRYPT,$options);
    		
		$sql = "insert into user (username, email, password) value( '".$username."', '".$email."','".$hashPassword."')";
		$result = mysqli_query($conn, $sql);
    if($result) {
      $_SESSION['success'] = "Registration successfully";
      header('location: index.php');
		}
  }
}



// LOGIN USER

    
    if(isset($_POST['login_user'])){
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $password = mysqli_real_escape_string($conn, $_POST['password']);

      if (empty($email)) {
        array_push($error2, "Email is required");
      } else{
            if (empty($password)) {
              array_push($error3, "Password is required");
            }else{
              $sql = "select * from user where email = '".$email."'";
              $user_email = mysqli_query($conn,$sql);
              $numRows = mysqli_num_rows($user_email);
              
              if($numRows  == 1){
                $row = mysqli_fetch_assoc($user_email);
                if(password_verify($password,$row['password'])){
                  $_SESSION['email'] = $email;
                  $_SESSION['success'] = "You are now logged in";
                  header('location: index.php');
                }else {
                    array_push($errors, "Email or password is incorrect");
                }
              }else {
                if($numRows  == 0){
                  array_push($errors, "No User found");
                }
                
              }
            }
          }
      }       
     
  ?>