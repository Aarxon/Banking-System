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
            <form action="accountReport.php" method="POST" onsubmit="return confirmCheckReport()">
                <div class="form-row">
                    <label for="customer">Select Customer</label>
                    <select name="customer" id="customer" class="selectBox">
                        <!-- Options will be populated by PHP -->
                        <?php
                            include "dbcon.php";
                            session_start();

                            $sql = "SELECT * FROM customers WHERE deleted_flag = 0";

                            if(!$result = mysqli_query($con, $sql))
                            {
                                die("An Error in the SQL Query: " . mysqli_error($con));   
                            }
                            
                            while($row = mysqli_fetch_array($result))
                            {
                                $id = $row['account_id'];
                                $firstname = $row['firstname'];
                                $lastname = $row['lastname'];
                                $allText = "$id - $firstname $lastname";
                                $_SESSION['customerid'] = $id;
                                echo "<option value='$allText'>Account ID: $id - $firstname $lastname</option>";
                            }

                            mysqli_close($con);
                        ?>
                    </select>
                </div>
                <br>
                <h1>Select A Date Range</h1>
                <div class="form-row">
                    <div class="form-group">
                        <label for="startDate">Select Start Date:</label>
                        <input type="date" name="startDate" id="startDate">
                    </div>
                    <div class="form-group">
                        <label for="endDate">Select End Date:</label>
                        <input type="date" name="endDate" id="endDate">
                    </div>
                </div>
                <div class="form-row">
                    <input type="submit" value="Generate Report"/>
                </div>
            </form>
        </div>
    </body>
</html>