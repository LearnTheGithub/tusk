<?php
    include ("navbar.php");
    include ("db_connection.php");
    $sql="Select * from customers";
    $result=$con->query($sql);
    if($result->num_rows > 0)
    { ?>
    <div class="row mx-auto">
    <div class="col-md-8 mt-5">
        <p class="bg-dark text-white text-center p-2" style="margin-top:35px;">Our Customers</p>
        <table class="table text-center">
            <thead>
                <tr >
                    <th>Id</th>
                    <th>Name</th>
                    <th>E-Mail</th>
                    <th>Current Amount (Rs.)</th>
                    <th>Transfer Money</th>
                </tr>
            </thead>
            <?php 
                while($row=$result->fetch_assoc()) 
            { ?>

            <tbody>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['currentamt']; ?></td>
                    <td>
                        <form action="view_customers.php" method="POST" class="d-inline">
                            <button class="btn btn-success" name="transfer" value="Transfer" type="submit"><i class="fab fa-cc-visa"></i></i></button>   
                            <input type="hidden" name="id" value='<?php echo $row['id']; ?>'>
                        </form>               
                    </td>
                </tr>
            </tbody>
            <?php } ?>
        </table>
    </div>
    <?php
if(isset($_REQUEST['transfer']))
{
    $id=$_REQUEST['id'];
    $sqli="select * from customers where id='$id'";
    echo $row['name'];
    $result=$con->query($sqli);
    $row=$result->fetch_assoc();  ?>
    <div class="col-md-4 mt-5 bg-light">
        <h3 class="text-center" style="margin-top:35px;">Transfer Money</h3>
        <form action="transfer.php" method="POST">
            <div class="form-group">
                <label for="customerId" class="font-weight-bold pl-2">Customer Id</label>
                <input type="text" name="customerId" id="cid" class="form-control" id="customerId" readonly value="<?php echo $row['id']; ?>">
                
            </div>
            <div class="form-group">
                <label for="inputRequestInfo" class="font-weight-bold pl-2">Customer Name</label>
                <input type="text" name="customerName" id="customerName" class="form-control" readonly value="<?php echo $row['name']; ?>">
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="currentamt" class="font-weight-bold pl-2">Current Amount</label>
                    &#x20B9; <input type="text" name="currentAmt" id="currentAmt" class="form-control" readonly value="<?php echo $row['currentamt']; ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="transferamt" class="font-weight-bold pl-2">Amount to Transfer (Rs.)</label><br>
                    <input type="text" name="transferAmt" id="transferAmt" class="form-control" required>
                    
                </div>
            </div>
            <div class="form-group">
                <label for="transferTo" class="font-weight-bold pl-2">Transfer To</label>
                <input type="text" name="transferTo" id="transferTo" class="form-control" placeholder="Enter Id" required>
            </div>
            <div class="float-right mb-3">
                <button type="submit" class="btn btn-success mr-2" name="finaltransfer">Transfer</button>
            </div>    
        </form>
    </div>
    
    <?php } ?>
    </div>
    <?php    } ?>

<?php include ("footer.php");
?>

