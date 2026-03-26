<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Amend Current Account</title>
</head>

<body>
<script src="aaron.js"></script>

	<?php
		include "menu.php";
	?>

    <div class="displaySelected">

<?php
    include 'dbcon.php';

    // Update overdraft limit
    if (!empty($_POST['account_id']) && !empty($_POST['overdrawn_limit'])) {
        $sql = "UPDATE current_account SET overdrawn_limit = '$_POST[overdrawn_limit]' WHERE account_id = '$_POST[account_id]'";

        if (!mysqli_query($con, $sql))
        {
            die("An Error updating overdraft limit: " . mysqli_error($con));
        }

        echo "<p>Overdraft limit updated successfully!</p>";
        
        echo "<h2>Last 10 Transactions</h2>";
        
        $account_id = $_POST['account_id'];
        
        // Get 10 most recent transactions
        $sql = "SELECT * FROM transactions WHERE account_id = '$account_id' ORDER BY transaction_date DESC LIMIT 10";
        $result = mysqli_query($con, $sql);
        
        echo "<select class='selectbox'>";
        echo "<option value=''>-- Recent Transactions --</option>";
        
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $display = $row['transaction_date'] . " - " . $row['transaction_type'] . " - €" . number_format($row['transaction_amount'], 2);
                echo "<option value='$display'>$display</option>";
            }
        }
        
        echo "</select>";
    }
    
    mysqli_close($con);
?>

</div>
</body>
</html>
