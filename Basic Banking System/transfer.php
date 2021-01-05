<?php 
include("db_connection.php");
$id=$_REQUEST['customerId'];
$curamt=$_REQUEST['currentAmt'];
$transferAmt=$_REQUEST['transferAmt'];
$tid=$_REQUEST['transferTo'];
$finalAmtSender=($curamt-$_REQUEST['transferAmt']);
$curamtrec;
if($curamt < $transferAmt)
{ ?>
    <script>
        alert("Sorry! You don't have enough amount to transfer");
    </script>
<?php echo "<script>location.href='view_customers.php'</script>";
}
else if($id == $tid)
{?>
    <script>
        alert("Sorry! You you can't transfer money to yourself");
    </script>
<?php echo "<script>location.href='view_customers.php'</script>";
}
else
{
    $sql="select * from customers where id='$tid'";
    $result=$con->query($sql);
    if($result->num_rows==1)
    {
        $row=$result->fetch_assoc();
        global $curamtrec;
        $curamtrec=$row['currentamt'];
    }
    $finalAmtReciever=($curamtrec+$_REQUEST['transferAmt']);

    //Insert transaction information
    $sqlt="Insert into transfer (senderId, recieverId, amount) values ('$id', '$tid', '$transferAmt')";

    //Update Reciever Current Amount after Transaction
    $sqlr="update customers set currentamt='$finalAmtReciever' where id='$tid'";
    $resultr=$con->query($sqlr);

    //Update Sender Current Amount after Transaction
    $sqls="update customers set currentamt='$finalAmtSender' where id='$id'";

    $results=$con->query($sqls);
    if($results===TRUE && $resultr===TRUE && $con->query($sqlt)===TRUE)
    { ?>
    <script>
        alert("Transfer Successful");
    </script>
    <?php echo "<script>location.href='view_customers.php'</script>";
    }
    else
    {
        alert ("Transfer Successful");
    }   
    
} ?>


