<?php
include 'db.php';

$name=$_POST['name'];
$phone=$_POST['phone'];
$date=$_POST['date'];
$discount=(float)$_POST['discount'];
$vat_percent=(float)$_POST['vat'];

$conn->query("INSERT INTO customers(name,phone) VALUES('$name','$phone')");
$cid=$conn->insert_id;

$invoice_no="INV".time();

$conn->query("INSERT INTO invoices(invoice_no,customer_id,date,total,discount,vat)
VALUES('$invoice_no','$cid','$date',0,'$discount',0)");

$iid=$conn->insert_id;

$subtotal=0;

for($i=0;$i<count($_POST['product']);$i++){
    $p=$_POST['product'][$i];
    $q=(int)$_POST['qty'][$i];
    $pr=(float)$_POST['price'][$i];

    $t=$q*$pr;
    $subtotal += $t;

    $conn->query("INSERT INTO invoice_items(invoice_id,product_name,quantity,price,total)
    VALUES('$iid','$p','$q','$pr','$t')");
}

$after_discount = $subtotal - $discount;
$vat_amount = ($after_discount * $vat_percent)/100;
$grand_total = $after_discount + $vat_amount;

$conn->query("UPDATE invoices SET total='$grand_total', vat='$vat_amount' WHERE id='$iid'");

header("Location: invoice.php?id=$iid");