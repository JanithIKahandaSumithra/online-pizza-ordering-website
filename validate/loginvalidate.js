
function validateForm(){


  const email=document.getElementById("loginemail").value.trim();
  const pass=document.getElementById("loginPassword").value.trim();

  const existingAlerts = document.querySelectorAll(".alert");
  existingAlerts.forEach(alert => alert.remove());

  if (email === "") {
    // Create a Bootstrap alert dynamically for blank input
    const blankAlertDiv = document.createElement("div");
    blankAlertDiv.classList.add("alert", "alert-danger");
    blankAlertDiv.textContent = "Please enter an email";

    const emailInput = document.getElementById("loginemail");
    emailInput.parentNode.insertBefore(blankAlertDiv, emailInput.nextSibling);

    return false;
  }

  if (email.indexOf("@") === -1 || email.indexOf(".") === -1) {
    // Create a Bootstrap alert dynamically for invalid email format
    const formatAlertDiv = document.createElement("div");
    formatAlertDiv.classList.add("alert", "alert-danger");
    formatAlertDiv.textContent = "Please enter a valid email format";

    const emailInput = document.getElementById("loginemail");
    emailInput.parentNode.insertBefore(formatAlertDiv, emailInput.nextSibling);

    return false;
  }

  if (pass === "") {
    // Create a Bootstrap alert dynamically for blank input
    const blankAlertDiv = document.createElement("div");
    blankAlertDiv.classList.add("alert", "alert-danger");
    blankAlertDiv.textContent = "Please enter password";

    const emailInput = document.getElementById("loginPassword");
    emailInput.parentNode.insertBefore(blankAlertDiv, emailInput.nextSibling);

    return false;
  }



  return true;
}