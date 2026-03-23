<html>
    <!--
        This page will allow the user to amend or view loan account details
        Customer details will be displayed in case of the of multiple customers with the same name
    -->
    <head>
        <link rel="stylesheet" href="style.css">
        <script src="LoanAccountJS.js"></script>
        <title>Loan Account</title>
    </head>

    <body>
        <?php
            include "menu.php";
        ?>
        <div class="displaySelected">
            <form action="amendViewLoans.php" method="POST" onsubmit="return confirmCheckAmend()">
                <h2>Create Account</h2>

                <input type="button" value="Amend Account" id="amendViewbutton" name="amendViewbutton" onclick="toggleLock()" class="customerButton">

                <div class='form-row'>
                    <div class='form-group'>
                        <label for='account'>Account ID</label>
                        <select name='account' id='account' class='selectbox' onclick='populate()'>
                        <?php
                            include "dbcon.php";  // Database connection

                            // SQL query to select all loan accounts that are not marked as deleted
                            // Along with their associated customer details
                            // If the account has a second customer, their details will also be selected, if not the fields will be left blank
                            $sql = "SELECT account.account_id, customer_id_1, customer_id_2, 
                            c1.name AS customer_1_name, 
                            c1.surname AS customer_1_surname,
                            c1.address AS customer_1_address,
                            c1.eircode AS customer_1_eircode,
                            c1.date_of_birth AS customer_1_dob,
                            c1.email AS customer_1_email,
                            c1.phone_number AS customer_1_phone,
                            c1.occupation AS customer_1_occupation,
                            c1.salary AS customer_1_salary,	
                            c2.name AS customer_2_name, 
                            c2.surname AS customer_2_surname,
                            c2.address AS customer_2_address,
                            c2.eircode AS customer_2_eircode,
                            c2.date_of_birth AS customer_2_dob,
                            c2.email AS customer_2_email,
                            c2.phone_number AS customer_2_phone,
                            c2.occupation AS customer_2_occupation,
                            c2.salary AS customer_2_salary,	
                            loan_balance, term, loan_amount, monthly_repayments
                            FROM account 
                            INNER JOIN customers c1 ON account.customer_id_1 = c1.customer_id 
                            LEFT JOIN customers c2 ON account.customer_id_2 = c2.customer_id 
                            INNER JOIN loan_account ON account.account_id = loan_account.account_id
                            WHERE account.account_type = 'Loan' AND account.deleted_flag = 0";

                            if(!$result = mysqli_query($con, $sql))
                            {
                                die("Error in querying the database " . mysqli_error($con));
                            }

                            while($row = mysqli_fetch_array($result))
                            {
                                //Store all the selected rows as variables
                                $id = $row['account_id'];
                                $customer1id = $row['customer_id_1'];
                                $customer1name = $row['customer_1_name'];
                                $customer1surname = $row['customer_1_surname'];
                                $customer1address = $row['customer_1_address'];
                                $customer1eircode = $row['customer_1_eircode'];
                                $customer1dob = $row['customer_1_dob'];
                                $customer1email = $row['customer_1_email'];
                                $customer1phone = $row['customer_1_phone'];
                                $customer1occupation = $row['customer_1_occupation'];
                                $customer1salary = $row['customer_1_salary'];
                                $customer2id = $row['customer_id_2'];
                                $customer2name = $row['customer_2_name'];
                                $customer2surname = $row['customer_2_surname'];
                                $customer2address = $row['customer_2_address'];
                                $customer2eircode = $row['customer_2_eircode'];
                                $customer2dob = $row['customer_2_dob'];
                                $customer2email = $row['customer_2_email'];
                                $customer2phone = $row['customer_2_phone'];
                                $customer2occupation = $row['customer_2_occupation'];
                                $customer2salary = $row['customer_2_salary'];
                                $loan_balance = $row['loan_balance'];
                                $term = $row['term'];
                                $loan_amount = $row['loan_amount'];
                                $monthly_repayments = $row['monthly_repayments'];

                                // If there is no second customer
                                // The fields for the second customer will be left blank
                                if ($customer2id == null) {
                                    $customer2id = "N/A";
                                    $customer2name = "";
                                    $customer2surname = "";
                                    $customer2address = "";
                                    $customer2eircode = "";
                                    $customer2dob = "";
                                    $customer2email = "";
                                    $customer2phone = "";
                                    $customer2occupation = "";
                                    $customer2salary = "";
                                }
                                
                                    $allText = "$id| 
                                    $customer1id| $customer1name| $customer1surname| $customer1address| $customer1eircode| $customer1dob| $customer1email| $customer1phone| $customer1occupation| $customer1salary|
                                    $customer2id| $customer2name| $customer2surname| $customer2address| $customer2eircode| $customer2dob| $customer2email| $customer2phone| $customer2occupation| $customer2salary|
                                    $loan_balance| $term| $loan_amount| $monthly_repayments";
                                echo "<option value='$allText'>$id</option>";
                            }
                        ?>
                        </select>
                    </div>
                </div>

                <br><!-- Details to enter for the loan account -->
                <h2>Account Details</h2>
                <input type="hidden" id="accountid" name="accountid">
                <div class="form-row">
                    <div class="form-group">
                        <label for="customer1">Customer 1</label>
                        <p name='customer1' id='customer1' class="customerInfo"></p>   
                    </div>
                    <div class="form-group">
                        <label for="customer2" font-size="20px">Customer 2</label>
                        <p name='customer2' id='customer2' class="customerInfo"></p>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                    <label for="balance">Loan Taken Out</label>
                    <input name="balance" id="balance" type="number" required disabled/>
                    </div>
                    <div class="form-group">
                    <label for="amountpaid">Current Amount Paid Off</label>
                    <input name="amountpaid" id="amountpaid" type="number" required disabled autofocus/>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                    <label for="term">Term Length</label>
                    <input name="term" id="term" type="number" required title="Please enter the term length in months minimum length is 24 months and maximum is 120 months" max="120" min="24" disabled/>
                    </div>
                    <div class="form-group">
                    <label for="monthlyrepayments">Monthly Repayments</label>
                    <input name="monthlyrepayments" id="monthlyrepayments" type="number" required disabled/>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                    <input type="submit" value="Submit" class="customerButton">
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>
