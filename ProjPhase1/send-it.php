    <?php require('includes/header.php');

      // add the user id in case you are editing 
      $user_id = NULL;
      //set up a flag variable 
      $ok = true; 

     if(isset($_POST['submit'])){
        try {
          $user_id = $_POST['user_id']; 
          // store the form inputs in variables
          $name = filter_input(INPUT_POST, 'name');
          $email =  filter_input(INPUT_POST, 'email');
          $location =  filter_input(INPUT_POST, 'location');
          $skills =  filter_input(INPUT_POST, 'skills');
          
          if(empty($name)) {
            $ok = false; 
            echo '<p>Please fill out your name</p>';  
          }
          
          if(empty($email)) {
            $ok = false; 
            echo '<p>Please enter your email</p>'; 
          }
          
          if(empty($location)) {
            $ok = false; 
            echo '<p> Please enter your city!</p>'; 
          }
            if(empty($skills)) {
            $ok = false; 
            echo '<p> Please enter your skills!</p>'; 
          }
          
          if($ok === TRUE) {
        
            //connect to the db 
            require('includes/db.php'); 
          
            if(!empty($user_id)) {
              $sql = "UPDATE proj1 SET name = :name, email = :email, location = :location, skills = :skills WHERE user_id = :user_id";  
      
            }
            else {
            
              $sql = "INSERT INTO proj1(name, email, location, skills) VALUES (:name, :email, :location, :skills)";

            }
          
            $cmd = $conn->prepare($sql); 
        
            $cmd->bindParam(':name', $name);
            $cmd->bindParam(':email', $email); 
            $cmd->bindParam(':location', $location);
            $cmd->bindParam(':skills', $skills);
            
            //if we are updating, we need to bind 
             if(!empty($user_id)) {
              $cmd->bindParam(':user_id', $user_id);   
              }
          
            $cmd->execute(); 
          
          echo '<p> Thanks for sharing your information</p>';
            
          echo '<p class="view"> View all the data <a href="data.php">here </a></p>'; 
          
          $cmd->closeCursor(); 
          }
      }
      catch(PDOException $e) {
      //echo $e; 
      echo "<p> There was an error with your form submission </p>"; 
      mail('kirill.mankovsky@gmail.com', 'app submission error', $e); 
    }
  }
    
   


    require('includes/footer.php'); 
    ?>
