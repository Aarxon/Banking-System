<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Home</title>
</head>

<body>
<script src="aaron.js"></script>
	
	<?php
		include "menu.php";
	?>
	
    <div class="displaySelected">
        <h2>Amend Current Account</h2>
        <form method="POST">

        <div class="form-row">
            <div class="form-group">
                <label for="account1">Select Account</label>
                <select name="account1" id="account1" class="selectbox" onchange="populateAccountClose(); populateTransactions()">
                    <option value="">-- Select Account --</option>
                    <?php
                        include "dbcon.php";
                        
                        // Fetch all active current accounts
                        $sql = "SELECT a.account_id, a.customer_id_1, a.customer_id_2, c1.name, c1.surname, c1.address, c1.phone_number, c1.eircode, c1.date_of_birth, c2.name AS name2, c2.surname AS surname2, c2.address AS address2, c2.phone_number AS phone2, c2.eircode AS eircode2, c2.date_of_birth AS dob2, ca.balance, ca.overdrawn_limit
                                FROM account a
                                JOIN customers c1 ON a.customer_id_1 = c1.customer_id
                                LEFT JOIN customers c2 ON a.customer_id_2 = c2.customer_id
                                JOIN current_account ca ON a.account_id = ca.account_id
                                WHERE a.account_type = 'Current' AND ca.deleted_flag = 0";

                        if(!$result = mysqli_query($con, $sql))
                        {
                            die("Error in querying the database " . mysqli_error($con));
                        }

                        while($row = mysqli_fetch_array($result))
                        {
                            // Extract account and customer data
                            $account_id = $row['account_id'];
                            $cust1_id = $row['customer_id_1'];
                            $cust2_id = $row['customer_id_2'];
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
                            $overdraft = $row['overdrawn_limit'];
                            
                            // Create pipe-delimited string for JavaScript parsing
                            $allText = "$account_id|$cust1_id|$name1|$surname1|$address1|$phone1|$eircode1|$dob1|$cust2_id|$name2|$surname2|$address2|$phone2|$eircode2|$dob2|$balance|$overdraft";
                            $display = ($cust2_id) ? "$account_id - $name1 $surname1 & $name2 $surname2" : "$account_id - $name1 $surname1";
                            echo "<option value='$allText'>$display</option>";
                        }

                        mysqli_close($con);
                    ?>
                </select>
            </div>
        </div>

<input type="hidden" name="account_id" id="account_id">

<br>
<h2>First Customer</h2>

<div class="form-row">
    <div class="form-group">
        <label for="closefirstname">First Name</label>
        <input name="First_Name" id="closefirstname" type="text" disabled>
    </div>

    <div class="form-group">
        <label for="closelastname">Surname</label>
        <input name="Surname" id="closelastname" type="text" disabled>
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label for="closeAddress">Address</label>
        <input name="address" id="closeAddress" type="text" disabled>
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label for="closePhone">Phone Number</label>
        <input name="number" id="closePhone" type="text" disabled>
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label for="closeEircode">Eircode</label>
        <input name="eircode" id="closeEircode" type="text" disabled>
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label for="closeDOB">Date of Birth</label>
        <input name="dob" id="closeDOB" type="text" disabled>
    </div>
</div>

<div id="customer2SectionClose" hidden>
    <br>
    <h2>Second Customer</h2>

    <div class="form-row">
        <div class="form-group">
            <label for="closefirstname2">First Name</label>
            <input name="First_Name2" id="closefirstname2" type="text" disabled>
        </div>

        <div class="form-group">
            <label for="closelastname2">Surname</label>
            <input name="Surname2" id="closelastname2" type="text" disabled>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="closeAddress2">Address</label>
            <input name="address2" id="closeAddress2" type="text" disabled>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="closePhone2">Phone Number</label>
            <input name="number2" id="closePhone2" type="text" disabled>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="closeEircode2">Eircode</label>
            <input name="eircode2" id="closeEircode2" type="text" disabled>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="closeDOB2">Date of Birth</label>
            <input name="dob2" id="closeDOB2" type="text" disabled>
        </div>
    </div>
</div>

<br>

<h2>Account Details</h2>

<div class="form-row">
    <div class="form-group">
        <label for="closeAccountID">Account Number</label>
        <input name="account_id" id="closeAccountID" type="text" disabled>
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label for="closeBalance">Balance</label>
        <!-- Disabled field - populated by JavaScript -->
        <input name="balance" id="closeBalance" type="text" disabled>
    </div>
</div>

<!-- Overdraft limit input - editable field when user clicks Amend Details button -->
<div class="form-row">
    <div class="form-group">
        <label for="overdraft">Overdraft Limit</label>
        <!-- This field is initially disabled, but can be enabled by clicking the "Amend Details" button -->
        <!-- The toggleLock() function enables/disables this field based on button state -->
        <input name="overdrawn_limit" id="overdraft" type="number" step="0.01" max="5000" min="0" required>
    </div>
</div>

<br>
		<!-- Submit buttons for amending account or viewing transaction history -->
   <div class="form-row">
        <!-- Submit button to amend account details - triggers amendConfirmCheck() for validation -->
        <button type="submit" formaction="amendCurrentAccount.php" class="myButton" onclick="return amendConfirmCheck();">
            Amend
        </button>
			</div>
		
<!-- Button to view transaction history - navigates to currentAccountHistory.php -->
<div class="form-row">
        <button type="submit" formaction="currentAccountHistory.php" class="myButton" onclick="return viewHistory();" formnovalidate >
			View History
	</button>
</div>
		</form>
    </div>
	

</body>
</html>