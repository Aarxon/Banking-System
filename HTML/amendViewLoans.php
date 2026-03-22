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

                $sql = "UPDATE loan_account SET loan_balance = '$_POST[balance]', term = '$_POST[term]', loan_amount = '$_POST[amountpaid]', monthly_repayments = '$_POST[monthlyrepayments]' WHERE account_id = '$_POST[accountid]'";

                if(!mysqli_query($con, $sql))
                {
                    die("An Error in the SQL Query: " . mysqli_error($con));   
                }

                echo "Account has been changed!";
            ?>

            <!-- A form to return to the amend/view page -->
            <form action="amendViewLoanAccount.html.php" method="POST">
                <br>
                <div class="form-row">
                    <input type="submit" value="Return to Previous Page"/>
                </div>
            </form>
        </div>
    </body>
</html>