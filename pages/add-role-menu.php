<?php
require_once "config/config.php";

$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$query = mysqli_query($config, "SELECT * FROM levels WHERE id = '$id'");
$rowEdit = mysqli_fetch_assoc($query);

$level_id = $rowEdit['id'];

$queryMenus = mysqli_query($config, "SELECT * FROM menus ORDER BY id DESC");
$rowMenus   = mysqli_fetch_all($queryMenus, MYSQLI_ASSOC);

$selectedMenu  = mysqli_query($config, "SELECT * FROM level_menus WHERE level_id = '$level_id'");
$selectedMenuIds = [];
$rowSelectedMenus = mysqli_fetch_all($selectedMenu, MYSQLI_ASSOC);
foreach ($rowSelectedMenus as $selectedMenus) {
    $selectedMenuIds[] = $selectedMenus['menu_id'];
}

if (isset($_POST['save'])) {
  $level_id = $_POST['level_id'];
  $menu_id  = $_POST['menu_id'];

  mysqli_query($config, "DELETE FROM level_menus WHERE level_id ='$level_id' ");

  foreach ($menu_id as $key => $menu) {
      $insert   = mysqli_query($config, "INSERT INTO level_menus (menu_id, level_id) VALUES ('$menu', '$level_id')");
  }
  header("location:?page=level&tambah=success");
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
        <div class="card-body">
          <h3 class="card-title" ><?php echo isset($_GET['edit']) ? 'Update' : 'Tambah '?> Level</h3>
            <div class="mb-3">
                <form action="" method="post">
                  <label for="" class="form-label">Level Name</label><br>
                  <input type="text" class="form-control w-50" value="<?php echo $rowEdit['name'] ?? '' ?>" readonly>

                  <input type="hidden" name="level_id" value="<?php echo $rowEdit['id'] ?? '' ?>">
            </div>
              <div class="mb-3">
                  <?php foreach ($rowMenus as $menu): ?>
                    <label for="" class="form-label">
                        <input type="checkbox" 
                        name="menu_id[]" 
                        value="<?php echo $menu['id'] ?>"
                        <?php echo in_array($menu['id'], $selectedMenuIds)? 'checked' : '' ?>> <?php echo $menu['name'] ?>
                    </label>
                    <br>
                <?php endforeach ?>
              </div>
              <button type="submit" class="btn btn-primary" name="save">Save Changes</button>
              <a href="?page=level" class="btn btn-secondary">Back</a>
            </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>