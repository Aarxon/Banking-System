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
            <form action="loanAccountInsert.php" method="POST" onsubmit="return confirmCheck()">
                <h2>Open Loan Account</h2>

                <!-- Switch to toggle between search options -->
                <div class="search">
                    <label for="customerSearch">Search by Name</label>
                    <label class="searchSwitch">
                        <input type="checkbox" id="customerSearch">
                        <span class="searchSlider"></span>
                    </label>
                    <label for="customerSearch">Search by ID</label>         <!-- 'this' refers to the element that triggered the event -->
                </div>

                <input type="button" value="2 Customers" id="multipleCustomers" name="multipleCustomers" onclick="toggleSelect()" class="customerButton">

                <?php
                    include "dbcon.php";  // Database connection
                    
                    echo "<div class='form-row'>
                    <div class='form-group'>
                    <label for='customer1'>Customer 1</label>
                    <select name='customer1' id='customer1' class='selectbox' onchange='toggleCustomerInfo()' >";

                    $sql = "SELECT * FROM customers";

                    if(!$result = mysqli_query($con, $sql))
                    {
                        die("Error in querying the database " . mysqli_error($con));
                    }

                    while($row = mysqli_fetch_array($result))
                    {
                        $id = $row['customer_id'];
                        $name = $row['name'];
                        $surname = $row['surname'];
                        $address = $row['address'];
                        $eircode = $row['eircode'];
                        $DOB = $row['date_of_birth'];
                        $email = $row['email'];
                        $phone_number = $row['phone_number'];
                        $occupation = $row['occupation'];
                        $salary = $row['salary'];
                        $allText = "ID: $id<br>Name: $name $surname<br>Address: $address<br>Eircode: $eircode<br>Date of Birth: $DOB<br>Email: $email<br>Phone Number: $phone_number<br>Occupation: $occupation<br>Salary: $salary";
                        echo "<option value='$allText'>$id, $name $surname</option>";
                    }
                
                    echo "</select>
                    <p id='customerInfo1'></p>
                    </div>
                    
                    <div class='form-group'>
                    <label for='customer2' class='hideText'>Customer 2</label>
                    <select name='customer2' id='customer2' class='selectbox' hidden onclick='confirmDifferentCustomer()'>";
                
                    mysqli_data_seek($result, 0);   // Reset the result pointer to iterate from the top of the database again
                    while($row = mysqli_fetch_array($result))
                    {
                        $id = $row['customer_id'];
                        $name = $row['name'];
                        $surname = $row['surname'];
                        $address = $row['address'];
                        $eircode = $row['eircode'];
                        $DOB = $row['date_of_birth'];
                        $email = $row['email'];
                        $phone_number = $row['phone_number'];
                        $occupation = $row['occupation'];
                        $salary = $row['salary'];
                        $allText = "ID: $id<br>Name: $name $surname<br>Address: $address<br>Eircode: $eircode<br>Date of Birth: $DOB<br>Email: $email<br>Phone Number: $phone_number<br>Occupation: $occupation<br>Salary: $salary";
                        echo "<option value='$allText'>$id, $name $surname</option>";
                    }
                
                    echo "</select>
                    <p class='hideText' id='customerInfo2'></p>
                    </div>
                    </div>";
                    mysqli_close($con);
                ?>

                <br><!-- Details to enter for the loan account -->
                <h2>Account Details</h2>
                <div class="form-row">
                    <div class="form-group">
                    <label for="balance">Balance On Loan</label>
                    <input name="balance" id="balance" type="number" required title="Please enter the initial balance minimum 5000 euros" min="5000"/>
                    </div>
                    <div class="form-group">
                    <label for="firstdeposit">First Deposit</label>
                    <input name="firstdeposit" id="firstdeposit" type="number" required title="minimum 500 euro initial payment" min="500"/>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                    <label for="term">Term Length</label>
                    <input name="term" id="term" type="number" required title="Please enter the term length in months minimum length is 24 months and maximum is 120 months" max="120" min="24"/>
                    </div>
                </div>
                <div class="form-row">
                    <input type="submit" value="Submit" class="myButton">
                    <input type="reset" value="Clear" class="myButton">
                </div>
            </form>
            </div>
        </div>
    </body>
</html>