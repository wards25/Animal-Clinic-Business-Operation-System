<?php
include('../../connection.php');

// Initialize variables for start and end dates
$start_date = "";
$end_date = "";

// Check if start and end dates are provided in the URL
if(isset($_GET['start_date']) && isset($_GET['end_date'])) {
    // Sanitize the input to prevent SQL injection
    $start_date = $_GET['start_date'];
    $end_date = $_GET['end_date'];

    // Modify the SQL queries to filter by date range
    $sqlAppointment = "
        SELECT 
            DATE(date) AS day,
            COUNT(appointmentNo) AS total_sales,
            SUM(total) AS total_revenue
        FROM 
            appointmenttb
        WHERE 
            status = 'fulfilled' AND
            date BETWEEN '$start_date' AND '$end_date'
        GROUP BY 
            DATE(date)
        ORDER BY 
            day ASC;
    ";

    $sqlOrder = "
        SELECT 
            DATE(orderDate) AS day,
            COUNT(orderNo) AS total_orders,
            SUM(totalprice) AS total_revenue
        FROM 
            ordertb
        WHERE 
            status = 'pickUp' AND
            orderDate BETWEEN '$start_date' AND '$end_date'
        GROUP BY 
            DATE(orderDate)
        ORDER BY 
            day ASC;
    ";
} else {
    // Default SQL queries without date range filtering
    $sqlAppointment = "
        SELECT 
            DATE(date) AS day,
            COUNT(appointmentNo) AS total_sales,
            SUM(total) AS total_revenue
        FROM 
            appointmenttb
        WHERE 
            status = 'fulfilled'
        GROUP BY 
            DATE(date)
        ORDER BY 
            day ASC;
    ";

    $sqlOrder = "
        SELECT 
            DATE(orderDate) AS day,
            COUNT(orderNo) AS total_orders,
            SUM(totalprice) AS total_revenue
        FROM 
            ordertb
        WHERE 
            status = 'pickUp'
        GROUP BY 
            DATE(orderDate)
        ORDER BY 
            day ASC;
    ";
}

$resultAppointment = $con->query($sqlAppointment);

// Initialize arrays to store appointment data
$appointmentDays = [];
$appointmentSales = [];
$appointmentRevenues = [];

if ($resultAppointment->num_rows > 0) {
    while($row = $resultAppointment->fetch_assoc()) {
        $appointmentDays[] = $row["day"];
        $appointmentSales[] = $row["total_sales"];
        $appointmentRevenues[] = $row["total_revenue"];
    }
}

$resultOrder = $con->query($sqlOrder);

// Initialize arrays to store order data
$orderDays = [];
$orderSales = [];
$orderRevenues = [];

if ($resultOrder->num_rows > 0) {
    while($row = $resultOrder->fetch_assoc()) {
        $orderDays[] = $row["day"];
        $orderSales[] = $row["total_orders"];
        $orderRevenues[] = $row["total_revenue"];
    }
}

// Ensure appointment and order arrays have the same length
$maxCount = max(count($appointmentDays), count($orderDays));
$appointmentDays = array_pad($appointmentDays, $maxCount, "");
$appointmentSales = array_pad($appointmentSales, $maxCount, "");
$appointmentRevenues = array_pad($appointmentRevenues, $maxCount, "");
$orderDays = array_pad($orderDays, $maxCount, "");
$orderSales = array_pad($orderSales, $maxCount, "");
$orderRevenues = array_pad($orderRevenues, $maxCount, "");

