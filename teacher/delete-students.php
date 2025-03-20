<?php
session_start();
include('../includes/dbconnection.php');
if (strlen($_SESSION['id'])==0){
    header("Location: logout.php");
} else {
    if (isset($_GET['delid'])) {
        $rid=$_GET['delid'];
        $sql="delete from nguoidung where id=$rid";
        $query=$dbh->prepare($sql);
        $query->execute();
        echo "<script>alert('Data deleted');</script>";
        echo "<script>window.location.href='manage-students.php'</script>";
    } 
    /*
    else if (isset($_GET['delmsg'])) {
        $userid=$_SESSION['id'];
        $senderid=$_GET['delmsg'];
        $sql = "delete from tinnhan where receiver_id=$userid AND sender_id=$senderid";
        $query=$dbh->prepare($sql);
        $query->execute();
        echo "<script>alert('Message deleted');</script>";
        echo "<script>window.location.href='message.php'</script>";
    }*/
}
?>