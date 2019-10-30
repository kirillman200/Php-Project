    <?php require('includes/header.php');
  
    //initializing variables 
    $user_id = null; 
    $name = null; 
    $email = null; 
    $location = null; 
    $skills = null; 
  
  if(!empty($_GET['user_id']) && (is_numeric($_GET['user_id']))) {
    
    //grab the movie id from the URL string 
    
    $user_id = $_GET['user_id'];
    
    //connect to the db
    require('includes/db.php');
    
    //set up your query 
    $sql = "SELECT * FROM proj1 WHERE user_id = :user_id";
    
    //prepare 
    $cmd = $conn->prepare($sql);
    
    //bind 
    $cmd->bindParam(':user_id', $user_id);
    
    //execute 
    $cmd->execute(); 
    
    //use fetchAll method to store info in an array 
    $arrays = $cmd->fetchAll(); 
    
    //loop through array using foreach and set variables
    foreach ($arrays as $array) {
      $name = $array['name']; 
      $email = $array['email'];
      $location = $array['location'];
      $skills = $array['skills'];
    }
    
    //close the database connection 
    
    $cmd->closeCursor();  
  }
 
?>
    <html>
<div class="form">
     <p> Share your information</p>
      <form method="post" action="send-it.php" id="msform" >
          
        <fieldset>
    <h2 class="fs-title">Enter Your Information</h2>
    <h3 class="fs-subtitle">This is step 1</h3>
       
          <input type="text" name="name" class="form-control" placeholder="What's your name?" value="<?php echo $name ?>">
        
      
          <input type="text" name="email" class="form-control" placeholder="Your email address?" value="<?php echo $email ?>">
       
        
          <input type="text" name="location" class="form-control" placeholder="What's your city?" value="<?php echo $location ?>">
        
          
          <input type="text" name="skills" class="form-control" placeholder="What's your skills?" value="<?php echo $skills ?>">
      
          <input type="hidden" name="user_id" value="<?php echo $user_id?>">
          <input type="submit" name="submit" value="Submit" class="action-button">
          </fieldset> 
      </form>
    </div>
   </html>
    <?php require('includes/footer.php') ?>
    
    
    