<html>
    <head>
        <link rel="stylesheet" href="style.css">
        <title>Home</title>
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
            <form action="loanAccountInsert.php" method="POST">
            <h2>Create Account</h2>
            <?php
                include "dbcon.php";  // Database connection
                
                $sql = "SELECT customer_id, name, surname FROM customers";

                if(!$result = mysqli_query($con, $sql))
                {
                    die("Error in querying the database " . mysqli_error($con));
                }

                echo "<div class='form-row'>";
                echo "<div class='form-group'>";
                echo "<label for='customer1'>Customer 1</label>";
                echo "<select name='customer1' id='customer1' class='selectbox'>";

                while($row = mysqli_fetch_array($result))
                {
                    $id = $row['customer_id'];
                    $name = $row['name'];
                    $surname = $row['surname'];
                    echo "<option value='$id'>$id, $name $surname</option>";
                }
                echo "</select>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label for='customer2'>Customer 2</label>";
                echo "<select name='customer2' id='customer2' class='selectbox'>";

                mysqli_data_seek($result, 0);   // Reset the result pointer to iterate from the top of the database again
                while($row = mysqli_fetch_array($result))
                {
                    $id = $row['customer_id'];
                    $name = $row['name'];
                    $surname = $row['surname'];
                    echo "<option value='$id'>$id, $name $surname</option>";
                }
                echo "</select>";
                echo "</div>";
                echo "</div>";
                mysqli_close($con);
            ?>

            <br>
            <h2>Account Details</h2>
            <div class="form-row">
                <div class="form-group">
                <label for="balance">Balance On Loan</label>
                <input id="balance" type="text">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                <label for="amount">Loan Amount</label>
                <input id="amount" type="text">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                <label for="term">Term Length</label>
                <input id="term" type="text">
                </div>
                <div class="form-group">
                <label for="repayments">Monthly Repayments</label>
                <input id="repayments" type="text">
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