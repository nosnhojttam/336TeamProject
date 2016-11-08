<?php
    session_start();
    
    include '../../includes/dbConnection.php';

    $dbConn = getDatabaseConnection('clothing_store');
    
    echo "<h1>More Info</h1>";
    
    $item = $_GET['itemId'];
    
    $sql = "SELECT * 
            FROM item
            INNER JOIN supplier
            ON item.supplierId = supplier.supplierId
            INNER JOIN dept
            ON item.deptId = dept.deptId
            WHERE item.itemId = '" . $item . "'";
            
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    
    echo "<table border=1>";
    echo "<tr>";
        echo "<th>Item</th>";
        echo "<th>price</th>";
        echo "<th>Availability</th>";
        echo "<th>Department</th>";
        echo "<th>Supplier Name</th>";
        echo "<th>Supplier Phone</th>";
        echo "<th>Supplier Email</th>";
    echo "</tr>";
    echo "<tr>";
        echo "<td>" . $record['itemName'] . "</td>";
        echo "<td>" . $record['price'] . "</td>";
        echo "<td>" . $record['availability'] . "</td>";
        echo "<td>" . $record['deptName'] . "</td>";
        echo "<td>" . $record['supplierName'] . "</td>";
        echo "<td>" . $record['supplierPhone'] . "</td>";
        echo "<td>" . $record['supplierEmail'] . "</td>";
    echo "</tr>";
    echo "</table>";
    
    
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Clothing Store</title>
        <link rel="stylesheet" href="https://cst336-john4722.c9users.io/team_project/336TeamProject/css/styles.css" type="text/css" />
    </head>
    
    <body>
     
    </body>
</html>



