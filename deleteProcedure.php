<?php
include_once 'connection.php';

$sql1="DROP PROCEDURE IF EXISTS deleteRes";
$sql2="CREATE PROCEDURE deleteRes(
    IN strNume varchar(256)
    )
    BEGIN
        DELETE FROM reservations WHERE name=strNume;
    END;";
$stmt1=$conn->prepare($sql1);
$stmt2=$conn->prepare($sql2);
$stmt1->execute();
$stmt2->execute();

$name=$_POST['nume'];

$sql6="DROP TRIGGER IF EXISTS TriggerDelete";
$sql7="CREATE TRIGGER TriggerDelete AFTER DELETE ON reservations FOR EACH ROW
    BEGIN
    INSERT INTO reservations_updated(nume,status,id,edtime) VALUES (OLD.name,'DELETED',NULL,NOW());
    END;";
$stmt6=$conn->prepare($sql6);
$stmt7=$conn->prepare($sql7);
$stmt6->execute();
$stmt7->execute(); 

$sql3="CALL deleteRes('{$name}')";
$q=$conn->query($sql3);
if($q){
    header("Location: index.php");
} else {
    echo "vai vai vai";
}
echo "<br><br>";