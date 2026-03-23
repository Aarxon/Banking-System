// Ethan Payne
// C00309151
// JavaScript file for loan accounts

// This function is used to toggle the second customer dropdown menu when the multiple customers button is pressed
// If the button value is 2 Customers, the second dropdown menu will be revealed and the button value will change to 1 Customer
// If the button value is 1 Customer, the second dropdown menu will be hidden and the button value will change to 2 Customers
function toggleSelect()
{
    let element = document.getElementById("customer2");

    if (document.getElementById("multipleCustomers").value == "2 Customers") 
    {
        // If the mulipleCustomers button is pressed and the value is 2 Customer
        // Reveal the second dropdown menu 
        // Set the button to show the value 1 Customer 
        element.removeAttribute("hidden");
        document.getElementById("multipleCustomers").value = "1 Customer";
        // Style sheet change .hideText to visible
        // Im using a query selector to select all elements with the class hideText and set their visibility to visible
        for (const element2 of document.querySelectorAll('.hideText')) 
        {
            element2.style.visibility = "visible";
        }
    } 
    else 
    {
        // If the mulipleCustomers button is pressed and the value is 1 Customer
        // Hide the second dropdown menu
        // Set the button to show the value 2 Customers 
        element.value = ""; // Clear the value
        element.setAttribute("hidden", "hidden");
        document.getElementById("multipleCustomers").value = "2 Customers";
        document.getElementById("customerInfo2").innerHTML = "";
        // Style sheet change .hideText to hidden
        // Im using a query selector to select all elements with the class hideText and set their visibility to hidden
        for (const element2 of document.querySelectorAll('.hideText')) 
        {
            element2.style.visibility = "hidden";
        }
    }
}

// This function is used to ensure that the user wants to add an account to the database
// If the user clicks ok, the form is submitted, if the user clicks cancel, the form is not submitted
// If the user clicks ok, the function confirmDifferentCustomer() is called to ensure that the same customer is not selected in both dropdown menus
// If the same customer is selected in both dropdown menus, an error message is displayed and the form is not submitted
function confirmCheck()
{
    confirmDifferentCustomer();
    // Give a pop up notification that asks you to confirm the changes you are trying to make after pressing the save changes button
    var response;
    response = confirm("Are you sure you want to add this to the database?");

    if (response)
    {
        var customer2 = document.getElementById("customer2");
        // If the second customer dropdown is hidden, clear its value before submitting the form
        if (customer2.hasAttribute("hidden")) 
        {
            customer2.value = ""; // Clear the value if it's hidden
            customer2.removeAttribute("hidden"); // Remove the hidden attribute to ensure it gets submitted
        }
        return true;
    }
    else
    {
        return false;
    }
}

// This function is used to confirm that the same customer is not selected in both dropdown menus when the form is submitted
// If the same customer is selected in both dropdown menus, an error message is displayed and the form is not submitted
function confirmDifferentCustomer()
{
    const customer1 = document.getElementById("customer1").value;
    const customer2 = document.getElementById("customer2").value;

    if (customer1 === customer2) {
        // Error message for if the customers are the same
        alert("Please select a different customer for Customer 2.");
        document.getElementById("customer2").value = ""; // Reset the second dropdown to default
        document.getElementById("customerInfo2").innerHTML = ""; // Clear the customer info for customer 2
        return false;
    }
    else
    {
        return true;
    }
}

// This function is used to toggle the textboxes for the loan account details when the amend/view button is pressed
// If the textboxes are disabled, they will be enabled and the button value will change to View Account
// If the textboxes are enabled, they will be disabled and the button value will change to Amend Account
function toggleLock()
{
    if(document.getElementById("amendViewbutton").value == "Amend Account")
    {
        // If the amendViewbutton is pushed and the value is set to Amend Details
        // Unlock the textboxes so that the values can be changed 
        // Set the button to show the value View Details 
        document.getElementById("amountpaid").disabled = false;
        document.getElementById("term").disabled = false;
        document.getElementById("monthlyrepayments").disabled = false;
        document.getElementById("amendViewbutton").value = "View Account";
    }
    else
    {
        // If the amendViewbutton is pushed and the value is set to View Details
        // Lock the textboxes so that the values can not be changed 
        // Set the button to show the value Amend Details 
        document.getElementById("amountpaid").disabled = true;
        document.getElementById("term").disabled = true;
        document.getElementById("monthlyrepayments").disabled = true;
        document.getElementById("amendViewbutton").value = "Amend Account";
    }
}

// This function is used to condfirm the changes made to a loan account
// the textboxes are enabled so that the values can be passed when the form is submitted
// If the user cancels the changes, the textboxes are populated with the original values from the database
// This is to ensure that the values are not lost when the user cancels the changes
function confirmCheckAmend()
{
    // Give a pop up notification that asks you to confirm the changes you are trying to make after pressing the save changes button
    var response;
    response = confirm("Are you sure you want to update this customer on the database?");

    if (response)
    {
        // Unlock the textboxes so that the values can be changed 
        document.getElementById("balance").disabled = false;
        document.getElementById("amountpaid").disabled = false;
        document.getElementById("term").disabled = false;
        document.getElementById("monthlyrepayments").disabled = false;
        return true;
    }
    else
    {
        populate();
        return false;
    }
}

