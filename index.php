<?php

    include '../../includes/dbConnection.php';

    $dbConn = getDatabaseConnection('clothing_store');

    function displayClothes(){
        
        global $dbConn;
    
        $sql = "SELECT * FROM `item`
                INNER JOIN dept
                ON item.deptId = dept.deptID "; //getting all records
                
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchALL(PDO::FETCH_ASSOC);
        
        echo "<table border=1>";
        echo "<tr>";
            echo "<td>!</td>";
            echo "<td>Item Name</td>";
            echo "<td>Price</td>";
            echo "<td>Availability</td>";
            echo "<td>Department</td>";
            echo "</tr>";
        foreach($records as $record){
            echo "<tr>";
            echo "<td> <input type='checkbox' value='" . $record['itemId'] . "' name='cart[]'> </td>";
            echo "<td>" . $record['itemName'] . "</td>";
            echo "<td>" . "$" . $record['price'] . "</td>";
            echo "<td>" . $record['availability'] . "</td>";
            echo "<td>" . $record['deptName'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Team Project</title>
        <link rel="stylesheet" href="https://cst336-john4722.c9users.io/team_project/336TeamProject/css/styles.css" type="text/css" />
    </head>
    
    <body>
        <h1> Technology Center: Checkout System </h1>
    
        <form>
            <h1>put filtering/sorting here</h1>
        </form>

        <br /><hr><br />
         
         <form action="shoppingCart.php">
           <?=displayClothes()?>  
           <br />
           <input type="submit" value="Continue">
         </form>  
        
    </body>
</html>