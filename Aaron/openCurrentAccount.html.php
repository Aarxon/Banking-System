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
        <?php
            include "dbcon.php";
            
            // Get next account ID
            $result = mysqli_query($con, "SELECT MAX(account_id) AS max_id FROM current_account");
            $row = mysqli_fetch_assoc($result);
            $next = ($row['max_id'] ?? 0) + 1;
            
            mysqli_close($con);
            
            echo "<h2>Open Current Account for Account ID: $next</h2>";
        ?>
        <form action="currentAccountInsert.php" method="POST" onsubmit="return confirmCheck()">

         <input type="button" value="2 Customers" id="multipleCustomers" name="multipleCustomers" onclick="toggleSelect()" class="customerButton">
         
        <div class="form-row">
            <div class="form-group">
                <label for="customer1">Select Customer</label>
                <select name="customer1" id="customer1" class="selectbox" onclick="populate()">
                    <option value="">-- Select Customer 1 --</option>
                    <?php
                        // Include database connection
                        include "dbcon.php";
                        
                         // SQL query to fetch all non-deleted customers from the database
                         // Only includes customers that haven't been marked as deleted
                         $sql = "SELECT customer_id, name, surname, address, phone_number, eircode, date_of_birth FROM customers WHERE deleted_flag = 0";

                        if(!$result = mysqli_query($con, $sql))
                        {
                            die("Error in querying the database " . mysqli_error($con));
                        }

                        // Loop through all active customers and create dropdown option elements
                        while($row = mysqli_fetch_array($result))
                        {
                            // Extract individual customer fields from the database row
                            $id = $row['customer_id'];
                            $name = $row['name'];
                            $surname = $row['surname'];
                            $address = $row['address'];
                            $number = $row['phone_number'];
                            $eircode = $row['eircode'];
                            $dob = $row['date_of_birth'];
                            
                            // Create pipe-delimited string with all customer data for JavaScript to parse
                            // Format: id|name|surname|address|phone|eircode|dob|id (extra id at end as placeholder)
                            $allText = "$id|$name|$surname|$address|$number|$eircode|$dob|$id";
                            // Display format in dropdown shows customer ID and name
                            echo "<option value='$allText'>$id, $name $surname</option>";
                        }


                        // Close database connection
                        mysqli_close($con);
                    ?>
                </select>
            </div>
        </div>

            <!-- Second customer dropdown - hidden by default, shown when "2 Customers" button is clicked -->
            <div class="form-row" id="customer2Row">
                <div class="form-group">
                    <!-- Hidden dropdown for second customer selection (joint account) -->
                    <!-- onclick triggers populate2() to auto-fill second customer details -->
                    <select name='customer2' id='customer2' class='selectbox' hidden onclick="populate2()">
                        <label for="customer2">Select Second Customer</label>
                        <option value="">-- Select Customer 2 --</option>
                        <?php
                            // Include database connection
                            include "dbcon.php";

                        // SQL query to fetch all non-deleted customers for second customer selection
                        $sql = "SELECT customer_id, name, surname, address, phone_number, eircode, date_of_birth FROM customers WHERE deleted_flag = 0";

                        if(!$result = mysqli_query($con, $sql))
                        {
                            die("Error in querying the database " . mysqli_error($con));
                        }

                        // Loop through customers and create option elements
                        while($row = mysqli_fetch_array($result))
                        {
                            // Extract customer fields
                            $id = $row['customer_id'];
                            $name = $row['name'];
                            $surname = $row['surname'];
                            $address = $row['address'];
                            $number = $row['phone_number'];
                            $eircode = $row['eircode'];
                            $dob = $row['date_of_birth'];
                            
                            // Create pipe-delimited string with all customer data for JavaScript parsing
                            $allText = "$id|$name|$surname|$address|$number|$eircode|$dob|$id";
                            // Display customer ID and name in dropdown
                            echo "<option value='$allText'>$id, $name $surname</option>";
                        }

                        // Close database connection
                        mysqli_close($con);
                    ?>
                </select>
            </div>
        </div>

