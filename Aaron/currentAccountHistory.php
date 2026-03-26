<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Amend Current Account</title>
</head>
<body>
<script src="aaron.js"></script>
	<?php
		include "menu.php";
	?>
    <div class="displaySelected">
<?php
    include 'dbcon.php';
    
    $account_id = $_POST['account_id'];
    
    // Get account details with customer info
    $sql = "SELECT account.account_id, customer_id_1, customer_id_2,
        c1.name AS customer_1_name,
        c1.surname AS customer_1_surname,
        c1.address AS customer_1_address,
        c1.eircode AS customer_1_eircode,
        c2.name AS customer_2_name,
        c2.surname AS customer_2_surname,
        c2.address AS customer_2_address,
        c2.eircode AS customer_2_eircode,
        current_account.balance
        FROM account
        INNER JOIN current_account ON account.account_id = current_account.account_id
        INNER JOIN customers c1 ON account.customer_id_1 = c1.customer_id
        LEFT JOIN customers c2 ON account.customer_id_2 = c2.customer_id
        WHERE account.account_type = 'Current' AND account.deleted_flag = 0 AND account.account_id = $account_id";

    if (!$result = mysqli_query($con, $sql))
    {
        die("Error in querying the database: " . mysqli_error($con));
    }
    
    $row = mysqli_fetch_array($result);
    
    echo "<div class='displaySelected'>
      <h2>Current Account History</h2>
      <p>Account Number: " . $row['account_id'] . " &nbsp;&nbsp;&nbsp; Customer Name: " . $row['customer_1_name'] . " " . $row['customer_1_surname'] . "</p>";
    
    if ($row['customer_2_name'] != null)
    {
        echo "<p>Second Customer: " . $row['customer_2_name'] . " " . $row['customer_2_surname'] . "</p>";
    }
    
    // Get all transactions
    $sql2 = "SELECT transaction_type, transaction_amount, balance, transaction_date
         FROM transactions
         WHERE account_id = $account_id
         ORDER BY transaction_date DESC";
    
    if (!$result2 = mysqli_query($con, $sql2))
    {
        die("Error in querying the database: " . mysqli_error($con));
    }
    
    echo "<table class = 'reportTable'>
        <tr>
            <th class = 'reportHeadings'>Date</th>
            <th class = 'reportHeadings'>Transaction Type</th>
            <th class = 'reportHeadings'>Transaction Amount</th>
            <th class = 'reportHeadings'>Balance</th>
        </tr>";
    
    while ($row2 = mysqli_fetch_array($result2))
    {
        echo "<tr>
                <td>" . $row2['transaction_date'] . "</td>
                <td>" . $row2['transaction_type'] . "</td>
                <td>" . $row2['transaction_amount'] . "</td>
                <td>" . $row2['balance'] . "</td>
              </tr>";
    }
    
   echo "</table>
      <h3><input type='button' value='Print Statement' onclick='alert(\"Statement Printed\")'></h3>
      </div>";
    
    mysqli_close($con);
?>
</div>
</body>
</html>