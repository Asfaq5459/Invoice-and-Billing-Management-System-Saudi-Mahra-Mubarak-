<?php include 'db.php';

$id=$_GET['id'];

$inv=$conn->query("SELECT * FROM invoices WHERE id=$id")->fetch_assoc();
$cust=$conn->query("SELECT * FROM customers WHERE id=".$inv['customer_id'])->fetch_assoc();
$items=$conn->query("SELECT * FROM invoice_items WHERE invoice_id=$id");

$subtotal = $inv['total'] - $inv['vat'];
$after_discount = $subtotal - $inv['discount'];
?>

<!DOCTYPE html>
<html>
<head>
<title>Invoice</title>

<style>

body{
    font-family: Arial;
    background:white;
}

.invoice{
    width:900px;
    margin:auto;
    border:2px solid black;
    padding:10px;
}

.top{
    display:flex;
    justify-content:space-between;
}

.box{
    border:1px solid black;
    border-radius:20px;
    padding:5px 10px;
    margin:3px 0;
}

table{
    width:100%;
    border-collapse:collapse;
    margin-top:10px;
}

th, td{
    border:1px solid black;
    padding:6px;
    text-align:center;
}

.total{
    width:40%;
    float:right;
    margin-top:10px;
}

.total td{
    border:1px solid black;
}

.footer{
    clear:both;
    margin-top:40px;
}

@media print{
    button{
        display:none;
    }
}

</style>

</head>

<body>

<button onclick="window.print()">Print</button>

<div class="invoice">

<div class="top">

<div>
<h3>Mahra Mubarak Al-Qahtani</h3>
<p>Furniture</p>
<p>The Furnish The Apartment, Residential Buildings & Hotel</p>

<p>Mobile: 0500751841 / 0567250805 / 0504252587</p>
<p>VAT No: 300497388600003</p>
<p>CR No: 2050044045</p>
<p>Dammam - Haraj - T.V Market - KSA</p>
</div>
<div style="text-align:center;">
<h3>فاتورة ضريبية</h3>
<p>Tax Invoice</p>
</div>

<div style="text-align:right;">
<h3>مؤسسة مهرة مبارك القحطاني</h3>
<p>للأثاث القحطاني تأثيث الشقق والمباني السكنية والفنادق</p>

<p>٠٥٠٠٧٥١٨٤١ / ٠٥٦٧٢٥٠٨٠٥ / ٠٥٠٤٢٥٢٥٨٧</p>
<p>٣٠٠٤٩٧٣٨٨٦٠ رقم الضريبي</p>
<p>٢٠٥٠٠٤٤٠٤٥ رقم السجل التجاري</p>
<p>الدمام - الحراج - سوق التلفاز - السعودية</p>
</div>


</div>

<hr>

<div class="box">Invoice No: <?php echo $inv['invoice_no']; ?></div>
<div class="box">Date: <?php echo $inv['date']; ?></div>
<div class="box">Customer: <?php echo $cust['name']; ?></div>
<div class="box">Phone: <?php echo $cust['phone']; ?></div>

<table>
<tr>
<th>No</th>
<th>Description</th>
<th>Qty</th>
<th>Price</th>
<th>Total</th>
</tr>

<?php $i=1; while($r=$items->fetch_assoc()){ ?>
<tr>
<td><?php echo $i++; ?></td>
<td><?php echo $r['product_name']; ?></td>
<td><?php echo $r['quantity']; ?></td>
<td><?php echo $r['price']; ?></td>
<td><?php echo $r['total']; ?></td>
</tr>
<?php } ?>

</table>

<table class="total">

<tr>
<td>Total without VAT</td>
<td>صافي المبلغ قبل الضريبة</td>
<td><?php echo number_format($subtotal,2); ?></td>
</tr>

<tr>
<td>Discount</td>
<td>الخصومات</td>
<td><?php echo number_format($inv['discount'],2); ?></td>
</tr>

<tr>
<td>Total After Discount</td>
<td>المجموع بعد الخصم</td>
<td><?php echo number_format($after_discount,2); ?></td>
</tr>

<tr>
<td>VAT 15%</td>
<td>ضريبة 15%</td>
<td><?php echo number_format($inv['vat'],2); ?></td>
</tr>

<tr>
<td><b>Grand Total</b></td>
<td><b>الصافي</b></td>
<td><b><?php echo number_format($inv['total'],2); ?></b></td>
</tr>

</table>

<div class="footer">

<p><b>Bank Name:</b> BANK NCB</p>
<p><b>Account No:</b> 01400017667307</p>
<p><b>IBAN:</b> SA8510000001400017667307</p>

<br>

<p>البضاعة المباعة لا ترد ولا تستبدل</p>
<p>لا يحق للزبون المطالبة بعد شهر</p>

<br>

<div style="display:flex; justify-content:space-between;">
<div>توقيع العميل</div>
<div>توقيع البائع</div>
</div>

</div>

</div>

</div>

</body>
</html>