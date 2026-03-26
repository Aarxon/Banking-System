<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Close Current Account</title>
</head>

<body>
<script src="aaron.js"></script>

	<?php
		include "menu.php";
	?>

    <div class="displaySelected">
<?php
    include 'dbcon.php';

    // Mark account as closed (logical delete)
    if (!empty($_POST['account_id'])) {
        $account_id = $_POST['account_id'];
        
        // Update current_account
        $sql = "UPDATE current_account SET deleted_flag = 1 WHERE account_id = '$account_id'";
        if (!mysqli_query($con, $sql))
        {
            die ("An Error closing the current account: " . mysqli_error($con));
        }
        
        // Update account
        $sql = "UPDATE account SET deleted_flag = 1 WHERE account_id = '$account_id'";
        if (!mysqli_query($con, $sql))
        {
            die ("An Error closing the account: " . mysqli_error($con));
        }

        echo "<p>Current account closed successfully!</p>";
    }
    
    mysqli_close($con);
?>
    </div>
</body>
</html>
