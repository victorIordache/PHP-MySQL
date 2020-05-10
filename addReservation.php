<?php
include_once 'connection.php';

$sql5="DROP TRIGGER MysqlTrigger1";
$sql4="CREATE TRIGGER MysqlTrigger1 BEFORE INSERT ON reservations FOR EACH ROW
    BEGIN
    INSERT INTO reservations_updated(nume,status,id,edtime) VALUES (NEW.name,'UPDATED',NULL,NOW());
    END;";
$stmt5=$conn->prepare($sql5);
$stmt=$conn->prepare($sql4);
$stmt5->execute();
$stmt->execute();


$sql1="DROP PROCEDURE IF EXISTS insertRes";
$sql2="CREATE PROCEDURE insertRes(
    IN strNume varchar(256),
    IN strEmail varchar(256),
    IN phone int,
    IN persons int,
    IN strDate varchar(256),
    IN strTime varchar(256),
    IN strImage varchar(256)
    )
    BEGIN
        INSERT INTO reservations
        (name,email,phone,persons,date,time,image)
    VALUES (strNume, strEmail, phone, persons,strDate,strTime,strImage);
    END;";
$msg="";

$target="images/".md5(uniqid(time())).basename($_FILES['image']['name']);
    $sqls="CALL insertImage('{$target}')";
    $q11=$conn->query($sqls);
    if(move_uploaded_file($_FILES['image']['tmp_name'],$target)){
        echo 'e bine';
        
    }
    
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


$sql3="CALL insertRes('{$name}','{$email}','{$phone}','{$persons}','{$date}','{$time}','{$target}')";
$q=$conn->query($sql3);
if($q){
    header("Location: index.php");
} else {
    echo "vai vai vai";
}
echo "<br><br>";

