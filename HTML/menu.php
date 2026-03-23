<!--
    This is the menu page 
    It contains all the navbar details and links to other pages
    It is included on all pages to provide a consistent menu across the website
-->

<html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="navbar">
            <img src="images/logo.png" alt="Where wealth gets wild" class="logo">
            
            <div class="dropdown">
                <button class="dropbutton"><a href="home.html">Home</a></button>
            </div>
            <button class="dropbutton"><a href="">Main Menu</a></button>
                <div class="dropdown-content">
                    <a href="#">Lodgements</a>
                    <a href="#">Withdrawals</a>
                    <a href="#">Customer File Maintenance</a>
                    <a href="#">Account Maintenance Menu</a>
                    <a href="#">Management Menu</a>
                    <a href="#">Quotes</a>
                    <a href="#">Reports</a>
                    <a href="#">Change Password</a>
                </div>
            <div class="dropdown">
                <button class="dropbutton"><a href="">Customer</a></button>
                <div class="dropdown-content">
                    <a href="#">Add Customer</a>
                    <a href="#">Delete Customer</a>
                    <a href="#">Update Customer Details</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropbutton"><a href="#">Current Account Menu</a></button>
                <div class="dropdown-content">
                    <a href="#">Add Current Account</a>
                    <a href="#">Remove Current Account</a>
                    <a href="#">Update Current Account Details</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropbutton"><a href="#">Deposit Account Menu</a></button>
                <div class="dropdown-content">
                    <a href="#">Add Deposit Account</a>
                    <a href="#">Remove Deposit Account</a>
                    <a href="#">Update Deposit Account Details</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropbutton"><a href="#">Loan Account Menu</a></button>
                <div class="dropdown-content">
                    <a href="openLoanAccount.html.php">Add Loan Account</a>
                    <a href="deleteLoanAccount.html.php">Remove Loan Account</a>
                    <a href="amendViewLoanAccount.html.php">Update Loan Account Details</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropbutton"><a href="#">Management Menu</a></button>
                <div class="dropdown-content">
                    <a href="#">Charge Interest on Overdrawn Current Accounts</a>
                    <a href="#">Calculate Interest on Deposit Accounts</a>
                    <a href="#">Calculate Interest on Current Accounts</a>
                    <a href="#">Change Rate of Interest for deposit accounts</a>
                    <a href="#">Change Rate of Interest for loan accounts</a>
                    <a href="#">Change Rate of Interest for current accounts</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropbutton"><a href="#">Quotes Menus</a></button>
                <div class="dropdown-content">
                    <a href="#">Quote Loan Repayments</a>
                    <a href="#">Quote Deposit Rates</a>
                    <a href="#">Quote Loan Rates</a>
                    <a href="#">Quote Current Account Rates</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropbutton"><a href="#">Reports Menu</a></button>
                <div class="dropdown-content">
                    <a href="#">Deposit Account History</a>
                    <a href="#">Loan Account History</a>
                    <a href="#">Current Account History</a>
                    <a href="#">Customer Report</a>
                    <a href="#">Current Account Interest Report</a>
                    <a href="accountReportSelection.php">Account Report</a>
                </div>
            </div>
        </div>
    </body>
</html>