<br>
<h2>Account Details For First Customer</h2>

<!-- Display first customer details auto-populated by JavaScript -->
<div class="form-row">
    <div class="form-group">
        <label for="firstname">First Name</label>
        <!-- Disabled field - populated by JavaScript when customer is selected -->
        <input name="First_Name" id="firstname" type="text" required disabled>
    </div>

    <div class="form-group">
        <label for="lastname">Surname</label>
        <!-- Disabled field - populated by JavaScript when customer is selected -->
        <input name="Surname" id="lastname" type="text" required disabled>
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label for="address">Address</label>
        <!-- Disabled field - populated by JavaScript when customer is selected -->
        <input name="address" id="address" type="text" required disabled>
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label for="phone">Phone Number</label>
        <!-- Disabled field - populated by JavaScript when customer is selected -->
        <input name="number" id="phone" type="text" required disabled>
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label for="eircode">Eircode</label>
        <!-- Disabled field - populated by JavaScript when customer is selected -->
        <input name="eircode" id="eircode" type="text" required disabled>
    </div>
</div>

<div class="form-row">
    <div class="form-group">
        <label for="dob">Date of Birth</label>
        <!-- Disabled field - populated by JavaScript when customer is selected -->
        <input name="dob" id="dob" type="text" required disabled>
    </div>
</div>

<div class="form-row">
</div>

<br>

<!-- Second customer details section - hidden by default, shown when "2 Customers" is selected -->
<div id="customer2Details" hidden>
    <h2>Account Details For Second Customer</h2>
    <!-- Display second customer details - auto-populated by JavaScript -->
    <div class="form-row">
        <div class="form-group">
            <label for="firstname2">First Name</label>
            <!-- Disabled field - populated by JavaScript when second customer is selected -->
            <input name="First_Name2" id="firstname2" type="text" required disabled>
        </div>

        <div class="form-group">
            <label for="lastname2">Surname</label>
            <!-- Disabled field - populated by JavaScript when second customer is selected -->
            <input name="Surname2" id="lastname2" type="text" required disabled>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="address2">Address</label>
            <!-- Disabled field - populated by JavaScript when second customer is selected -->
            <input name="address2" id="address2" type="text" required disabled>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="phone2">Phone Number</label>
            <!-- Disabled field - populated by JavaScript when second customer is selected -->
            <input name="number2" id="phone2" type="text" required disabled>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="eircode2">Eircode</label>
            <!-- Disabled field - populated by JavaScript when second customer is selected -->
            <input name="eircode2" id="eircode2" type="text" required disabled>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="dob2">Date of Birth</label>
            <!-- Disabled field - populated by JavaScript when second customer is selected -->
            <input name="dob2" id="dob2" type="text" required disabled>
        </div>
    </div>
</div> <!-- end customer2Details -->

<!-- Account settings section - initial balance and overdraft limit -->
<div class="form-row">
    <div class="form-group">
        <label for="balance">Initial Balance</label>
        <!-- Disabled display field - initial balance defaults to 0 and is sent as hidden input -->
        <input name="balance" id="balance" type="number" step="0.01" value="0" disabled>
        <!-- Hidden input to actually submit the initial balance value (always 0) -->
        <input type="hidden" name="balance" value="0"> 
    </div>

    <div class="form-group">
        <label for="overdrawn_limit">Overdraft Limit</label>
        <!-- Editable field - user enters the overdraft limit for this account (0-5000) -->
        <!-- This is a required field and must be set before account creation -->
        <input name="overdrawn_limit" id="overdrawn_limit" type="number" step="0.01" max="5000" min="0" required>
    </div>
</div>

<!-- Submit button to create the new account -->
<div class="form-row">
    <input type="submit" value="Add Account" class="myButton">
</div>

    </form>
</div>

</body>
</html>