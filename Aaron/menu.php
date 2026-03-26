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
                <button class="dropbutton"><a href="home.html.php">Home</a></button>
            </div>
			<div class="dropdown">
            <button class="dropbutton"><a href="#">Main Menu</a></button>
                <div class="dropdown-content">
                    <a href="lodgement.html.php">Lodgements</a>
                    <a href="withdrawal.html.php">Withdrawals</a>
                    <a href="construction.html.php">Customer File Maintenance</a>
                    <a href="construction.html.php">Account Maintenance Menu</a>
                    <a href="construction.html.php">Management Menu</a>
                    <a href="construction.html.php">Quotes</a>
                    <a href="construction.html.php">Reports</a>
                    <a href="construction.html.php">Change Password</a>
                </div>
			</div>
            <div class="dropdown">
                <button class="dropbutton"><a href="#">Customer</a></button>
                <div class="dropdown-content">
                    <a href="customer_Add.html.php">Add Customer</a>
                    <a href="customer_Delete.html.php">Delete Customer</a>
                    <a href="customer_AmendView.html.php">Update Customer Details</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropbutton"><a href="#">Current Account Menu</a></button>
                <div class="dropdown-content">
                    <a href="openCurrentAccount.html.php">Add Current Account</a>
                    <a href="closeCurrentAccount.html.php">Remove Current Account</a>
                    <a href="amendCurrentAccount.html.php">Update Current Account Details</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropbutton"><a href="#">Deposit Account Menu</a></button>
                <div class="dropdown-content">
                    <a href="openDepositAccount.html.php">Add Deposit Account</a>
                    <a href="closeDepositAccount.html.php">Remove Deposit Account</a>
                    <a href="viewDepositAccount.html.php">View Deposit Account Details</a>
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
                    <a href="construction.html.php">Charge Interest on Overdrawn Current Accounts</a>
                    <a href="construction.html.php">Calculate Interest on Deposit Accounts</a>
                    <a href="construction.html.php">Calculate Interest on Current Accounts</a>
                    <a href="construction.html.php">Change Rate of Interest for deposit accounts</a>
                    <a href="construction.html.php">Change Rate of Interest for loan accounts</a>
                    <a href="construction.html.php">Change Rate of Interest for current accounts</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropbutton"><a href="#">Quotes Menus</a></button>
                <div class="dropdown-content">
                    <a href="construction.html.php">Quote Loan Repayments</a>
                    <a href="construction.html.php">Quote Deposit Rates</a>
                    <a href="construction.html.php">Quote Loan Rates</a>
                    <a href="construction.html.php">Quote Current Account Rates</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropbutton"><a href="#">Reports Menu</a></button>
                <div class="dropdown-content">
                    <a href="depositAccountHistory.html.php">Deposit Account History</a>
                    <a href="construction.html.php">Loan Account History</a>
                    <a href="construction.html.php">Current Account History</a>
                    <a href="construction.html.php">Customer Report</a>
                    <a href="construction.html.php">Current Account Interest Report</a>
                    <a href="accountReportSelection.php">Account Report</a>
                </div>
            </div>
        </div>
    </body>
</html>
