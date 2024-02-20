<?php
session_start();

if (isset($_SESSION["signIn"])) {
  header("Location: ../../DashboardAdmin/dashboardAdmin.php");
  exit;
}

require "../../loginSystem/connect.php";

if (isset($_POST["signIn"])) {

  $nama = strtolower($_POST["nama_admin"]);
  $password = $_POST["password"];

  $result = mysqli_query($connect, "SELECT * FROM admin WHERE nama_admin = '$nama' AND password = '$password' ");
  $data = mysqli_fetch_assoc($result);
  if (mysqli_num_rows($result) === 1) {
    if ($data['role'] == 'admin') {
      //SET SESSION 
      $_SESSION["signIn"] = true;
      $_SESSION['role'] = $data['role'];
      $_SESSION["admin"]["nama_admin"] = $nama;
      header("Location: ../../DashboardAdmin/dashboardAdmin.php");
      exit;
    } else {
      $error = true;
    }
  }
  $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
     <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
     <title>Sign In || Admin</title>
    </head>
  <body>
    <br>
    <br>
    <br>
    <br>
    <br>

  <div class="p-3 mb-2 border bg-secondary">
    
  <div class="">
    <div class="">
      <div class="position-absolute top-0 start-50 translate-middle">
        
      </div>
      <h1 class="pt-0  text-center fw-bold">Sign In</h1>
      <hr>
      
    <form action="" method="post" class="row g-80 p-4 needs-validation" novalidate>
    <div class="p-3 mb-2 border bg-warning"></div>
    <label for="validationCustom01" class="form-label"> Silahkan Masukan Nama Lengkap Anda</label>
  <div class="input-group mt-0">
    <span class="input-group-text" id="basic-addon1"><i class=""></i></span>
    <input type="text" class="form-control" name="nama_admin" id="validationCustom01" required>
    <div class="invalid-feedback">
        Masukkan Nama anda!
    </div>
  </div>
  
  <label for="validationCustom02" class="form-label">Silahkan Masukan Password Anda</label>
  <div class="input-group mt-0">
    <span class="input-group-text" id="basic-addon1"><i class=""></i></span>
    <input type="password" class="form-control" id="validationCustom02" name="password" required>
    <div class="invalid-feedback">
        Masukkan Password anda!
    </div>
  </div>
  <div class="col-12">
  <br>
    <button class="btn btn-primary" type="submit" name="signIn">Sign In</button>
    <a class="btn btn-success" href="../link_login.html">Batal</a>
  </div>
</form>
</div>
<?php if(isset($error)) : ?>
    <div class="alert alert-danger mt-2" role="alert">Nama atau Password Salah!</div>
<?php endif; ?>
  </div>
  
  <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }

      form.classList.add('was-validated')
    }, false)
  })
})()
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>