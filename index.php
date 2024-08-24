<?php
  require_once 'config.php';
  $stmt = $pdo->query("SELECT * FROM inventory");
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inventory Management - PHP and HTMX</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://unpkg.com/htmx.org@1.9.2"></script>
</head>
<body>
  <div class="container mt-5">
    <h1 class="mb-4">Inventory Management - PHP and HTMX</h1>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Item Name</th>
          <th>Quantity</th>
          <th>Unit Price</th>
          <th>Supplier</th>
          <th>Expiration Date</th>
          <th>Total Value</th>
        </tr>
      </thead>
        <tbody>
          <?php
          $total_inventory_value = 0;
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {                
            $total_value = $row['quantity'] * $row['unit_price'];
            $total_inventory_value += $total_value;
            echo "<tr>";
            echo "<td><input type='text' name='item_name' value='" . htmlspecialchars($row['item_name']) . "' hx-post='update.php' hx-trigger='change' hx-target='closest tr' hx-swap='outerHTML' hx-include='closest tr'></td>";
            echo "<td><input type='number' name='quantity' value='" . $row['quantity'] . "' hx-post='update.php' hx-trigger='change' hx-target='closest tr' hx-swap='outerHTML' hx-include='closest tr'></td>";
            echo "<td><input type='number' step='0.01' name='unit_price' value='" . $row['unit_price'] . "' hx-post='update.php' hx-trigger='change' hx-target='closest tr' hx-swap='outerHTML' hx-include='closest tr'></td>";
            echo "<td><input type='text' name='supplier' value='" . htmlspecialchars($row['supplier']) . "' hx-post='update.php' hx-trigger='change' hx-target='closest tr' hx-swap='outerHTML' hx-include='closest tr'></td>";
            echo "<td><input type='date' name='expiration_date' value='" . $row['expiration_date'] . "' hx-post='update.php' hx-trigger='change' hx-target='closest tr' hx-swap='outerHTML' hx-include='closest tr'></td>";
            echo "<td>$" . number_format($total_value, 2) . "</td>";
            echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
            echo "</tr>";
          }
          ?>
        </tbody>
        <tfoot>
          <tr>
            <th colspan="5">Total Inventory Value</th>
            <th>$<?php echo number_format($total_inventory_value, 2); ?></th>
          </tr>
        </tfoot>
    </table>
  </div>
</body>
</html>