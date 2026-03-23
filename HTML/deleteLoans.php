<html>
    <!--
        Created by: Ethan Payne (C00309151)
        Date: March 2026
        This page will take the information from deleteLoanAccount.html.php and delete the loan account from the database
        The account will not be deleted from the database but will have a deleted flag set to 1 to indicate that it has been deleted
        The user will be informed that the account has been deleted and will have the option to return to the previous page
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

                if($_POST['amountpaid'] != $_POST['balance'])
                {
                    echo "The loan has to be fully paid to delete the account.";
                }
                else
                {
                    // Update the loan account deleted flag by setting it to 1in the database
                    // The account ID is used to identify the loan account to be updated
                    $sql = "UPDATE loan_account SET deleted_flag = 1 WHERE account_id = '$_POST[accountid]'";

                    if(!mysqli_query($con, $sql))
                    {
                        die("An Error in the SQL Query: " . mysqli_error($con));   
                    }

                    // Update the account deleted flag by setting it to 1 in the database
                    // The account ID is used to identify the account to be updated
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
                    <input type="submit" value="Return to Previous Page" class="customerButton"/>
                </div>
            </form>
        </div>
    </body>
</html>