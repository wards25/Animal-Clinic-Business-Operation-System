<?php
require_once('../connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming you have sanitized the input
    $petname = $_POST['petname'];

    // Fetch medical history based on petname
    $sql = "SELECT * FROM petrecordstb WHERE animalid IN (SELECT animalid FROM animaltb WHERE petname = ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $petname);
    $stmt->execute();
    $result = $stmt->get_result();

    // Generate HTML for medical history
    $html = '<div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Weight</th>
                            <th>Vaccine</th>
                            <th>Veterinarian</th>
                        </tr>
                    </thead>
                    <tbody>';
    while ($row = $result->fetch_assoc()) {
        $html .= '<tr>
                    <td>' . $row['date'] . '</td>
                    <td>' . $row['weight'] . '</td>
                    <td>' . $row['vaccine'] . '</td>
                    <td>' . $row['veterinarian'] . '</td>
                </tr>';
    }
    $html .= '</tbody>
            </table>
        </div>';

    // Return HTML response
    echo $html;
}
?>
