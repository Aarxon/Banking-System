<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Home</title>
</head>

<body>
<!-- Include external JavaScript with validation functions -->
<script src="aaron.js"></script>

	<?php
		// Include navigation menu from separate file
		include "menu.php";
	?>

    <div class="displaySelected">
        <h2>Process Withdrawal</h2>
        <!-- Form for withdrawal processing - submits to withdrawal.php for server-side processing -->
        <form action="withdrawal.php" method="POST" onsubmit="return withdrawalConfirmCheck()">

        <div class="form-row">
            <div class="form-group">
                <label for="account1">Select Account</label>
                <!-- Dropdown to select which account to process withdrawal from -->
                <!-- onchange triggers populateAccountWithdrawal() to auto-populate form fields -->
                <select name="account1" id="account1" class="selectbox" onchange="populateAccountWithdrawal()">
                    <option value="">-- Select Account --</option>
                    <?php
                        // Include database connection
                        include "dbcon.php";
                        
                       // SQL query to fetch all active Current and Deposit accounts with associated customer and balance information
                       // This joins multiple tables to get complete account details for display
                       // Excludes deleted accounts (deleted_flag = 0 or NULL)
                       $sql = "SELECT a.account_id, a.customer_id_1, a.customer_id_2, a.account_type, c1.name, c1.surname, c1.address, c1.phone_number, c1.eircode, c1.date_of_birth, c2.name AS name2, c2.surname AS surname2, c2.address AS address2, c2.phone_number AS phone2, c2.eircode AS eircode2, c2.date_of_birth AS dob2, IF(a.account_type = 'Current', ca.balance, da.balance) AS balance, ca.overdrawn_limit
        FROM account a
        JOIN customers c1 ON a.customer_id_1 = c1.customer_id
        LEFT JOIN customers c2 ON a.customer_id_2 = c2.customer_id
        LEFT JOIN current_account ca ON a.account_id = ca.account_id
        LEFT JOIN deposit_account da ON a.account_id = da.account_id
        WHERE (a.account_type = 'Current' OR a.account_type = 'Deposit') AND (ca.deleted_flag = 0 OR ca.deleted_flag IS NULL)";


                        if(!$result = mysqli_query($con, $sql))
                        {
                            die("Error in querying the database " . mysqli_error($con));
                        }

                        // Loop through all active accounts and create option elements
                        while($row = mysqli_fetch_array($result))
                        {
                            // Extract account and customer details from database row
                            $account_id = $row['account_id'];
                            $cust1_id = $row['customer_id_1'];
                            $cust2_id = $row['customer_id_2'];
                            $account_type = $row['account_type'];
                            $name1 = $row['name'];
                            $surname1 = $row['surname'];
                            $address1 = $row['address'];
                            $phone1 = $row['phone_number'];
                            $eircode1 = $row['eircode'];
                            $dob1 = $row['date_of_birth'];
                            $name2 = $row['name2'];
                            $surname2 = $row['surname2'];
                            $address2 = $row['address2'];
                            $phone2 = $row['phone2'];
                            $eircode2 = $row['eircode2'];
                            $dob2 = $row['dob2'];
                            $balance = $row['balance'];
                            $overdraft = isset($row['overdrawn_limit']) ? $row['overdrawn_limit'] : 0;
                            
                            // Create pipe-delimited string with all account data
                            // This will be parsed by JavaScript populate function
                            $allText = "$account_id|$cust1_id|$name1|$surname1|$address1|$phone1|$eircode1|$dob1|$cust2_id|$name2|$surname2|$address2|$phone2|$eircode2|$dob2|$balance|$overdraft|$account_type";
                            
                            // Display format: show both customers if joint account, or single customer name
                            $display = ($cust2_id) ? "$account_id - $name1 $surname1 & $name2 $surname2" : "$account_id - $name1 $surname1";
                            echo "<option value='$allText'>$display</option>";
                        }

                        // Close database connection
                        mysqli_close($con);
                    ?>
                </select>
            </div>
        </div>

<!-- Hidden fields for form data -->
<input type="hidden" name="account_id" id="account_id">
<input type="hidden" name="account_type" id="account_type">
<input type="hidden" name="current_balance" id="current_balance">
<input type="hidden" name="overdraft_limit" id="overdraft_limit">

<br>
<h2>First Customer</h2>

<div class="form-row">
    <div class="form-group">
        <label for="wfirstname">First Name</label>
        <input name="First_Name" id="wfirstname" type="text" disabled>
    </div>

    <div class="form-group">
        <label for="wlastname">Surname</label>
        <input name="Surname" id="wlastname" type="text" disabled>
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label for="wAddress">Address</label>
        <input name="address" id="wAddress" type="text" disabled>
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label for="wPhone">Phone Number</label>
        <input name="number" id="wPhone" type="text" disabled>
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label for="wEircode">Eircode</label>
        <input name="eircode" id="wEircode" type="text" disabled>
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label for="wDOB">Date of Birth</label>
        <input name="dob" id="wDOB" type="text" disabled>
    </div>
</div>

<!-- Second customer section (hidden by default) -->
<div id="customer2SectionWithdrawal" hidden>
    <br>
    <h2>Second Customer</h2>

    <div class="form-row">
        <div class="form-group">
            <label for="wfirstname2">First Name</label>
            <input name="First_Name2" id="wfirstname2" type="text" disabled>
        </div>

        <div class="form-group">
            <label for="wlastname2">Surname</label>
            <input name="Surname2" id="wlastname2" type="text" disabled>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="wAddress2">Address</label>
            <input name="address2" id="wAddress2" type="text" disabled>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="wPhone2">Phone Number</label>
            <input name="number2" id="wPhone2" type="text" disabled>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="wEircode2">Eircode</label>
            <input name="eircode2" id="wEircode2" type="text" disabled>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="wDOB2">Date of Birth</label>
            <input name="dob2" id="wDOB2" type="text" disabled>
        </div>
    </div>
</div>

<br>

<div class="form-row">
    <div class="form-group">
        <label for="wAccountID">Account Number</label>
        <input name="account_id_display" id="wAccountID" type="text" disabled>
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label for="wAccountType">Account Type</label>
        <input name="account_type_display" id="wAccountType" type="text" disabled>
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label for="wBalance">Current Balance</label>
        <input name="balance" id="wBalance" type="text" disabled>
    </div>
</div>

<br>
<h2>Withdrawal Details</h2>

<div class="form-row">
    <div class="form-group">
        <label for="withdrawalAmount">Withdrawal Amount (€)</label>
        <input name="withdrawal_amount" id="withdrawalAmount" type="number" min="0.01" step="0.01" required>
    </div>
</div>

<br>
		
<div class="form-row">
    <input type="submit" value="Process Withdrawal" class="myButton">
</div>

    </form>
    </div>
</div>

</body>
</html>