$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body{
            margin: 50px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        td {
            font-weight: normal;
        }
        tr:nth-child(odd) {
            background-color: #f2f2f2;
        }
        canvas {
            width: 100%;
            height: auto;
        }
        .container-filter{
            border-radius: 20px;
            border: 1px solid #ccc; /* Add border */
        padding: 20px; /* Add padding for better appearance */
        width: 400px;
        }
    </style>
</head>
<body>
    
    <h1 class="text-center">Sales Reports</h1>
    <div class="container-filter">
    <form method="get">
        <label for="start_date">Start Date:</label>
        <input class="form-control" type="date" id="start_date" name="start_date" value="<?php echo $start_date; ?>">

        <label for="end_date">End Date:</label>
        <input class="form-control" type="date" id="end_date" name="end_date" value="<?php echo $end_date; ?>">
        <br>
        <input type="submit" value="Apply" class="btn btn-outline-success">
    </form>
    </div>

    <div style="width: 50%; float: left;">
        <canvas id="appointmentChart"></canvas>
    </div>
    <div style="width: 50%; float: left;">
        <canvas id="orderBarGraph"></canvas>
    </div>

    <h2>Appointment Sales</h2>
    <table>
    <tr>
        <th>Day</th>
        <th>Appointment Sales</th>
        <th>Appointment Revenue</th>
    </tr>
    <?php 
    $totalAppointmentRevenue = 0; 
    for($i = 0; $i < count($appointmentDays); $i++): 
        // Accumulate total appointment revenue
        $totalAppointmentRevenue += intval($appointmentRevenues[$i]);
    ?>
    <tr>
        <td><?php echo $appointmentDays[$i]; ?></td>
        <td><?php echo $appointmentSales[$i]; ?></td>
        <td><?php echo $appointmentRevenues[$i]; ?></td>
    </tr>
    <?php endfor; ?>
    <!-- Table footer with sum of appointment revenue -->
    <tfoot>
        <tr>
            <td colspan="2" style="text-align: right;"><b>Total Appointment Revenue:</b></td>
            <td>₱<?php echo $totalAppointmentRevenue; ?></td>
        </tr>
    </tfoot>
</table>


    <h2>Order Sales</h2>
    <table>
    <tr>
        <th>Day</th>
        <th>Order Sales</th>
        <th>Order Revenue</th>
    </tr>
    <?php 
    $totalOrderRevenue = 0; // Initialize variable to store total order revenue
    for($i = 0; $i < count($orderDays); $i++): 
        // Accumulate total order revenue
        $totalOrderRevenue += intval($orderRevenues[$i]);
    ?>
    <tr>
        <td><?php echo $orderDays[$i]; ?></td>
        <td><?php echo $orderSales[$i]; ?></td>
        <td><?php echo $orderRevenues[$i]; ?></td>
    </tr>
    <?php endfor; ?>
    <!-- Table footer with sum of order revenue -->
    <tfoot>
        <tr>
            <td colspan="2" style="text-align: right;"><b>Total Order Revenue:</b></td>
            <td>₱<?php echo $totalOrderRevenue; ?></td>
        </tr>
    </tfoot>
</table>


    <br>
    <button onclick="printPage()" class="btn btn-primary" style="margin-left: 20px;">print</button>
    <a href="../dashboard.php"><button  class="btn btn-outline-danger" style="margin-left: 5px;">Back</button></a>
    <script>
        // PHP code to populate appointment data
        <?php echo "var appointmentDays = " . json_encode($appointmentDays) . ";"; ?>
        <?php echo "var appointmentSales = " . json_encode($appointmentSales) . ";"; ?>
        <?php echo "var appointmentRevenues = " . json_encode($appointmentRevenues) . ";"; ?>

        // Data for appointment chart
        var appointmentData = {
            labels: appointmentDays,
            datasets: [{
                label: 'Appointments',
                data: appointmentSales,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }, {
                label: 'Appointment Revenue',
                data: appointmentRevenues,
                backgroundColor: 'rgba(255, 206, 86, 0.5)',
                borderColor: 'rgba(255, 206, 86, 1)',
                borderWidth: 1
            }]
        };

        // Options for appointment chart
        var appointmentOptions = {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        };

        // Create appointment chart
        var appointmentChartCanvas = document.getElementById('appointmentChart').getContext('2d');
        var appointmentChart = new Chart(appointmentChartCanvas, {
            type: 'line',
            data: appointmentData,
            options: appointmentOptions
        });

        // PHP code to populate order data
        <?php echo "var orderDays = " . json_encode($orderDays) . ";"; ?>
        <?php echo "var orderSales = " . json_encode($orderSales) . ";"; ?>
        <?php echo "var orderRevenues = " . json_encode($orderRevenues) . ";"; ?>

        // Data for order bar graph
        var orderData = {
            labels: orderDays,
            datasets: [{
                label: 'Orders',
                data: orderSales,
                type: 'line', 
                backgroundColor: 'rgba(255, 99, 132, 0.5)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }, {
                label: 'Order Revenue',
                data: orderRevenues,
                backgroundColor: 'rgba(75, 192, 192, 0.5)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        };

        // Options for order bar graph
        var orderOptions = {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        };

        // Create order bar graph
        var orderBarGraphCanvas = document.getElementById('orderBarGraph').getContext('2d');
        var orderBarGraph = new Chart(orderBarGraphCanvas, {
            type: 'bar',
            data: orderData,
            options: orderOptions
        });

        function printPage(){
            window.print();
            
        }
    </script>
    <!-- Bootstrap and Popper.js scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</body>
</html>
