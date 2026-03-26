<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Open Current Account</title>
</head>

<body>
<script src="aaron.js"></script>

	<?php
		include "menu.php";
	?>

    <div class="displaySelected">
<?php
    include 'dbcon.php';
 
    // Insert account - single or joint
    if (!empty($_POST['customer2'])) {
        $sql = "INSERT into account (customer_id_1, customer_id_2, account_type) VALUES ('$_POST[customer1]', '$_POST[customer2]', 'Current')";
    } else {
        $sql = "INSERT into account (customer_id_1, account_type) VALUES ('$_POST[customer1]', 'Current')";
    }

    if (!mysqli_query($con, $sql))
    {
        die ("An Error in the SQL Query: " . mysqli_error($con));
    }

    // Get the new account ID
    $sql = "SELECT account_id FROM account WHERE customer_id_1 = '$_POST[customer1]' AND account_type = 'Current' ORDER BY account_id DESC LIMIT 1";
    
    $result = mysqli_query($con, $sql);
    if (!$result)
    {
        die ("An Error in the SQL Query: " . mysqli_error($con));
    }
    else
    {
        $row = mysqli_fetch_array($result);
        $account_id = $row['account_id'];
    }

    
    // Insert the current account details using the account_id we just created
    // This initializes the balance and overdraft limit for the new account
    $sql = "INSERT INTO current_account (account_id, overdrawn_limit, balance) VALUES ('$account_id', '$_POST[overdrawn_limit]', '$_POST[balance]')";
    
    // Execute and check for errors
    if (!mysqli_query($con, $sql))
    {
        die ("An Error inserting into current_account: " . mysqli_error($con));
    }
    
    // Display success message with account details
    echo "Current account created successfully!<br><br>";
    echo "<strong>Account Details:</strong><br>";
    echo "Account ID: " . $account_id . "<br>";
    echo "Customer: " . $_POST['customer1'] . "<br>";
    echo "Overdraft Limit: €" . number_format($_POST['overdrawn_limit'], 2) . "<br>";
    echo "Initial Balance: €" . number_format($_POST['balance'], 2) . "<br>";
    
    // Close database connection
    mysqli_close($con);
?>
    </div>
</div>
</body>
</html>
