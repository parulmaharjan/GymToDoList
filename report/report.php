
<?php
session_start();
require_once("../database/config.php"); 
  
    $conn = new mysqli(host, user, password, db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    
 
if (isset($_POST['ShowReport'])) {
    $username = $_POST['userName'];
    $query = "SELECT day, total, done FROM logbook WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    $days = [];
    $totalData = [];
    $doneData = [];

    while ($row = $result->fetch_assoc()) {
        $days[] = $row['day'];
        $totalData[] = $row['total'];
        $doneData[] = $row['done'];
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="report.css"> 
    <title>your Report</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div style="width: 90%; margin-top: 200px;">
        <canvas id="lineChart"></canvas>
    </div>
   </br></br></br> <center>
        <form method="POST">
            <label>Username :</label>
            <input type="text" name="userName"><br><br><br>
            <input type="Submit" name="ShowReport" value="Show Report">

        
    </center>
    <button id="downloadButton">Download Chart</button>
    <br><br><textarea rows="10" cols="50" name="review" id="review">
        Say Something about how you feel?
    </textarea>
    <input type="Submit" name="SubmitButton" value="Submit"> </form>

     <script>
        function lineChart(days, totalData, doneData) {
            var data = {
                labels: days,
                datasets: [
                    {
                        label: "Total",
                        data: totalData,
                        borderColor: "rgba(0, 0, 255, 1)", // Blue color
                        borderWidth: 2,
                        fill: false,
                    },
                    {
                        label: "Done",
                        data: doneData,
                        borderColor: "rgba(255, 0, 0, 1)", // Red color
                        borderWidth: 2,
                        fill: false,
                    },
                ],
            };

            // Configuration options
            var options = {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        beginAtZero: true,
                    },
                    y: {
                        beginAtZero: true,
                    },
                },
            };

            // Get the canvas element and render the chart
            var ctx = document.getElementById("lineChart").getContext("2d");
            var lineChart = new Chart(ctx, {
                type: "line",
                data: data,
                options: options,
            });
        }

        // Call the lineChart function with the fetched data
        <?php
        if (isset($days) && isset($totalData) && isset($doneData)) {
            echo "lineChart(" . json_encode($days) . ", " . json_encode($totalData) . ", " . json_encode($doneData) . ");";
        }
        ?>

        // Add download functionality
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
    </script>
    </script>

    
</body>
</html>
    