<?php

include_once 'connection.php';

$sql1="DROP PROCEDURE IF EXISTS updateRes";
$sql2="CREATE PROCEDURE updateRes(
    IN strNume varchar(256),
    IN strEmail varchar(256),
    IN phone int,
    IN persons int,
    IN strDate varchar(256),
    IN strTime varchar(256)
    )
    BEGIN
        UPDATE reservations SET email=strEmail, phone=phone, persons=persons, date=strDate, time=strTime WHERE strNume=name;
    END;";
$stmt1=$conn->prepare($sql1);
$stmt2=$conn->prepare($sql2);
$stmt1->execute();
$stmt2->execute();
   
$name=$_POST['nume'];
$email=$_POST['email'];
$phone=$_POST['phone_number'];
$persons=$_POST['persons'];
$date=$_POST['date'];
$time=$_POST['time'];

$sql5="DROP TRIGGER IF EXISTS TriggerUpdate";
$sql4="CREATE TRIGGER TriggerUpdate BEFORE UPDATE ON reservations FOR EACH ROW
    BEGIN
    SET NEW.name=UPPER(NEW.name);
    END;";
$stmt5=$conn->prepare($sql5);
$stmt4=$conn->prepare($sql4);
$stmt5->execute();
$stmt4->execute(); 

$sql3="CALL updateRes('{$name}','{$email}','{$phone}','{$persons}','{$date}','{$time}')";
$q=$conn->query($sql3);
if($q){
    header("Location: index.php");
} else {
    echo "vai vai vai";
}
echo "<br><br>";