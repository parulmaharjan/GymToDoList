// Add this code to your main.js file

document.getElementById("generate").addEventListener("click", function (event) {
    event.preventDefault(); // Prevent the default form submission

    // Make an AJAX request to fetch data from the server
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "fetch_data.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);

            // Process and display the fetched data as checkboxes
            var todoList = document.getElementById("todo-list");
            todoList.innerHTML = ""; // Clear the previous data

            response.forEach(function (item) {
                var checkbox = document.createElement("input");
                checkbox.type = "checkbox";
                checkbox.name = "packages[]"; // Use an array for checkbox names
                checkbox.value = item.packageName; // Assuming there's a "packageName" column

                var label = document.createElement("label");
                label.appendChild(checkbox);
                label.appendChild(document.createTextNode(item.packageName));

                var listItem = document.createElement("li");
                listItem.appendChild(label);

                todoList.appendChild(listItem);
            });
        }
    };
    xhr.send();
});

function redirectToReportPage() {
    window.location.href = "../report/report.html";
  }
function logoutPage(){
   window.location.href ="../logout/logout.php"
}
function displayTodaysDate() {
    const currentDate = new Date();
    
    // Option 1: Display date in the format "MM/DD/YYYY"
    const formattedDate1 = `${currentDate.getMonth() + 1}/${currentDate.getDate()}/${currentDate.getFullYear()}`;
    console.log("Option 1:", formattedDate1);}
    displayTodaysDate();

    