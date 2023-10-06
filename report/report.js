// Add this code within your <script> section
document.getElementById("downloadButton").addEventListener("click", function () {
    // Get the chart canvas element
    var canvas = document.getElementById("lineChart");

    // Convert the chart to a data URL
    var chartDataURL = canvas.toDataURL("image/png");

    // Create a download link
    var downloadLink = document.createElement("a");
    downloadLink.href = chartDataURL;
    downloadLink.download = "chart.png"; // Set the filename for the downloaded image
    downloadLink.click();
});
