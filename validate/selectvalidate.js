function validateForm() {
    var sizeSelect = document.getElementsByName("hidden_price")[0];
    var alertContainer = document.getElementById("alert-container");

    // Clear any existing alerts
    alertContainer.innerHTML = "";

   

    // Check if quantity is a positive number
    var quantity = parseInt(quantityInput.value);
    if (isNaN(quantity) || quantity <= 0) {
        showAlert("Please enter a valid quantity.");
        return false;
    }

    if (quantity > 10) {
        showAlert("Maximum quantity allowed is 5.");
        return false;
    }


    return true;
}

function showAlert(message) {
    var alertContainer = document.getElementById("alert-container");

    var alertDiv = document.createElement("div");
    alertDiv.className = "alert alert-danger alert-dismissible fade show d-flex justify-content-between";
    alertDiv.setAttribute("role", "alert");

    var messageDiv = document.createElement("div");
    messageDiv.innerHTML = message;

    var closeButton = document.createElement("button");
    closeButton.className = "close";
    closeButton.setAttribute("type", "button");
    closeButton.setAttribute("data-dismiss", "alert");
    closeButton.setAttribute("aria-label", "Close");

    var closeIcon = document.createElement("span");
    closeIcon.setAttribute("aria-hidden", "true");
    closeIcon.innerHTML = "&times;";

    closeButton.appendChild(closeIcon);

    alertDiv.appendChild(messageDiv);
    alertDiv.appendChild(closeButton);

    alertContainer.appendChild(alertDiv);
}


  
