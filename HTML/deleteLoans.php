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

                if($_POST['amountpaid'] != $_POST['balance'])
                {
                    echo "The loan has to be fully paid to delete the account.";
                }
                else
                {
                    $sql = "UPDATE loan_account SET deleted_flag = 1 WHERE account_id = '$_POST[accountid]'";

                    if(!mysqli_query($con, $sql))
                    {
                        die("An Error in the SQL Query: " . mysqli_error($con));   
                    }

                    $sql = "UPDATE account SET deleted_flag = 1 WHERE account_id = '$_POST[accountid]'";

                    if(!mysqli_query($con, $sql))
                    {
                        die("An Error in the SQL Query: " . mysqli_error($con));   
                    }

                    echo "Account has been Deleted!";
                }
                mysqli_close($con);
            ?>

            <!-- A form to return to the delete page -->
            <form action="deleteLoanAccount.html.php" method="POST">
                <br>
                <div class="form-row">
                    <input type="submit" value="Return to Previous Page"/>
                </div>
            </form>
        </div>
    </body>
</html>