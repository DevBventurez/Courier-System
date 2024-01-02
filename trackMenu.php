<?php
ob_start();
session_start();
if(isset($_SESSION['uid'])){
    echo "";
}else{
    header('location: ../login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Menu</title>
    <style>
        body {
            background-image: url('../images/ELDO1.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        table {
            width: 80%;
            margin-top: 30px;
            margin-left: auto;
            margin-right: auto;
            font-weight: bold;
            border-spacing: 5px 5px;
            border-collapse: collapse;
            background-color: rgba(255, 255, 255, 0.8); /* Background color for the table */
        }

        th {
            background-color: green;
            font-size: 30px;
        }

        td {
            text-align: center;
        }
    </style>
</head>

<?php include('header.php'); ?>

<div style="overflow-x:auto;">
    <table width='80%' border="1px dash" style="margin-top:30px;margin-left:auto ;margin-right:auto ;font-weight:bold;border-spacing: 5px 5px;border-collapse: collapse;">
        <tr style="background-color: green;font-size:30px">
            <th>No.</th>
            <th>Item's Image</th>
            <th>Courier Name</th>
            <th>Receiver Name</th>
            <th>Receiver Email</th>
            <th>Action</th>
        </tr>

        <?php
        include('../dbconnection.php');

        $email = $_SESSION['emm'];

        $qryy = "SELECT * FROM `courier` WHERE `semail`='$email'";
        $run = mysqli_query($dbcon, $qryy);

        if(mysqli_num_rows($run) < 1){
            echo "<tr><td colspan='6'>No record found..</td></tr>";
        } else {
            $count = 0;
            while($data = mysqli_fetch_assoc($run)) {
                $count++;
                ?>
                <tr align="center">
                    <td><?php echo $count; ?></td>
                    <td><img src="../dbimages/<?php echo $data['image']; ?>" alt="pic" style="max-width: 100px;"/> </td>
                    <td><?php echo $data['sname']; ?></td>
                    <td><?php echo $data['rname']; ?></td>
                    <td><?php echo $data['remail']; ?></td>
                    <td>
                        <a href="updationtable.php?sid=<?php echo $data['c_id']; ?>">Edit</a> ||
                        <a href="deleteusers.php?bb=<?php echo $data['billno']; ?>">Delete</a> ||
                        <a href="status.php?sidd=<?php echo $data['c_id']; ?>">CheckDelivery</a>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
    </table>
</div>
;
</html>
