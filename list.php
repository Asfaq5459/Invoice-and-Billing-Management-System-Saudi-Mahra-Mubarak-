<?php include 'db.php';

$res=$conn->query("SELECT * FROM invoices ORDER BY id DESC");
?>

<link rel="stylesheet" href="style.css">

<h2>All Invoices</h2>

<table>
<tr><th>No</th><th>Date</th><th>Total</th><th>View</th></tr>

<?php while($row=$res->fetch_assoc()){ ?>
<tr>
<td><?php echo $row['invoice_no']; ?></td>
<td><?php echo $row['date']; ?></td>
<td><?php echo $row['total']; ?></td>
<td><a href="invoice.php?id=<?php echo $row['id']; ?>">Open</a></td>
</tr>
<?php } ?>

</table>