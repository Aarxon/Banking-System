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
                <a href="ammendViewLoanAccount.html.php">Update Customer Details</a>
            </div>

            <div class="displaySelected">
            <?php
                include "dbcon.php";

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
            ?>

            <!-- A form to return to the delete page -->
            <form action="deleteLoanAccount.html.php" method="POST">
                <br>
                <div class="form-row">
                    <input type="submit" value="Return to Previous Page"/>
                </div>
            </form>
            </div>
        </div>
    </body>
</html>