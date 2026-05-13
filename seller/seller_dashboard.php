<!DOCTYPE html>
<html>
<head>
    <title>Seller Dashboard</title>
</head>
<body>

<h2>Add New Product</h2>


<form action="add_product.php" method="POST" enctype="multipart/form-data">

    <input type="text" name="name" placeholder="Product Name" required><br><br>

    <input type="number" name="price" placeholder="Price" required><br><br>

    <input type="file" name="image" required><br><br>

    <textarea name="description" placeholder="Description"></textarea><br><br>

    <select name="category" required>
        <option value="">Select Category</option>
        <option value="handmade">Handmade</option>
        <option value="paintings">Paintings</option>
        <option value="ceramics">Ceramics</option>
        <option value="decor">Decor</option>
    </select><br><br>
<input type="number" name="stock" placeholder="Stock Quantity" required><br><br>
    <button type="submit">Add Product</button>

</form>

</body>
</html>