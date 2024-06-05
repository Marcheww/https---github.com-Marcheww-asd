<?php
require_once "connect.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Úlohy</title>
    <link rel="stylesheet" type="text/css" href="uloha01.css">
</head>
<body>

<?php
echo "<h1>požiadavka 01</h1>";

// Fetch and display all columns from Customers, Orders, and Suppliers
$sql = "SELECT * FROM Customers";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<h2>Customers</h2><table>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        foreach ($row as $column) {
            echo "<td>$column</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}

$sql = "SELECT * FROM Orders";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<h2>Orders</h2><table>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        foreach ($row as $column) {
            echo "<td>$column</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}

$sql = "SELECT * FROM Suppliers";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<h2>Suppliers</h2><table>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        foreach ($row as $column) {
            echo "<td>$column</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}

echo "<h1>požiadavka 02</h1>";

// Fetch and display all customers in alphabetical order by country and name
$sql = "SELECT * FROM Customers ORDER BY Country, CustomerName";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<table>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        foreach ($row as $column) {
            echo "<td>$column</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}

echo "<h1>požiadavka 03</h1>";

// Fetch and display all orders by date
$sql = "SELECT * FROM Orders ORDER BY OrderDate";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<table>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        foreach ($row as $column) {
            echo "<td>$column</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}

echo "<h1>požiadavka 04</h1>";

// Fetch and display the number of orders made in 1995
$sql = "SELECT COUNT(*) as OrderCount FROM Orders WHERE YEAR(OrderDate) = 1995";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "Number of orders made in 1995: " . $row['OrderCount'];
}

echo "<h1>požiadavka 05</h1>";

// Fetch and display all contact names where the person is a manager in alphabetical order
$sql = "SELECT ContactName FROM Employees WHERE Title LIKE '%Manager%' ORDER BY ContactName";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<table>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row['ContactName'] . "</td></tr>";
    }
    echo "</table>";
}

echo "<h1>požiadavka 06</h1>";

// Fetch and display all orders made on September 28, 1995
$sql = "SELECT * FROM Orders WHERE OrderDate = '1995-09-28'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<table>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        foreach ($row as $column) {
            echo "<td>$column</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}

$conn->close();
?>

</body>
</html>
