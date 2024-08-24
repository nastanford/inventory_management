<?php
  require_once 'config.php';

  $id = $_POST['id'];
  $item_name = $_POST['item_name'];
  $quantity = $_POST['quantity'];
  $unit_price = $_POST['unit_price'];
  $supplier = $_POST['supplier'];
  $expiration_date = $_POST['expiration_date'];

  $stmt = $pdo->prepare("UPDATE inventory SET item_name = ?, quantity = ?, unit_price = ?, supplier = ?, expiration_date = ? WHERE id = ?");
  $stmt->execute([$item_name, $quantity, $unit_price, $supplier, $expiration_date, $id]);

  $stmt = $pdo->prepare("SELECT * FROM inventory WHERE id = ?");
  $stmt->execute([$id]);
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  $total_value = $row['quantity'] * $row['unit_price'];

  echo "<tr>";
  echo "<td><input type='text' name='item_name' value='" . htmlspecialchars($row['item_name']) . "' hx-post='update.php' hx-trigger='change' hx-target='closest tr' hx-swap='outerHTML' hx-include='closest tr'></td>";
  echo "<td><input type='number' name='quantity' value='" . $row['quantity'] . "' hx-post='update.php' hx-trigger='change' hx-target='closest tr' hx-swap='outerHTML' hx-include='closest tr'></td>";
  echo "<td><input type='number' step='0.01' name='unit_price' value='" . $row['unit_price'] . "' hx-post='update.php' hx-trigger='change' hx-target='closest tr' hx-swap='outerHTML' hx-include='closest tr'></td>";
  echo "<td><input type='text' name='supplier' value='" . htmlspecialchars($row['supplier']) . "' hx-post='update.php' hx-trigger='change' hx-target='closest tr' hx-swap='outerHTML' hx-include='closest tr'></td>";
  echo "<td><input type='date' name='expiration_date' value='" . $row['expiration_date'] . "' hx-post='update.php' hx-trigger='change' hx-target='closest tr' hx-swap='outerHTML' hx-include='closest tr'></td>";
  echo "<td>$" . number_format($total_value, 2) . "</td>";
  echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
  echo "</tr>";