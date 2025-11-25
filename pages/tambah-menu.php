<?php
require_once "config/config.php";

$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$selectMenu = mysqli_query($config, "SELECT * FROM menus WHERE id = '$id'");
$menu = mysqli_fetch_assoc($selectMenu);

if (isset($_POST['simpan'])) {
  $name   = $_POST['name'];
  $link   = $_POST['link'];
  $icon   = $_POST['icon'];
  $order   = $_POST['order'];
  $insert = mysqli_query($config, "INSERT INTO menus (name, icon, link) VALUES ('$name', '$icon', '$link')");

  header("location:?page=menu");
}
if (isset($_POST['update'])) {
  $name   = $_POST['name'];
  $link   = $_POST['link'];
  $icon   = $_POST['icon'];
  $orders   = $_POST['orders'];
  $insert = mysqli_query($config, "UPDATE menus SET name='$name', icon='$icon', link='$link', orders='$orders' WHERE id = '$id'" );

  header("location:?page=menu");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=
  , initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title" ><?php echo isset($_GET['edit']) ? 'Update' : 'Tambah '?> Menu</h3>
          <div class="card-body">
            <form action="" method="post">
              <label for="" class="form-label">Menu Name</label><br>
              <input placeholder="Isi nama Menu" type="text" class="form-control w-50 mb-2" name="name" value="<?php echo $menu['name'] ?? '' ?>" required>
              <label for="" class="form-label">Icon</label><br>
              <input placeholder="Isi Icon" type="text" class="form-control w-50 mb-2" name="icon" value="<?php echo $menu['icon'] ?? '' ?>" required>
              <label for="" class="form-label">Link</label><br>
              <input placeholder="Isi Link" type="text" class="form-control w-50 mb-2" name="link" value="<?php echo $menu['link'] ?? '' ?>" required>
              <label for="" class="form-label">Order</label><br>
              <input placeholder="Isi nama Order" type="text" class="form-control w-50 mb-2" name="orders" value="<?php echo $menu['orders'] ?? '' ?>" required>
              <button class="btn btn-primary" type="submit" name="<?php echo isset($_GET['edit']) ? 'update' : 'simpan' ?>"><?php echo isset($_GET['edit']) ? 'Edit' : 'Create' ?></button>
              <a href="?page=menu" class="btn btn-secondary">Back</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>