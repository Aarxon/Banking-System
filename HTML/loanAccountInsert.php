<html>
    <!--
        This page will take the information from openLoanAccount.html.php and insert the loan account into the database
        The user will be informed that the account has been created and will have the option to return
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
            <?php
                include 'dbcon.php';
                date_default_timezone_set('UTC');

                // Select all loan accounts from the database with the account type 'Loan'
                $sql = "SELECT * FROM account WHERE account_type = 'Loan'";

                $runsql = true;

                if(!$result = mysqli_query($con, $sql))
                {
                    die("Error in querying the database " . mysqli_error($con));
                }

                $customer1post = $_POST['customer1'];
                $customer2post = null;
                if(isset($_POST['customer2']))
                {
                    $customer2post = $_POST['customer2'];
                }

                while(($row = mysqli_fetch_array($result)) && $runsql === true)
                {
                    $customer1 = $row['customer_id_1'];
                    $customer2 = $row['customer_id_2'];

                    if(($customer1 == $customer1post || $customer1 == $customer2post) && ($customer2 == $customer1post || $customer2 == $customer2post))
                    {
                        $runsql = false;
                    }
                    else
                    {
                        $runsql = true;
                    }
                }

                if($runsql === true)
                {
                    // Calculate the monthly repayments and loan amount for the loan account
                    $loan_amount = $_POST['firstdeposit'];
                    $monthly_repayments = ($_POST["balance"] - $loan_amount) / $_POST["term"];
                    
                    // Display the details sent down from the form
                    echo "The details sent down are: <br>";

                    echo "Customer 1 is: " . $_POST['customer1'] . "<br>";
                    if(!isset($_POST['customer2']) || $_POST['customer2'] === "")
                    {
                        // Only one customer has been selected, so we only need to insert one into the database
                        // Create an SQL query to insert details into the database
                        $sql = "INSERT into account (customer_id_1, customer_id_2, account_type, deleted_flag) VALUES ('$_POST[customer1]', null, 'Loan', 0)";
                    }
                    else
                    {
                        // Two customers have been selected, so we need to insert both into the database
                        // Create an SQL query to insert details into the database
                        $sql = "INSERT into account (customer_id_1, customer_id_2, account_type, deleted_flag) VALUES ('$_POST[customer1]', '$_POST[customer2]', 'Loan', 0)";
                        echo "Customer 2 is: " . $_POST['customer2'] . "<br>";
                    }

                    // Run the query and see if it returns a value
                    if (!mysqli_query($con, $sql))
                    {
                        die ("An Error in the SQL Query: " . mysqli_error($con));
                    }

                    //
                    if(!isset($_POST['customer2'])  || $_POST['customer2'] === "")
                    {
                        $sql = "SELECT account_id FROM account WHERE customer_id_1 = '$_POST[customer1]' AND customer_id_2 IS NULL AND account_type = 'Loan' AND deleted_flag = 0";
                    }
                    else
                    {
                        $sql = "SELECT account_id FROM account WHERE customer_id_1 = '$_POST[customer1]' AND customer_id_2 = '$_POST[customer2]' AND account_type = 'Loan' AND deleted_flag = 0";
                    }
                    
                    // Run the query and see if it returns a value
                    if (!mysqli_query($con, $sql))
                    {
                        die ("An Error in the SQL Query: " . mysqli_error($con));
                    }
                    
                    $result = mysqli_query($con, $sql);
                    $row = mysqli_fetch_array($result);
                    $account_id = $row['account_id'];


                    echo "Account ID for new account is: " . $account_id;

                    $sql = "INSERT into loan_account (account_id, loan_balance, term, loan_amount, monthly_repayments, deleted_flag) VALUES ('$account_id', '$_POST[balance]', $_POST[term], '$loan_amount', '$monthly_repayments', 0)";
                    // Run the query and see if it returns a value
                    if (!mysqli_query($con, $sql))
                    {
                        die ("An Error in the SQL Query: " . mysqli_error($con));
                    }

                    $date = date('Y-m-d');

                    $sql = "INSERT INTO transactions (account_id, transaction_type, transaction_amount, balance, transaction_date) VALUES ('$account_id', 'Deposit', $loan_amount, '$loan_amount', '$date')";
                    // Run the query and see if it returns a value
                    if (!mysqli_query($con, $sql))
                    {
                        die ("An Error in the SQL Query: " . mysqli_error($con));
                    }
                }
                else
                {
                    echo "This Account already exists please choose different customers";
                }
                
                mysqli_close($con);
            ?>
                

            <!-- A form to return to the insert page -->
            <form action="openLoanAccount.html.php" method="POST">
                <br>
                <div class="form-row">
                    <input type="submit" value="Return to Insert Page"/>
                </div>
            </form>
        </div>
    </body>
</html>