<?php 

//link to db
include('config/db_connect.php');

//to delete form from the site using isset function
if (isset($_POST['delete'])){

    $id_to_delete = mysqli_real_escape_string ($conn, $_POST['id_to_delete']);
        //sql to delete data from the database
    $sql = "DELETE FROM pizzas WHERE id = $id_to_delete";

    if(mysqli_query($conn, $sql)){
        //success
        header('Location: index.php');
    }else{
        //failure
        echo 'query error:' . mysqli_error($conn);
    }
}

//check GET request id param
//this is the way to take any data from the db to show on the browser
//you take one of the data to display, where to get the data, and display it
 if (isset($_GET['id'])){
        
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    //make the sql
    $sql = "SELECT * FROM pizzas WHERE id=$id";

    //get query result
    $result=mysqli_query($conn, $sql);

    //fetch result in array format
    $pizza = mysqli_fetch_assoc($result);

    mysqli_free_result($result);
    mysqli_close($conn);   

 }

?>

<html lang="en">

<?php include('templates/header.php'); ?>

<div class="container center">
    <?php  if($pizza): ?>

    <h4><?php echo htmlspecialchars($pizza['title']);?></h4>
    <p>Created by:<?php echo htmlspecialchars($pizza['email']); ?></p>
    <p><?php echo date($pizza['created_at']); ?></p>
    <h5>Ingredients:</h5>
    <p><?php echo htmlspecialchars($pizza['ingredients']); ?></p>

    <!---Delete form--->
    <form action="detail.php" method="POST">
        <input type="hidden" name="id_to_delete" value="<?php echo $pizza['id']; ?>">
        <input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
    </form>

    <?php else: ?>

     <h5>No such pizza exists!</h5>  

    <?php endif; ?>

</div>

<?php include('templates/footer.php'); ?>

</html>