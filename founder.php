<?php
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $age = $_POST['age'] ?? '';
    $location = $_POST['location'];

    $query = "SELECT * FROM missing_persons WHERE location = '$location'";

    if (!empty($name)) {
        $query .= " AND name LIKE '%$name%'";
    }
    if (!empty($age)) {
        $query .= " AND age = '$age'";
    }

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        echo json_encode(["status" => "found", "person" => $data]);
    } else {
        echo json_encode(["status" => "not_found"]);
    }
}
$conn->close();
?>
