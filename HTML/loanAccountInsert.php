<?php
    include 'dbcon.php';

    // Calculate the monthly repayments and loan amount for the loan account
    $monthly_repayments = $_POST["balance"] / $_POST["term"];
    $loan_amount = 0;

    // Display the details sent down from the form
    echo "The details sent down are: <br>";

    echo "Customer 1 is: " . $_POST['customer1'] . "<br>";
    if(!isset($_POST['customer2']) || $_POST['customer2'] === "")
    {
        // Only one customer has been selected, so we only need to insert one into the database
        // Create an SQL query to insert details into the database
        $sql = "INSERT into account (customer_id_1,  account_type) VALUES ('$_POST[customer1]', 'Loan')";
    }
    else
    {
        // Two customers have been selected, so we need to insert both into the database
        // Create an SQL query to insert details into the database
        $sql = "INSERT into account (customer_id_1, customer_id_2, account_type) VALUES ('$_POST[customer1]', '$_POST[customer2]', 'Loan')";
        echo "Customer 2 is: " . $_POST['customer2'] . "<br>";
    }

    // Run the query and see if it returns a value
    if (!mysqli_query($con, $sql))
    {
        die ("An Error in the SQL Query: " . mysqli_error($con));
    }

    if(isset($_POST['customer2'])  === "")
    {
        $sql = "SELECT account_id FROM account WHERE customer_id_1 = '$_POST[customer1]' AND customer_id_2 = '' AND account_type = 'Loan'";
    }
    else
    {
        $sql = "SELECT account_id FROM account WHERE customer_id_1 = '$_POST[customer1]' AND customer_id_2 = '$_POST[customer2]' AND account_type = 'Loan'";
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

    $sql = "INSERT into loan_account (account_id, loan_balance, term, loan_amount, monthly_repayments) VALUES ('$account_id', '$_POST[balance]', $_POST[term], '$loan_amount', '$monthly_repayments')";
    // Run the query and see if it returns a value
    if (!mysqli_query($con, $sql))
    {
        die ("An Error in the SQL Query: " . mysqli_error($con));
    }
    mysqli_close($con);
?>


<!-- A form to return to the insert page -->
<form action="openLoanAccount.html.php" method="POST">
    <br>
    <input type="submit" value="Return to Insert Page"/>
</form>
