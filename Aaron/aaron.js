// Toggles edit mode for overdraft limit field
function toggleLock()
{
    if (document.getElementById("amendViewbutton").textContent == "Amend Details")
    {
        document.getElementById("amendOverdraft").disabled = false;
        document.getElementById("amendViewbutton").textContent = "Lock Details";
    }
    else
    {
        document.getElementById("amendOverdraft").disabled = true;
        document.getElementById("amendViewbutton").textContent = "Amend Details";
    }
}

// Fill first customer details from dropdown selection
function populate()
{
    var sel = document.getElementById("customer1");
    var result = sel.options[sel.selectedIndex].value;
    var details = result.split('|');
	
    document.getElementById("firstname").value = details[1];
    document.getElementById("lastname").value = details[2];
    document.getElementById("address").value = details[3];
    document.getElementById("phone").value = details[4];
    document.getElementById("eircode").value = details[5];
    document.getElementById("dob").value = details[6];
    
    if (document.getElementById("account_id")) {
        document.getElementById("account_id").value = details[0];
    }
}

// Fill second customer details from dropdown selection
function populate2()
{
    var sel = document.getElementById("customer2");
    var result = sel.options[sel.selectedIndex].value;
    var details = result.split('|');
    
    document.getElementById("firstname2").value = details[1];
    document.getElementById("lastname2").value = details[2];
    document.getElementById("address2").value = details[3];
    document.getElementById("phone2").value = details[4];
    document.getElementById("eircode2").value = details[5];
    document.getElementById("dob2").value = details[6];
}

// Validate form and confirm account creation
function confirmCheck()
    {
        var customer1 = document.getElementById("customer1").value;
        var customer2 = document.getElementById("customer2");
        
        if(customer1 === "") {
            alert("Please select a customer for Customer 1.");
            return false;
        }
        
        if (!customer2.hasAttribute("hidden")) {
            const customer1Val = customer1.split('|')[0];
            const customer2Val = customer2.value.split('|')[0];
            
            if(customer2Val === "") {
                alert("Please select a customer for Customer 2.");
                return false;
            }
            if (customer1Val === customer2Val) {
                alert("Customer 1 and Customer 2 cannot be the same.");
                return false;
            }
        }
        
        var response = confirm("Are you sure you want to create this account?");
        if (response) {
            if (customer2.hasAttribute("hidden")) {
                customer2.value = "";
            }
            return true;
        }
        return false;
    }

// Confirm account amendment
function amendConfirmCheck()
{
    var account1 = document.getElementById("account1");
    
    if(!account1 || account1.value === "") {
        alert("Please select an account.");
        return false;
    }
    
    return confirm("Are you sure you want to amend this account?");
}

// Toggle second customer section visibility
function toggleSelect()
{
    var customer2 = document.getElementById("customer2");
    var customer2Details = document.getElementById("customer2Details");
    
    if (customer2.hasAttribute("hidden")) {
        customer2.removeAttribute("hidden");
        customer2Details.removeAttribute("hidden");
        document.getElementById("multipleCustomers").value = "1 Customer";
    } else {
        customer2.setAttribute("hidden", true);
        customer2Details.setAttribute("hidden", true);
        document.getElementById("multipleCustomers").value = "2 Customers";
    }
}

// Load account details for amending
function populateAccount()
{
    var sel = document.getElementById("account1");
    var result = sel.options[sel.selectedIndex].value;
    
    if (result === "") return;
    
    var details = result.split(',');
    
    document.getElementById("amendfirstname").value = details[2];
    document.getElementById("amendlastname").value = details[3];
    document.getElementById("amendAddress").value = details[4];
    document.getElementById("amendPhone").value = details[5];
    document.getElementById("amendEircode").value = details[6];
    document.getElementById("amendDOB").value = details[7];
    
    document.getElementById("account_id").value = details[0];
    document.getElementById("amendAccountID").value = details[0];
    document.getElementById("amendBalance").value = details[15];
    document.getElementById("amendOverdraft").value = details[16];
    
    if (details[8] && details[8] !== "0") {
        document.getElementById("amendfirstname2").value = details[9];
        document.getElementById("amendlastname2").value = details[10];
        document.getElementById("amendAddress2").value = details[11];
        document.getElementById("amendPhone2").value = details[12];
        document.getElementById("amendEircode2").value = details[13];
        document.getElementById("amendDOB2").value = details[14];
        document.getElementById("customer2Section").removeAttribute("hidden");
    } else {
        document.getElementById("customer2Section").setAttribute("hidden", true);
    }
}

