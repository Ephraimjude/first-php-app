<?php

    include('config/db_connect.php');

   //write query for all the pizzas
   $sql = 'SELECT title, ingredients, id FROM pizzas ORDER BY created_at';

   //make the query and get result
   $result = mysqli_query($conn, $sql);

   //fetch the resultin rows as an array
   $pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

   //free from memory
   mysqli_free_result($result);

   //closing the connection
   mysqli_close($conn);

   //to show the arrays in the database
  //print_r($pizzas);

  //explode to circle through the ingredients for the pizza
  //explode function
  //explode(',', $pizzas[0]['ingredients']);


?>
<!Doctype html>
    <html lang="en">
    
        <?php include ('templates/header.php'); ?>

        <h4 class="center grey-text">Pizzas!</h4>
        <div class="container">
            <div class="row">
                <!-- looping through each pizza -->
                <?php foreach($pizzas as $pizza) {?>
                    <div class="col s6 md3">
                        <div class="card z-depth-0">
                            <div class="card-content center">
                                <h4><?php echo htmlspecialchars($pizza['title']); ?></h4>
                                <ul>
                                    <?php  foreach(explode(',',$pizza['ingredients']) as $ing){ ?>
                                        <li><?php echo htmlspecialchars($ing) ?></li>
                                   <?php } ?>
                                </ul>
                            </div>
                            <div class="card-action right-align">
                                <a href="#" class="brand-text">more info</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

        <?php include 'templates/footer.php'; ?>

    </html>