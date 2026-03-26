<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Withdrawal</title>
</head>
<body>
<script src="aaron.js"></script>
	<?php
		// Include navigation menu
		include "menu.php";
	?>
    <div class="displaySelected">
<?php
    // Include database connection
    include 'dbcon.php';
    
    // Check if both account_id and withdrawal amount were submitted from the form
    if (!empty($_POST['account_id']) && !empty($_POST['withdrawal_amount'])) {
        // Extract and cast POST data to appropriate types
        $account_id = $_POST['account_id'];
        $withdrawal_amount = (float)$_POST['withdrawal_amount'];
        $current_balance = (float)$_POST['current_balance'];

        // Query to retrieve account type (Current or Deposit) from account table
        // This determines which balance table to update and whether overdraft applies
        $type_sql = "SELECT account_type FROM account WHERE account_id = '$account_id'";
        $type_result = mysqli_query($con, $type_sql);
        $type_row = mysqli_fetch_array($type_result);
        $account_type = $type_row['account_type'];

        // Get balance from correct table
        if ($account_type == 'Current') {
            $check_sql = "SELECT balance, overdrawn_limit FROM current_account WHERE account_id = '$account_id'";
            $check_result = mysqli_query($con, $check_sql);
            $check_row = mysqli_fetch_array($check_result);
            $db_balance = (float)$check_row['balance'];
            $overdraft_limit = (float)$check_row['overdrawn_limit'];
            $min_allowed = -$overdraft_limit;
        } elseif ($account_type == 'Deposit') {
            $check_sql = "SELECT balance FROM deposit_account WHERE account_id = '$account_id'";
            $check_result = mysqli_query($con, $check_sql);
            $check_row = mysqli_fetch_array($check_result);
            $db_balance = (float)$check_row['balance'];
            $min_allowed = 0;
        } else {
            echo "Withdrawals are not allowed on this account type.";
            echo "<br><a href='withdrawal.html.php'>Go Back</a>";
            mysqli_close($con);
            exit;
        }
        
        $new_balance = $db_balance - $withdrawal_amount;
        
        // Check if withdrawal would exceed account limits
        if ($new_balance < $min_allowed) {
            echo "Withdrawal failed! Insufficient funds in account.<br>";
            echo "Current Balance: €" . number_format($db_balance, 2) . "<br>";
            if ($account_type == 'Current') {
                echo "Overdraft Limit: €" . number_format($overdraft_limit, 2) . "<br>";
            }
            echo "Withdrawal Amount Requested: €" . number_format($withdrawal_amount, 2) . "<br>";
            echo "<br><a href='withdrawal.html.php'>Go Back</a>";
            mysqli_close($con);
            exit;
        }
        
        // Update balance
        if ($account_type == 'Current') {
            $sql = "UPDATE current_account SET balance = '$new_balance' WHERE account_id = '$account_id'";
        } else {
            $sql = "UPDATE deposit_account SET balance = '$new_balance' WHERE account_id = '$account_id'";
        }
        if (!mysqli_query($con, $sql)) {
            die ("Error updating balance: " . mysqli_error($con));
        }
        
        // Record transaction
        $transaction_date = date('Y-m-d H:i:s');
        $sql = "INSERT INTO transactions (account_id, transaction_type, transaction_amount, balance, transaction_date) VALUES ('$account_id', 'Withdrawal', '$withdrawal_amount', '$new_balance', '$transaction_date')";
        if (!mysqli_query($con, $sql)) {
            die ("Error recording transaction: " . mysqli_error($con));
        }
        
        // Display success
        echo "<h2>Withdrawal Successful!</h2><br>";
        echo "<strong>Transaction Receipt:</strong><br>";
        echo "Account ID: $account_id<br>";
        echo "Transaction Type: Withdrawal<br>";
        echo "Withdrawal Amount: €" . number_format($withdrawal_amount, 2) . "<br>";
        echo "Previous Balance: €" . number_format($current_balance, 2) . "<br>";
        echo "New Balance: €" . number_format($new_balance, 2) . "<br>";
        echo "Transaction Date: $transaction_date<br><br>";
    }
    
    mysqli_close($con);
?>
    </div>
</body>
</html>