// Load account details for closing
function populateAccountClose()
{
    var sel = document.getElementById("account1");
    var result = sel.options[sel.selectedIndex].value;
    
    if (result === "") {
        document.getElementById("account_id").value = "";
        return;
    }
    
    var details = result.split('|');
    
    document.getElementById("account_id").value = details[0];
    document.getElementById("closeAccountID").value = details[0];
    document.getElementById("closeBalance").value = details[15];
    
    document.getElementById("closefirstname").value = details[2];
    document.getElementById("closelastname").value = details[3];
    document.getElementById("closeAddress").value = details[4];
    document.getElementById("closePhone").value = details[5];
    document.getElementById("closeEircode").value = details[6];
    document.getElementById("closeDOB").value = details[7];
    
    if (details[8] && details[8] !== "0") {
        document.getElementById("closefirstname2").value = details[9];
        document.getElementById("closelastname2").value = details[10];
        document.getElementById("closeAddress2").value = details[11];
        document.getElementById("closePhone2").value = details[12];
        document.getElementById("closeEircode2").value = details[13];
        document.getElementById("closeDOB2").value = details[14];
        document.getElementById("customer2SectionClose").removeAttribute("hidden");
    } else {
        document.getElementById("customer2SectionClose").setAttribute("hidden", true);
    }
}

// Validate and confirm account closure
function closeConfirmCheck()
{
    var account1 = document.getElementById("account1");
    var balance = document.getElementById("closeBalance");
    
    if(!account1 || account1.value === "") {
        alert("Please select an account.");
        return false;
    }
    
    if (balance && parseFloat(balance.value) !== 0) {
        alert("Account balance must be zero before closing. Please perform a transaction to balance the account.");
        return false;
    }
    
    return confirm("Are you sure you want to close this account?");
}

// Load account details for withdrawal
function populateAccountWithdrawal()
{
    var sel = document.getElementById("account1");
    var result = sel.options[sel.selectedIndex].value;
    
    if (result === "") {
        document.getElementById("account_id").value = "";
        document.getElementById("current_balance").value = "";
        document.getElementById("overdraft_limit").value = "";
        document.getElementById("account_type").value = "";
        return;
    }
    
    var details = result.split('|');
    
    document.getElementById("account_id").value = details[0];
    document.getElementById("account_type").value = details[17];
    document.getElementById("current_balance").value = details[15];
    document.getElementById("overdraft_limit").value = details[16];
    document.getElementById("wAccountID").value = details[0];
    document.getElementById("wAccountType").value = details[17];
    document.getElementById("wBalance").value = details[15];
    
    document.getElementById("wfirstname").value = details[2];
    document.getElementById("wlastname").value = details[3];
    document.getElementById("wAddress").value = details[4];
    document.getElementById("wPhone").value = details[5];
    document.getElementById("wEircode").value = details[6];
    document.getElementById("wDOB").value = details[7];
    
    if (details[8] && details[8] !== "0") {
        document.getElementById("wfirstname2").value = details[9];
        document.getElementById("wlastname2").value = details[10];
        document.getElementById("wAddress2").value = details[11];
        document.getElementById("wPhone2").value = details[12];
        document.getElementById("wEircode2").value = details[13];
        document.getElementById("wDOB2").value = details[14];
        document.getElementById("customer2SectionWithdrawal").removeAttribute("hidden");
    } else {
        document.getElementById("customer2SectionWithdrawal").setAttribute("hidden", true);
    }
}

// Validate withdrawal and confirm action
function withdrawalConfirmCheck()
{
    var account1 = document.getElementById("account1");
    var withdrawalAmount = document.getElementById("withdrawalAmount");
    var balance = document.getElementById("wBalance");
    var accountType = document.getElementById("wAccountType");
    var overdraftLimit = document.getElementById("overdraft_limit");
    
    if(!account1 || account1.value === "") {
        alert("Please select an account.");
        return false;
    }
    
    if(!withdrawalAmount || withdrawalAmount.value === "" || parseFloat(withdrawalAmount.value) <= 0) {
        alert("Please enter a valid withdrawal amount.");
        return false;
    }
    
    var currentBalance = parseFloat(balance.value);
    var amount = parseFloat(withdrawalAmount.value);
    var availableFunds = currentBalance;
    
    // Current accounts allow overdraft
    if (accountType.value === "Current") {
        availableFunds = currentBalance + parseFloat(overdraftLimit.value);
    }
    
    if (amount > availableFunds) {
        alert("Insufficient funds! Available: €" + availableFunds.toFixed(2));
        return false;
    }
    
    return confirm("Are you sure you want to withdraw €" + amount.toFixed(2) + "?");
}

// Validate account before showing history
function viewHistory()
{
    var account1 = document.getElementById("account1");
    
    if(!account1 || account1.value === "") {
        alert("Please select an account.");
        return false;
    }
}




