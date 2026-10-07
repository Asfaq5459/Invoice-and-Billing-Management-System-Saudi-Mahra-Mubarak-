<?php include 'db.php'; ?>
<link rel="stylesheet" href="style.css">

<div class="container">

<h2>Create Invoice</h2>

<form method="post" action="save_invoice.php">

<input placeholder="Customer Name" name="name" required>
<input placeholder="Phone" name="phone">
<input type="date" name="date" required>

<br><br>

Discount: <input name="discount" value="0">
VAT %: <input name="vat" value="15">

<hr>

<div id="items">
    <div>
        <input placeholder="Product" name="product[]">
        <input placeholder="Qty" name="qty[]">
        <input placeholder="Price" name="price[]">
    </div>
</div>

<br>

<button type="button" onclick="addItem()">➕ Add Product</button>
<button type="submit">💾 Save</button>

</form>

<br>
<a href="list.php">📄 All Invoice</a>

</div>

<script>
function addItem(){
    let div = document.createElement("div");
    div.innerHTML = `
    <input placeholder="Product" name="product[]">
    <input placeholder="Qty" name="qty[]">
    <input placeholder="Price" name="price[]"><br><br>
    `;
    document.getElementById("items").appendChild(div);
}
</script>