// Ethan Payne
// C00309151
// JavaScript file for loan accounts

// This validates details, toggles the select box for customer 2
// and prompts the user to confirm wether the form should or shouldnt be submitted 

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

function confirmCheckAmend()
{
    // Give a pop up notification that asks you to confirm the changes you are trying to make after pressing the save changes button
    var response;
    response = confirm("Are you sure you want to update this customer on the database?");

    if (response)
    {
        // If the amendViewbutton is pushed and the value is set to Amend Details
        // Unlock the textboxes so that the values can be changed 
        // Set the button to show the value View Details 
        document.getElementById("customer1").disabled = false;
        document.getElementById("customer2").disabled = false;
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

function populate()
{
    // This populates the textboxes with values from the database
    var sel = document.getElementById("account");
    var result;
    result = sel.options[sel.selectedIndex].value;
    var loanAccountDetails = result.split(',');
    document.getElementById("customer1").value = loanAccountDetails[1].trim() + ", " + loanAccountDetails[2].trim() + " " + loanAccountDetails[3].trim() + "\n" +
																								loanAccountDetails[4].trim() + "\n" + loanAccountDetails[5].trim() + "\n" + loanAccountDetails[6].trim() + "\n" + 
																								loanAccountDetails[7].trim() + "\n" + loanAccountDetails[8].trim() + "\n" + loanAccountDetails[9].trim() + "\n" +
																								loanAccountDetails[10].trim();
    if (loanAccountDetails[11].trim() == "N/A") 
    {
        document.getElementById("customer2").value = loanAccountDetails[11].trim();
    }
    else
    {
        document.getElementById("customer2").value = loanAccountDetails[11].trim() + ", " + loanAccountDetails[12].trim() + " " + loanAccountDetails[13].trim() + "\n" +
																								loanAccountDetails[14].trim() + "\n" + loanAccountDetails[15].trim() + "\n" + loanAccountDetails[16].trim() + "\n" + 
																								loanAccountDetails[17].trim() + "\n" + loanAccountDetails[18].trim() + "\n" + loanAccountDetails[19].trim() + "\n" +	
																								loanAccountDetails[20].trim();

    }
    document.getElementById("balance").value = loanAccountDetails[21].trim();
    document.getElementById("amountpaid").value = loanAccountDetails[22].trim();
    document.getElementById("term").value = loanAccountDetails[23].trim();
    document.getElementById("monthlyrepayments").value = loanAccountDetails[24].trim();
}

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
