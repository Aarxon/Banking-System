<html>
    <!--
        Created by: Ethan Payne (C00309151)
        Date: March 2026
        This page will display the report for the selected customer and date range
        The report will show all transactions for the selected customer
        It will show all accounts excluding deposit accounts for a selected customer
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
                include "dbcon.php";
                date_default_timezone_set('UTC');
                // Get todays date 
                $today = date("Y-m-d");
                // Get the date 6 months ago from todays date
                $sixMonthsAgo = date("Y-m-d", strtotime("-6 months"));

                $customer = $_POST['customer'];
                $startDate = date('Y-m-d', strtotime($_POST['startDate']));
                $endDate = date('Y-m-d', strtotime($_POST['endDate']));

                // Create an array to store all accounts with the customer as a holder
                $account_ids = [];
                $i = 0;

                echo "<h1>Loan Account Report</h1>";
                echo "<h2>Account Report for Customer: $customer</h2>";

                // Select all accounts that are linked to the Posted Customer ID that are not Deposit account and are not marked for deletion
                $sql = "SELECT * FROM account 
                WHERE (customer_id_1 = '$_POST[customerid]' OR customer_id_2 = '$_POST[customerid]') 
                AND deleted_flag = 0 
                AND account_type != 'Deposit'";

                if(!$result = mysqli_query($con, $sql))
                {
                    die("An Error in the SQL Query: " . mysqli_error($con));   
                }

                while($row = mysqli_fetch_array($result))
                {
                    array_push($account_ids, $row['account_id']);
                }
               
                if((!isset($_POST['startDate']) || $_POST['startDate'] == '') && (!isset($_POST['endDate']) || $_POST['endDate'] == ''))
                {
                    // No dates provided - use last 6 months
                    $dateFrom = $sixMonthsAgo;
                    $dateTo = $today;
                }
                else
                {
                    // Dates provided - use selected range
                    $dateFrom = $startDate;
                    $dateTo = $endDate;
                }

                while($i < count($account_ids))
                {
                    $id = $account_ids[$i];
                    echo "<div class='accountReport'>";
                    echo "<h2 class='reportHeadings'>Account ID: " . $id . "</h2>";

                    $sql = "SELECT t.transaction_id, t.transaction_type, t.transaction_amount, t.transaction_date, a.account_id, a.account_type 
                            FROM transactions t
                            INNER JOIN account a ON t.account_id = a.account_id
                            WHERE t.account_id = '$id' 
                            AND t.transaction_date >= '$dateFrom' 
                            AND t.transaction_date <= '$dateTo' 
                            ORDER BY t.transaction_date ASC";

                    if(!$result = mysqli_query($con, $sql))
                    {
                        die("An Error in the SQL Query: " . mysqli_error($con));   
                    }

                    if(mysqli_num_rows($result) == 0)
                    {
                        echo "<p>No transactions found</p><br><br>";
                    }
                    else
                    {
                        echo "<table class='reportTable'>";
                        echo "<tr><th>Transaction ID</th><th>Transaction Type</th><th>Amount</th><th>Transaction Date</th><th>Account Type</th></tr>";
                        while($row = mysqli_fetch_array($result))
                        {
                            echo "<tr>
                                <td>" . $row['transaction_id'] . "</td>
                                <td>" . $row['transaction_type'] . "</td>
                                <td>" . $row['transaction_amount'] . "</td>
                                <td>" . $row['transaction_date'] . "</td>
                                <td>" . $row['account_type'] . "</td>
                            </tr>";
                        }
                        echo "</table>";
                    }
                    $i++;
                    echo "</div><br><br>";
}
                mysqli_close($con);
            ?>
            <!-- A form to return to the amend/view page -->
            <form action="accountReportSelection.php" method="POST">
                <br>
                <div class="form-row">
                    <input type="submit" value="Return to Previous Page" class="customerButton"/>
                </div>
            </form>
        </div>
    </body>
</html>