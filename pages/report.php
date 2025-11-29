  <?php
  $query = mysqli_query($config, "SELECT c.name, `to`.* FROM trans_orders `to` 
  LEFT JOIN customers c ON c.id = to.customer_id 
  ORDER BY to.id DESC");
  $rows = mysqli_fetch_all($query, MYSQLI_ASSOC);

  if (isset($_GET['delete'])) {
    $id   = $_GET['delete'];

    $delete = mysqli_query($config, "DELETE FROM trans_orders WHERE id = $id");
    if ($delete) {
      header("location:?page=order");
    }
  }
  ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  </head>

  <body>
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Data Order</h3>
          </div>
          <div class="card-body">
            <table class="table table-bordered table-striped">
              <tr>
                <th>No</th>
                <th>Name</th>
                <th>Order Code</th>
                <th>Order End Date</th>
                <th>Order Ammount</th>
                <th>Order Tax</th>
                <th>Order Pay</th>
                <th>Order Change</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
              <?php
              foreach ($rows as $key => $value) {
              ?>
                <tr>
                  <td><?php echo $key + 1 ?></td>
                  <td><?php echo $value['name'] ?></td>
                  <td><?php echo $value['order_code'] ?></td>
                  <td><?php echo $value['order_end_date'] ?></td>
                  <td><?php echo $value['order_total'] ?></td>
                  <td><?php echo $value['order_tax'] ?></td>
                  <td><?php echo $value['order_pay'] ?></td>
                  <td><?php echo $value['order_change'] ?></td>
                  <td><?php echo $value['order_status'] ?></td>
                  <td>
                    <a href="?page=tambah-report&edit=<?php echo $value['id'] ?>" class="btn btn-warning btn-sm"> 
                      <i class="bi bi-pencil"></i>
                      Edit</a>
                    <a href="?page=report&delete=<?php echo $value['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin akan menghapus')">
                      <i class="bi bi-trash"></i>
                      Delete</a>
                  </td>


                </tr>
              <?php
              }
              ?>
            </table>
          </div>
        </div>
      </div>
    </div>

  </body>

  </html>