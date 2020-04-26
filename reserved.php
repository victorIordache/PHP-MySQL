<?php
include_once 'connection.php';
        echo "<table border='1'>
    <tr>
    <th>Name</th>
    <th>Email</th>
    <th>Phone number</th>
    <th>Persons</th>
    <th>Date</th>
    <th>Time</th>
    <th>Image</th>
    </tr>";
        $sql="SELECT * FROM reservations";
        foreach($conn->query($sql) as $row){
    echo "<tr>";
    echo "<td>".$row['name']."</td>";
    echo "<td>".$row['email']."</td>";
    echo "<td>".$row['phone']."</td>";
    echo "<td>".$row['persons']."</td>";
    echo "<td>".$row['date']."</td>";
    echo "<td>".$row['time']."</td>";
    echo "<td><img src=".$row['image']."></td>";
}
        ?>
<br/>
<a href='index.php'>Back</a>
<br/>