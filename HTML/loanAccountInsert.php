<?php
    include 'dbcon.php';

    // Display the details sent down from the form
    echo "The details sent down are: <br>";

    echo "Customer 1 is: " . $_POST['customer1'] . "<br>";
    echo "Customer 2 is: " . $_POST['customer2'] . "<br>";
    

    // Create an SQL query to insert details into the database
    $sql = "INSERT into account (customer_id_1, customer_id_2, account_type) VALUES ('$_POST[customer1]', '$_POST[customer2]', 'Loan')";

    // Run the query and see if it returns a value
    if (!mysqli_query($con, $sql))
    {
        die ("An Error in the SQL Query: " . mysqli_error($con));
    }

    $sql = "SELECT account_id FROM account WHERE customer_id_1 = '$_POST[customer1]' AND customer_id_2 = '$_POST[customer2]' AND account_type = 'Loan'";
    
    if (!mysqli_query($con, $sql))
    {
        die ("An Error in the SQL Query: " . mysqli_error($con));
    }
    else
    {
        $account_id = $row['account_id'];
    }

    echo "Account ID for new account is: " . $account_id;
    mysqli_close($con);
?>


<!-- A form to return to the insert page -->
<form action="insert3.html" method="POST">
    <br>
    <input type="submit" value="Return to Insert Page"/>
</form>
