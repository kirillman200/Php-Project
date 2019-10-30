<?php ob_start(); 

$user_id = $_GET['user_id'];

//connect

require_once('includes/db.php'); 

// set up sql query 

$sql = "DELETE FROM proj1 WHERE user_id = :user_id";

//prepare 

$cmd = $conn->prepare($sql); 

//bind 

$cmd->bindParam(':user_id', $user_id, PDO::PARAM_INT);

//execute 

$cmd->execute(); 

// close the connection 

$conn = NULL; 

header('location:data.php'); 


ob_flush(); 

?>