<?php
require_once "connect.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Úlohy</title>
    <link rel="stylesheet" type="text/css" href="uloha02.css">
</head>
<body>

<h1>požiadavka 01</h1>
<?php
// Fetch and display all orders from 1996 and their customers
$sql = "SELECT Orders.OrderID, Customers.CompanyName FROM Orders 
        JOIN Customers ON Orders.CustomerID = Customers.CustomerID 
        WHERE YEAR(OrderDate) = 1996";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<thead><tr><th>Order ID</th><th>Customer Name</th></tr></thead><tbody>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row['OrderID'] . "</td><td>" . $row['CompanyName'] . "</td></tr>";
    }
    echo "</tbody></table>";
}
?>

<h1>požiadavka 02</h1>
<?php
// Fetch and display the number of employees and customers from each city that has employees
$sql = "SELECT City, COUNT(DISTINCT EmployeeID) as EmployeeCount, 
        (SELECT COUNT(DISTINCT CustomerID) FROM Customers WHERE City = e.City) as CustomerCount 
        FROM Employees e 
        GROUP BY City";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<thead><tr><th>City</th><th>Employee Count</th><th>Customer Count</th></tr></thead><tbody>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row['City'] . "</td><td>" . $row['EmployeeCount'] . "</td><td>" . $row['CustomerCount'] . "</td></tr>";
    }
    echo "</tbody></table>";
}
?>

<h1>požiadavka 03</h1>
<?php
// Fetch and display the number of employees and customers from each city that has customers
$sql = "SELECT City, COUNT(DISTINCT CustomerID) as CustomerCount, 
        (SELECT COUNT(DISTINCT EmployeeID) FROM Employees WHERE City = c.City) as EmployeeCount 
        FROM Customers c 
        GROUP BY City";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<thead><tr><th>City</th><th>Customer Count</th><th>Employee Count</th></tr></thead><tbody>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row['City'] . "</td><td>" . $row['CustomerCount'] . "</td><td>" . $row['EmployeeCount'] . "</td></tr>";
    }
    echo "</tbody></table>";
}
?>

<h1>požiadavka 04</h1>
<?php
// Fetch and display the number of employees and customers from each city
$sql = "SELECT City, 
        (SELECT COUNT(DISTINCT EmployeeID) FROM Employees WHERE City = c.City) as EmployeeCount, 
        COUNT(DISTINCT CustomerID) as CustomerCount 
        FROM Customers c 
        GROUP BY City";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<thead><tr><th>City</th><th>Employee Count</th><th>Customer Count</th></tr></thead><tbody>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row['City'] . "</td><td>" . $row['EmployeeCount'] . "</td><td>" . $row['CustomerCount'] . "</td></tr>";
    }
    echo "</tbody></table>";
}
?>

<h1>požiadavka 05</h1>
<?php
// Fetch and display order IDs and related employee names for orders sent after a specific date
$requiredDate = '1995-01-01';
$sql = "SELECT Orders.OrderID, Employees.FirstName, Employees.LastName FROM Orders 
        JOIN Employees ON Orders.EmployeeID = Employees.EmployeeID 
        WHERE ShippedDate > '$requiredDate'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<thead><tr><th>Order ID</th><th>Employee Name</th></tr></thead><tbody>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row['OrderID'] . "</td><td>" . $row['FirstName'] . " " . $row['LastName'] . "</td></tr>";
    }
    echo "</tbody></table>";
}
?>

<h1>požiadavka 06</h1>
<?php
// Fetch and display total quantity of products ordered where quantity is less than 200
$sql = "SELECT ProductID, SUM(Quantity) as TotalQuantity FROM `Order Details` 
        GROUP BY ProductID HAVING SUM(Quantity) < 200";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<thead><tr><th>Product ID</th><th>Total Quantity</th></tr></thead><tbody>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row['ProductID'] . "</td><td>" . $row['TotalQuantity'] . "</td></tr>";
    }
    echo "</tbody></table>";
}
?>

<h1>požiadavka 07</h1>
<?php
// Fetch and display the total number of orders per customer since December 31, 1994, where total orders are greater than 15
$sql = "SELECT Customers.CustomerID, Customers.CompanyName, COUNT(Orders.OrderID) as TotalOrders FROM Orders 
        JOIN Customers ON Orders.CustomerID = Customers.CustomerID 
        WHERE OrderDate > '1994-12-31' 
        GROUP BY Customers.CustomerID HAVING COUNT(Orders.OrderID) > 15";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<thead><tr><th>Customer ID</th><th>Company Name</th><th>Total Orders</th></tr></thead><tbody>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row['CustomerID'] . "</td><td>" . $row['CompanyName'] . "</td><td>" . $row['TotalOrders'] . "</td></tr>";
    }
    echo "</tbody></table>";
}

$conn->close();
?>

</body>
</html>
