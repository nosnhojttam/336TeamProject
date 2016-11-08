<?php
    session_start();
    
    include '../../includes/dbConnection.php';

    $dbConn = getDatabaseConnection('clothing_store');
    
    if(!isset($_SESSION['cart'])){
        $_SESSION['cart'] = array();  //initialize session variable
    }
        
    $cart = $_GET['cart'];
    
    foreach($cart as $element)
    {   
        if(!in_array($element, $_SESSION['cart'])){
            $_SESSION['cart'][] = $element;
        }
    }
    
     echo "<h1>Shopping Cart </h1>";
    
    $sql = "SELECT *
            FROM item
            WHERE 1";
            
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchALL(PDO::FETCH_ASSOC);
    
    foreach($_SESSION['cart'] as $element){
        for($i = 0; $i < count($records); $i++){
            if($records[$i]['itemId'] == $element){
                echo $records[$i]['itemName'] . " $" . $records[$i]['price'] . "<br>";
            }
        }
        
    }
    
    
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Team Project</title>
        <link rel="stylesheet" href="https://cst336-john4722.c9users.io/team_project/336TeamProject/css/styles.css" type="text/css" />
    </head>
    
    <body>
        <form>
            <input type="submit" value="Reserve" />
        </form>
    </body>
</html>



