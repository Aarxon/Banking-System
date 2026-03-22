<html>
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
                include "dbcon.php";
                session_start();

                $customer = $_POST['customer'];
                $startDate = $_POST['startDate'];
                $endDate = $_POST['endDate'];

                // Create an array to store all accounts with the customer as a holder
                $account_ids = [];
                $i = 0;

                echo "<h1>Loan Account Report</h1>";
                echo "<h1>Account Report for Customer: $customer</h1>";

                $sql = "SELECT * FROM customers WHERE customer_id_1 = '$SESSION[customerid]' OR customer_id_2 = '$SESSION[customerid]'";

                if(!$result = mysqli_query($con, $sql))
                {
                    die("An Error in the SQL Query: " . mysqli_error($con));   
                }

                while($row = mysqli_fetch_array($result))
                {
                    $account_ids += $row['account_id'];
                }
               
                while($i < count($account_ids))
                {
                    // SQL query to select all transactions for the selected customer and date range
                    // The query joins the transactions and accounts tables to get the account type for each transaction
                    // this will build muiltiple tables for each account that the customer has
                    $sql = "SELECT t.transaction_id, t.transaction_type, t.amount, t.transaction_date, a.account_id, a.account_type 
                    FROM transactions t
                    INNER JOIN accounts a ON t.account_id = a.account_id
                    WHERE t.account_id = '$account_ids[$i]' 
                    AND t.transaction_date >= '$startDate' 
                    AND t.transaction_date <= '$endDate' 
                    AND (a.account_type = 'Loan' OR a.account_type = 'Current')
                    ORDER BY t.transaction_date ASC";

                    if(!$result = mysqli_query($con, $sql))
                    {
                        die("An Error in the SQL Query: " . mysqli_error($con));   
                    }

                    // Display the transactions in a table
                    echo "<table>";
                    echo "<tr><th>Transaction ID</th><th>Transaction Type</th><th>Amount</th><th>Transaction Date</th></tr>";
                    echo "<tr></tr>";
                    while($row = mysqli_fetch_array($result))
                    {
                        echo "<tr><td>" . $row['transaction_id'] . "</td><td>" . $row['transaction_type'] . "</td><td>" . $row['amount'] . "</td><td>" . $row['transaction_date'] . "</td></tr>";
                    }
                    echo "</table><br><br>";

                    $i++;
                }
                mysqli_close($con);
            ?>
        </div>
    </body>
</html>