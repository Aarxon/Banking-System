<html>
    <!--
        This page will take in the information to display reports for the selected customer and date range
        The user will select a customer and a date range and then click on the generate report button
        It will pass on to the accountReport.php page where the report will be generated
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
            <form action="accountReport.php" method="POST" onsubmit="return confirmCheckReport()">
                <div class="form-row">
                    <h2>Select Customer</h2>
                    <select name="customer" id="customer" class="selectBox">
                        <!-- Options will be populated by PHP -->
                        <?php
                            include "dbcon.php";

                            $sql = "SELECT customer_id, name, surname FROM customers WHERE deleted_flag = 0";

                            if(!$result = mysqli_query($con, $sql))
                            {
                                die("An Error in the SQL Query: " . mysqli_error($con));   
                            }
                            
                            while($row = mysqli_fetch_array($result))
                            {
                                $id = $row['customer_id'];
                                $firstname = $row['name'];
                                $lastname = $row['surname'];
                                $allText = "$id, $firstname, $lastname";
                                echo "<option value='$allText'>$id - $firstname $lastname</option>";
                            }
                            
                        ?>
                    </select>
                    <input type="hidden" id="customerid" name="customerid">
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