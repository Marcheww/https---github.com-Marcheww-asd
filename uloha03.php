<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Úloha 03</title>
    <link rel="stylesheet" href="uloha01.css">
</head>
<body>
    <div class="container">
        <?php
        require_once "connect.php";

        function execute_query($conn, $sql, $header) {
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                echo "Error: " . mysqli_error($conn) . "<br>";
                return;
            }

            echo '<div class="table-container">';
            echo "<h2>$header</h2>";
            if (mysqli_num_rows($result) > 0) {
                echo "<table>";
                echo "<thead><tr>";
                $fields = mysqli_fetch_fields($result);
                foreach ($fields as $field) {
                    echo "<th>" . $field->name . "</th>";
                }
                echo "</tr></thead><tbody>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    foreach ($row as $value) {
                        echo "<td>" . $value . "</td>";
                    }
                    echo "</tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "<p>No results found.</p>";
            }
            echo '</div>';
        }

        echo "<h1>požiadavka 01</h1>";
        $sql = "SELECT SUM(UnitPrice * Quantity) AS TotalRevenueFrom1997 FROM `order details` od 
                JOIN orders o ON od.OrderID = o.OrderID 
                WHERE YEAR(o.OrderDate) = 1997";
        execute_query($conn, $sql, "Celkové príjmy v roku 1997: ");

        echo "<h1>požiadavka 02</h1>";
        $sql = "SELECT CustomerID, SUM(UnitPrice * Quantity) AS TotalPaid FROM `order details` od 
                JOIN orders o ON od.OrderID = o.OrderID 
                GROUP BY CustomerID";
        execute_query($conn, $sql, "Celková suma, ktorú nám doteraz každý zákazník zaplatil");

        echo "<h1>požiadavka 03</h1>";
        $sql = "SELECT p.ProductName, SUM(od.Quantity) AS TotalSold FROM `order details` od 
                JOIN products p ON od.ProductID = p.ProductID 
                GROUP BY p.ProductID 
                ORDER BY TotalSold DESC 
                LIMIT 10";
        execute_query($conn, $sql, "10 najpredávanejších produktov");

        echo "<h1>požiadavka 04</h1>";
        $sql = "SELECT c.CustomerID, c.CompanyName, SUM(od.UnitPrice * od.Quantity) AS TotalRevenue FROM `order details` od 
                JOIN orders o ON od.OrderID = o.OrderID 
                JOIN customers c ON o.CustomerID = c.CustomerID 
                GROUP BY c.CustomerID";
        execute_query($conn, $sql, "Celkové výnosy na zákazníka");

        echo "<h1>požiadavka 05</h1>";
        $sql = "SELECT c.CustomerID, c.CompanyName, SUM(od.UnitPrice * od.Quantity) AS TotalPaid FROM `order details` od 
                JOIN orders o ON od.OrderID = o.OrderID 
                JOIN customers c ON o.CustomerID = c.CustomerID 
                WHERE c.Country = 'UK' 
                GROUP BY c.CustomerID 
                HAVING TotalPaid > 1000 
                LIMIT 6";
        execute_query($conn, $sql, "Zákazníci zo Spojeného kráľovstva, ktorí zaplatili viac ako 1 000 dolárov");

        echo "<h1>požiadavka 06</h1>";
        $sql = "SELECT c.CustomerID, c.CompanyName, c.Country, 
                SUM(od.UnitPrice * od.Quantity) AS TotalPaid, 
                SUM(CASE WHEN YEAR(o.OrderDate) = 1997 THEN od.UnitPrice * od.Quantity ELSE 0 END) AS Paid1997 
                FROM `order details` od 
                JOIN orders o ON od.OrderID = o.OrderID 
                JOIN customers c ON o.CustomerID = c.CustomerID 
                GROUP BY c.CustomerID";
        execute_query($conn, $sql, "Celkové a ročné platby zákazníkov (rok 1997)");

        echo "<h1>požiadavka 07</h1>";
        $sql = "SELECT COUNT(DISTINCT CustomerID) AS TotalCustomers FROM orders";
        execute_query($conn, $sql, "Celkový počet zákazníkov zo všetkých objednávok");

        echo "<h1>požiadavka 08</h1>";
        $sql = "SELECT COUNT(DISTINCT CustomerID) AS TotalCustomers1997 FROM orders WHERE YEAR(OrderDate) = 1997";
        execute_query($conn, $sql, "Celkový počet zákazníkov z objednávok v roku 1997");

        mysqli_close($conn);
        ?>
    </div>
</body>
</html>