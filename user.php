<?php
class user{
  private $username, $email, $password;
  public function __construct($username){
    $this -> username = $username;
    include('database_login.php');
    $connection = mysqli_connect($_server, $_username, $_password) or die("Could not connect to database");
    $db = mysqli_select_db($connection, $_db) or die("Could not connect to database");
    $sql = "SELECT * from user_data where username = '$username'";
    $query = mysqli_query($connection, $sql);
    $row = mysqli_fetch_array($query);
    $this -> email = $row['email'];
    $this -> password = $row['pass'];
  }
  public function getUsername(){
    return $this -> username;
  }
  public function getEmail(){
    return $this -> email;
  }
  public function getPassword(){
    return $this -> password;
  }

  public function setEmail($email){
    $this -> email = $email;
  }
  public function setPassword($password){
    $this -> password = md5($password);
  }
  public function isUserNameExist(){
    $usr = $this -> getUsername();
    include('database_login.php');
    $connection = mysqli_connect($_server, $_username, $_password) or die("Could not connect to database");
    $db = mysqli_select_db($connection, $_db) or die("Could not connect to database");
    $sql = "SELECT * from user_data where username = '$usr'";
    $query = mysqli_query($connection, $sql);
    if(mysqli_num_rows($query)){
      return true;
    }
    else{
      return false;
    }
  }
  public function insert(){
    $usr = $this -> getUsername();
    $em = $this -> getEmail();
    $pass = $this -> getPassword();
    include('database_login.php');
    $connection = mysqli_connect($_server, $_username, $_password) or die("Could not connect to database");
    $db = mysqli_select_db($connection, $_db) or die("Could not connect to database");
    $sql = "INSERT into user_data VALUES('$usr', '$em', '$pass')";
    $query = mysqli_query($connection, $sql);
  }
}
 ?>
