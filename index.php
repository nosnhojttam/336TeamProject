<?php

    include '../../includes/dbConnection.php';

    $dbConn = getDatabaseConnection('clothing_store');

    function displayClothes(){
        
        global $dbConn;
    
        $sql = "SELECT * FROM `item`
                INNER JOIN dept
                ON item.deptId = dept.deptID 
                WHERE 1 "; //getting all records
                
        if (isset($_GET['submit']))
            {
                $namedParameters = array();
                
                if (!empty($_GET['itemName']))
                    {
                   $sql = $sql . " AND item.itemName LIKE :itemName";
                   $namedParameters[':itemName'] = "%" . $_GET['itemName'] . "%";
                    }
                    if(isset($_GET['inStore']))
                     {
                    $sql = $sql . " AND item.availability = :availability";
                    $namedParameters[':availability'] = "in Store";
                    }
                
                 if(isset($_GET['online']))
                    {
                    $sql = $sql . " AND item.availability = :availability";
                    $namedParameters[':availability'] = "Online";
                    }
                
                if(isset($_GET['mens']))
                    {
                    $sql = $sql . " AND dept.deptId = :deptId";
                    $namedParameters[':deptId'] = "1";
                    }
                
                 if(isset($_GET['womens']))
                    {
                    $sql = $sql . " AND dept.deptId = :deptId";
                    $namedParameters[':deptId'] = "2";
                    }
                
                if(isset($_GET['kids']))
                    {
                    $sql = $sql . " AND dept.deptId = :deptId";
                    $namedParameters[':deptId'] = "3";
                    }
            }
        
            if(isset($_GET['sort']))
            {
                $sortN = $_GET['sort'];
                
                
                if($sortN = 'pricehigh')
                    {
                    $sql= $sql . " ORDER BY item.price DESC";
                    }
            }
                    
            if(isset($_GET['sort1']))
            {
                $sortN1 = $_GET['sort1'];
                
                if ($sortN1='item')
                {
                    $sql=$sql . " ORDER BY item.itemName";
                }
                
            }
            
            
                
        $stmt = $dbConn->prepare($sql);
        $stmt->execute($namedParameters);
        $records = $stmt->fetchALL(PDO::FETCH_ASSOC);
        
        echo "<table border=1>";
        echo "<tr>";
            echo "<th>!</th>";
            echo "<th>Item Name</th>";
            echo "<th>Price</th>";
            echo "<th>Availability</th>";
            echo "<th>Department</th>";
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
            <h1>Filter your search:</h1>
               <input type= "checkbox" name= "inStore" id ="inStore" value="inStore">
             <label for="inStore" > In Store</label>
             
             <input type= "checkbox" name= "online" id ="online" value="online">
             <label for="online" > Online</label>
             
             <input type= "checkbox" name= "kids" id ="kids" value="kids">
             <label for="kids" > Kid's</label>
             
               <input type= "checkbox" name= "mens" id ="mens" value="mens">
             <label for="mens" > Men's</label>
             
             <input type= "checkbox" name= "womens" id ="womens" value="womens">
             <label for="womens" > Women's</label>
             
             <input type= "checkbox" name= "sort" id ="sort" value="sort">
             <label for="sort" > Order by Price</label>
             
              <input type= "checkbox" name= "sort1" id ="sort1" value="sort1">
             <label for="sort1" > Order by Name</label>
             
             <input type="submit" name ="submit" value="Search"/></td>
        </form>

        <br /><hr><br />
         
         <form action="shoppingCart.php">
           <?=displayClothes()?>  
           <br />
           
           <input type="submit" value="Continue">
         </form>  
         
        
    </body>
