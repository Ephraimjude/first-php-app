<?php

    include('config/db_connect.php');

    //all the errors should be in their own var so that it will be 
    //easier to call during form validation
    $error = array('email'=>'', 'title' =>'', 'ingredients'=>'');

    //to validate the empty form we need to define the input boxes 
    $email = $title = $ingredients = '';

    //isset($_POST) is the inbuilt function to put everything in array
    //since $_POST is a universal abi global array
    if(isset($_POST['submit'])){

        //check email
        if(empty($_POST['email'])){
            $error['email'] = 'Email required <br/>';
        }else{
            $email = $_POST['email'];
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $error['email'] = 'email must be a valid email address';
            }
        }

        //check title
        if(empty($_POST['title'])){
            $error['title'] = 'Title required <br/>';
        }else{
            $title = $_POST['title'];
            //this is the regex for words and spaces
            if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
                $error['title'] = 'Title must be letters and spaces only';
            }
        }

        //check ingredients
        if(empty($_POST['ingredients'])){
            $error['ingredients'] = 'Ingredients required <br/>';
        }else{
            $ingredients = $_POST['ingredients'];
            //this is the regex for all words and commas
            if(!preg_match('/^([a-zA-Z]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
                $error['ingredients'] = 'Ingredients must be a comma seperated list';
            }
        }
        
        //checking for errors when sending data to database
        if(array_filter($error)){
            
        }else{
            //this is where we will link the data to the data base from the site
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $title = mysqli_real_escape_string($conn, $_POST['title']);
            $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);

            //create sql
            $sql = "INSERT INTO pizzas(title, email, ingredients) VALUES('$title', '$email', '$ingredients')";

            //save to db and check
            if (mysqli_query($conn, $sql)){
                //success
                header('Location: index.php');
            } else {
                //error
                echo 'query error;'. mysqli_error($conn);
            }           
        }
    }//end of POST

?>
<!Doctype html>
<html lang="en">
    
    <?php include ('templates/header.php'); ?>

    <section class="container grey-text">
        <h4 class="center">Add a Pizza</h4>
        <form method="POST" action="add.php" class="white">
        <label for="email">Your Email:</label>
        <input type="email" name="email" id="" value="<?php echo htmlspecialchars($email) ?>">
        <div class="red-text"><?php echo $error['email']; ?></div>
        <label for="">PIzza title:</label>
        <input type="text" name="title" id="" value="<?php echo htmlspecialchars($title) ?>">
        <div class="red-text"><?php echo $error['title']; ?></div>
        <label for="">Ingredients (comma separated):</label>
        <input type="text" name="ingredients" id="" value="<?php echo htmlspecialchars($ingredients) ?>">
        <div class="red-text"><?php echo $error['ingredients']; ?></div>
        <div class="center">
            <input type="submit" value="submit" name="submit" class="btn brand z-depth-0">
        </div>
    </form>
    </section>


    <?php include 'templates/footer.php'; ?>

</html>