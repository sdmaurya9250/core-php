<?php
require_once 'connection.php';
$sql = "SELECT s.id, 
               MAX(CASE WHEN sm.meta_key = 'Name' THEN sm.meta_value END) AS name,
               MAX(CASE WHEN sm.meta_key = 'Address' THEN sm.meta_value END) AS address,
               s.email, 
               s.created_date 
        FROM student s 
        LEFT JOIN student_meta sm ON s.id = sm.sid 
        GROUP BY s.id";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // Output data of each row
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Email</th>
                <th>Created Date</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row["id"]."</td>
                <td>".$row["name"]."</td>
                <td>".$row["address"]."</td>
                <td>".$row["email"]."</td>
                <td>".$row["created_date"]."</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
