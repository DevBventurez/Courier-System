<?php
session_start();
if (isset($_SESSION['uid'])) {
    echo "";
} else {
    header('location: ../login.php');
}
?>
<?php
include('header.php');
include('../dbconnection.php');
$idd = $_GET['sidd'];

$qryy = "SELECT * FROM `courier` WHERE `c_id`='$idd'";
$run = mysqli_query($dbcon, $qryy);
$data = mysqli_fetch_assoc($run);
$stdate = $data['date'];
$tddate = date('Y-m-d');

if ($stdate == $tddate) {
?>
    <h1 style="margin: 100px;background-color:red;text-align:center">Delivery Status >> not yet...</h1>
    <br /><hr />
    <div align='center'>
        <!-- Button to indicate delivery made -->
        <button onclick="markDelivery('yes')" style="background-color:green;height:60px;width:130px;border-radius:15px;cursor:pointer">Delivery Made</button>
        <!-- Button to indicate not yet delivered -->
        <button onclick="markDelivery('no')" style="background-color:red;height:60px;width:130px;border-radius:15px;cursor:pointer">Not Yet Delivered</button>
        <button onclick="window.location.href='trackMenu.php'" style="background-color:green;height:60px;width:130px;border-radius:15px;cursor:pointer">Go Back</button>
    </div>
<?php
} else {
?>
    <h1 style="margin: 100px;background-color:red;text-align:center">Delivery Status >> Yes<br /><p>not Yet</p></h1>
    <br /><hr />
    <div align='center'>
        <button onclick="window.location.href='trackMenu.php'" style="background-color:green;height:60px;width:130px;border-radius:15px;cursor:pointer">Go Back</button>
    </div>
<?php
}
?>

<script>
    function markDelivery(status) {
        // Here you can add logic to update the delivery status in the database
        alert("Delivery Marked as " + (status === 'yes' ? 'Made' : 'Not Yet Delivered'));
    }
</script>
