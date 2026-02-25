function toggleSelect()
    {
        let element = document.getElementById("customer2");
        // This is used to get the hideText class from the style sheet
        let element2 = document.querySelector(".hideText");

        if (document.getElementById("multipleCustomers").value == "2 Customers") 
        {
            // If the mulipleCustomers button is pressed and the value is 2 Customer
            // Reveal the second dropdown menu 
            // Set the button to show the value 1 Customer 
            element.removeAttribute("hidden");
            document.getElementById("multipleCustomers").value = "1 Customer";
            // Style sheet change .hideText to visible
            element2.style.visibility = "visible";
        } 
        else 
        {
            // If the mulipleCustomers button is pressed and the value is 1 Customer
            // Hide the second dropdown menu
            // Set the button to show the value 2 Customers 
            element.value = ""; // Clear the value
            element.setAttribute("hidden", "hidden");
            document.getElementById("multipleCustomers").value = "2 Customers";
            // Style sheet change .hideText to hidden
            element2.style.visibility = "hidden";
        }
    }
function confirmCheck()
    {
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
            alert("Please select a different customer for Customer 2.");
            document.getElementById("customer2").value = "0"; // Reset the second dropdown to default
            return false;
        }
        else
        {
            return true;
        }
    }