<html>
    <head>
        <link rel="stylesheet" href="style.css">
        <script src="LoanAccountJS.js"></script>
        <title>Loan Account</title>
    </head>

    <body>
        <div class="navbar">
            <img src="images/logo.png" alt="Where wealth gets wild" class="logo">
            
            <div class="dropdown">
                <button class="dropbutton"><a href="home.html">Home</a></button>
            </div>
            <div class="dropdown">
                <button class="dropbutton"><a href="customer.html">Customer</a></button>
            </div>
            <div class="dropdown">
                <button class="dropbutton"><a href="#">Current Account</a></button>
                <div class="dropdown-content">
                    <a href="#">Add Current Account</a>
                    <a href="#">Remove Current Account</a>
                    <a href="#">Update Current Account Details</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropbutton"><a href="#">Deposit Account</a></button>
                <div class="dropdown-content">
                    <a href="#">Add Deposit Account</a>
                    <a href="#">Remove Deposit Account</a>
                    <a href="#">Update Deposit Account Details</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropbutton"><a href="#">Loan Account</a></button>
            </div>
        </div>
        <div class="container">
            <div class="sidebar">
                <h1>Customer Menu</h1>
                <a href="openLoanAccount.html.php">Add Loan Account</a>
                <a href="#">Delete Customer</a>
                <a href="amendViewLoanAccount.html.php">Update Customer Details</a>
            </div>

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
                            
                            $sql = "SELECT account.account_id, customer_id_1, customer_id_2, 
                            c1.name AS customer_1_name, 
                            c1.surname AS customer_1_surname, 
                            c2.name AS customer_2_name, 
                            c2.surname AS customer_2_surname,
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
                                $id = $row['account_id'];
                                $customer1id = $row['customer_id_1'];
                                $customer1name = $row['customer_1_name'];
                                $customer1surname = $row['customer_1_surname'];
                                $customer2id = $row['customer_id_2'];
                                $customer2name = $row['customer_2_name'];
                                $customer2surname = $row['customer_2_surname'];
                                $loan_balance = $row['loan_balance'];
                                $term = $row['term'];
                                $loan_amount = $row['loan_amount'];
                                $monthly_repayments = $row['monthly_repayments'];

                                if ($customer2id == null) {
                                    $customer2id = "N/A";
                                    $customer2name = "N/A";
                                    $customer2surname = "N/A";
                                }
                                
                                $allText = "$id, $customer1id, $customer1name, $customer1surname, $customer2id, $customer2name, $customer2surname, $loan_balance, $term, $loan_amount, $monthly_repayments";
                                echo "<option value='$allText'>$id</option>";
                            }
                        ?>
                        </select>
                    </div>
                </div>

                <br><!-- Details to enter for the loan account -->
                <h2>Account Details</h2>
                <div class="form-row">
                    <div class="form-group">
                        <label for="customer1">Customer 1</label>
                        <input name='customer1' id='customer1' type='text' disabled/>   
                    </div>
                    <div class="form-group">
                        <label for="customer2">Customer 2</label>
                        <input name='customer2' id='customer2' type='text' disabled/>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                    <label for="balance">Loan Taken Out</label>
                    <input name="balance" id="balance" type="number" required disabled/>
                    </div>
                    <div class="form-group">
                    <label for="amountpaid">Current Amount Paid Off</label>
                    <input name="amountpaid" id="amountpaid" type="number" required disabled/>
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
                    <input type="submit" value="Submit" class="myButton">
                    </div>
                </div>
            </form>
            </div>
        </div>
    </body>
</html>