// This function is used to populate the textboxes with values from the database when a customer is selected from the dropdown menu
// The values are stored in the value attribute of the option element in the dropdown menu
function populate()
{
    // This populates the textboxes with values from the database
    var sel = document.getElementById("account");
    var result;
    result = sel.options[sel.selectedIndex].value;
    var loanAccountDetails = result.split(',');
    document.getElementById("customer1").textContent = loanAccountDetails[1].trim() + ", " + loanAccountDetails[2].trim() + " " + loanAccountDetails[3].trim() + "\n" +
                                                loanAccountDetails[4].trim() + "\n" + loanAccountDetails[5].trim() + "\n" + loanAccountDetails[6].trim() + "\n" + 
                                                loanAccountDetails[7].trim() + "\n" + loanAccountDetails[8].trim() + "\n" + loanAccountDetails[9].trim() + "\n" +
                                                loanAccountDetails[10].trim();
    // If the value of customer 2 is N/A, display N/A in the customer 2 field, otherwise display the customer 2 details in the customer 2 field
    if (loanAccountDetails[11].trim() == "N/A") 
    {
        document.getElementById("customer2").textContent = loanAccountDetails[11].trim();
    }
    else
    {
        document.getElementById("customer2").textContent = loanAccountDetails[11].trim() + ", " + loanAccountDetails[12].trim() + " " + loanAccountDetails[13].trim() + "\n" +
                                                    loanAccountDetails[14].trim() + "\n" + loanAccountDetails[15].trim() + "\n" + loanAccountDetails[16].trim() + "\n" + 
                                                    loanAccountDetails[17].trim() + "\n" + loanAccountDetails[18].trim() + "\n" + loanAccountDetails[19].trim() + "\n" +
                                                    loanAccountDetails[20].trim();

    }
    document.getElementById("balance").value = loanAccountDetails[21].trim();
    document.getElementById("term").value = loanAccountDetails[22].trim();
    document.getElementById("amountpaid").value = loanAccountDetails[23].trim();
    document.getElementById("monthlyrepayments").value = loanAccountDetails[24].trim();
    document.getElementById("accountid").value = loanAccountDetails[0];
}

// This function is used to toggle the customer info when a customer is selected from the dropdown menu
// The customer info is displayed in the p field below the dropdown menu
// The customer info is stored in the data-info attribute of the option element in the dropdown menu
// I used AI to gain an understanding of how to use the data-info attribute to store the customer info 
// and display it in the p field when a customer is selected from the dropdown menu
function toggleCustomerInfo()
{
    // Use of AI in this section to display populated data in the p field
    const select1 = document.getElementById('customer1');
    const select2 = document.getElementById('customer2');
    const info1 = document.getElementById('customerInfo1');
    const info2 = document.getElementById('customerInfo2');

    const selectedOption1 = select1.options[select1.selectedIndex];
    if (selectedOption1 && selectedOption1.value !== '') 
    {
        info1.innerHTML = selectedOption1.getAttribute('data-info');
    }

    const selectedOption2 = select2.options[select2.selectedIndex];
    if (selectedOption2 && selectedOption2.value !== '') 
    {
        info2.innerHTML = selectedOption2.getAttribute('data-info');
    }
}

// This function is used to condfirm the deletion of a loan account 
// the textboxes are enabled so that the values can be passed when the form is submitted
// If the user cancels the deletion, the textboxes are populated with the original values from the database
// This is to ensure that the values are not lost when the user cancels the deletion
function confirmCheckDelete()
{
    // Give a pop up notification that asks you to confirm the changes you are trying to make after pressing the save changes button
    var response;
    response = confirm("Are you sure you want to delete this customer from the database?");

    if (response)
    {
        // Unlock the textboxes so that the values can be changed 
        document.getElementById("balance").disabled = false;
        document.getElementById("amountpaid").disabled = false;
        document.getElementById("term").disabled = false;
        document.getElementById("monthlyrepayments").disabled = false;
        return true;
    }
    else
    {
        populate();
        return false;
    }
}

// This function is used to confirm that the user wants to generate a report for the loan accounts
// If the user enters a starting date that is after the ending date, an error message is displayed and the form is not submitted
function confirmCheckReport()
{
    // Give a pop up notification that asks you to confirm that you want to generate the report
    var response;
    response = confirm("Are you sure you want to generate this report?");

    if (response)
    {
        // Get the starting date and ending date from the textboxes
        const startDate = document.getElementById("startDate").value;
        const endDate = document.getElementById("endDate").value;
        // Get the current date
        var today = new Date();
    
        // Store the customer id as a session variable
        var sel = document.getElementById("customer");
        var result;
        result = sel.options[sel.selectedIndex].value;
        var customerDetails = result.split(',');

        var customerid = customerDetails[0].trim();
        document.getElementById("customerid").value = customerid;
        
        
        // Compare the dates
        if (startDate > endDate) 
        {
            alert("Error: Starting date cannot be after the ending date.");
            // Reset the starting date to an empty string so that the user can enter a new date
            document.getElementById("startDate").value = "";
            return false;
        }
        else if (endDate > today)
        {
            alert("Error: Ending date cannot be in the future.");
            // Reset the ending date to an empty string so that the user can enter a new date
            document.getElementById("endDate").value = "";
            return false;
        }
        else
        {
            return true;    
        }
    }
    else
    {
        return false;
    }
}