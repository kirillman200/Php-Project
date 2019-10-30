<?php require('includes/header.php'); ?>

<a href="index.php" class="new-user"> Add new user</a>

<?php

ob_start();

try {
  
  //connect to database 
  
  require('includes/db.php'); 
  
  // set up our sql query
  
  $sql = "SELECT * FROM proj1;"; 
  
  //prepare 
  
  $cmd= $conn->prepare($sql);
  
  // execute 
  
  $cmd->execute(); 
  
  //use fetchAll to store our results 
  
  $data = $cmd->fetchAll(); 
  
  echo ' 
  
  <table>
  <div class="back">
          <thead>
            <th> Name </th>
            <th> Email </th>
            <th> Location </th>
            <th> Skills </th>
            <th> Edit? </th> 
            <th> Delete?</th>
          </thead>
           </div>
          <tbody> 
         
          ';
  
  //loop through the data and create a new table row for each record 
  
  foreach($data as $data1) {
    echo '<tr><td>' . $data1['name'] . '</td>';
    echo '<td>' . $data1['email'] . '</td>';
    echo '<td>' . $data1['location'] . '</td>';
    echo '<td>' . $data1['skills'] . '</td>';
    echo '<td><a href="index.php?user_id='.$data1['user_id']. '">Edit </a></td>';
    echo '<td><a href="delete.php?user_id=' . $data1['user_id'] .'"onclick="return confirm(\'Are you sure?\');"> Delete </a></td></tr>';     
  }
  
  
  echo '</tbody></table>'; 
  
  
  //close the db connection 
  
  $cmd->closeCursor(); 

}

catch(PDOException $e) {
  header('location:error.php'); 
  mail('kirill.mankovsky@gmail', ' Database Problems', $e); 
  
}

ob_flush(); 

require('includes/footer.php'); ?>