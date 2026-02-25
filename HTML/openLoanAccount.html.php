<html>
    <head>
        <link rel="stylesheet" href="style.css">
        <script src="openLoanAccountJS.js"></script>
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
            <a href="openLoanAccount.html">Add Loan Account</a>
            <a href="#">Delete Customer</a>
            <a href="#">Update Customer Details</a>
            </div>

            <div class="displaySelected">
            <form action="loanAccountInsert.php" method="POST" onsubmit="confirmCheck()">
                <h2>Create Account</h2>

                <input type="button" value="2 Customers" id="multipleCustomers" onclick="toggleSelect()" class="customerButton">

                <div class='form-row'>
                    <div class='form-group'>
                    <label for='customer1'>Customer 1</label>
                    <select name='customer1' id='customer1' class='selectbox'>
                        <?php
                            include "dbcon.php";  // Database connection
                            
                            $sql = "SELECT customer_id, name, surname FROM customers";

                            if(!$result = mysqli_query($con, $sql))
                            {
                                die("Error in querying the database " . mysqli_error($con));
                            }

                            while($row = mysqli_fetch_array($result))
                            {
                                $id = $row['customer_id'];
                                $name = $row['name'];
                                $surname = $row['surname'];
                                echo "<option value='$id'>$id, $name $surname</option>";
                            }
                        ?>
                    </select>
                    </div>

                    <div class='form-group'>
                    <label for='customer2' class="hideText">Customer 2</label>
                    <select name='customer2' id='customer2' class='selectbox' hidden onclick="confirmDifferentCustomer()">
                        <?php
                            mysqli_data_seek($result, 0);   // Reset the result pointer to iterate from the top of the database again
                            while($row = mysqli_fetch_array($result))
                            {
                                $id = $row['customer_id'];
                                $name = $row['name'];
                                $surname = $row['surname'];
                                echo "<option value='$id'>$id, $name $surname</option>";
                            }
                            mysqli_close($con);
                        ?>
                    </select>
                    </div>
                </div>

                <br><!-- Details to enter for the loan account -->
                <h2>Account Details</h2>
                <div class="form-row">
                    <div class="form-group">
                    <label for="balance">Balance On Loan</label>
                    <input name="balance" type="number" required title="Please enter the initial balance"/>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                    <label for="term">Term Length</label>
                    <input name="term" type="number" required title="Please enter the term length in months minimum length is 24 months and maximum is 120 months" max="120" min="24"/>
                    </div>
                </div>
                <div class="form-row">
                    <input type="submit" value="Submit" class="myButton">
                </div>
            </form>
            </div>
        </div>
    </body>
</html>