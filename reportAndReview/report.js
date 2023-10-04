var pieChartCanvas = document.getElementById("pieChart").getContext("2d");

// Define the data for the pie chart
var pieChartData = {
    labels: ["Done", "Not Done"],
    datasets: [{
        data: [10   ,6], // Replace with your actual counts
        backgroundColor: ["rgba(75, 192, 192, 0.2)", "rgba(255, 99, 132, 0.2)"],
        borderColor: ["rgba(75, 192, 192, 1)", "rgba(255, 99, 132, 1)"],
        borderWidth: 1
    }]
};

// Create the pie chart
var pieChart = new Chart(pieChartCanvas, {
    type: "pie",
    data: pieChartData
});
pieChart.options.responsive = true




///barchart

var barChartCanvas = document.getElementById("barChart").getContext("2d");

// Define the data for the bar chart
var barChartData = {
    labels: ["Done", "Not Done"],
    datasets: [{
        label: "Total Count",
        data: [totalDoneCount, totalNotDoneCount], // Replace with your actual counts
        backgroundColor: ["rgba(75, 192, 192, 0.2)", "rgba(255, 99, 132, 0.2)"],
        borderColor: ["rgba(75, 192, 192, 1)", "rgba(255, 99, 132, 1)"],
        borderWidth: 1
    }]
};

// Create the bar chart
var barChart = new Chart(barChartCanvas, {
    type: "bar",
    data: barChartData,
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
