function validateForm() {
  const nameRegex = /^[A-Za-z]+$/;

  const firstName = document.getElementById("firstName").value;
  const middleName = document.getElementById("middleName").value;
  const lastName = document.getElementById("lastName").value;

  if (!nameRegex.test(firstName) || !nameRegex.test(middleName) || !nameRegex.test(lastName)) {
      alert("Invalid name format. Names should contain only letters.");
      return false;
  }

  const email = document.getElementById("email").value;
  const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

  if (!emailRegex.test(email)) {
      alert("Invalid email format.");
      return false;
  }

  const phoneNumber = document.getElementById("phoneNumber").value;
  const phoneRegex = /^9\d{9}$/;

  if (!phoneRegex.test(phoneNumber)) {
      alert("Invalid phone number. It should be 10 digits starting with 9.");
      return false;
  }

  const password = document.getElementById("password").value;

  if (password.length < 6) {
      alert("Password should be at least 6 characters long.");
      return false;
  }

  const confirmPassword = document.getElementById("password1").value;

  if (password !== confirmPassword) {
      alert("Passwords do not match.");
      return false;
  }

  return true;
}
