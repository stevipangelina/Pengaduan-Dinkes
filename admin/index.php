<?php
session_start();
include "../konek.php";

if(isset($_POST['login'])){
    $user = $_POST['username'];
    $pass = md5($_POST['password']);

    $q = mysqli_query($koneksi,"SELECT * FROM admin WHERE username='$user' AND password='$pass'");
    if(mysqli_num_rows($q) > 0){
        $_SESSION['admin'] = true;
        header("Location: dashboard.php");
        exit;
    }else{
        $error = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Admin</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
  margin:0;
  font-family:'Poppins',sans-serif;
  min-height:100vh;
  background:#0f172a; 
  color:white;
  overflow-x:hidden;
  position:relative;
  display:flex;
  justify-content:center;
  align-items:center;
}

#particles-js{
  position:fixed;
  width:100%;
  height:100%;
  z-index:-1;
}

.login-card{
    border-radius:20px;
    background: linear-gradient(135deg,#1e3a8a,#0ea5e9,#22d3ee);
    background-size: 300% 300%;
    animation:gradientMove 12s ease infinite;
    color:white;
}

@keyframes gradientMove{
  0%{background-position:0% 50%;}
  50%{background-position:100% 50%;}
  100%{background-position:0% 50%;}
}

input.form-control{
    border-radius:10px;
}

button.btn-success{
    background-color:#10b981;
    border-color:#10b981;
}

button.btn-success:hover{
    background-color:#059669;
    border-color:#059669;
}
</style>
</head>
<body>

<div id="particles-js"></div>

<div class="col-md-4">

<div class="card shadow login-card">
<div class="card-body p-4">

<div class="text-center mb-3">
    <img src="../assets/logodinkes.png" width="70">
    <h5 class="mt-2 fw-bold">Admin Dinkes</h5>
</div>

<?php if(isset($error)){ ?>
<div class="alert alert-danger"><?= $error ?></div>
<?php } ?>

<form method="POST">
<div class="mb-3">
<input name="username" class="form-control" placeholder="Username" required>
</div>

<div class="mb-3">
<input name="password" type="password" class="form-control" placeholder="Password" required>
</div>

<button name="login" class="btn btn-success w-100">
Login
</button>
</form>

</div>
</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/particles.js"></script>
<script>
particlesJS("particles-js",{
  particles:{
    number:{value:60},
    color:{value:"#ffffff"},
    shape:{type:"circle"},
    opacity:{value:0.2},
    size:{value:3},
    move:{speed:2}
  }
});
</script>

</body>
</html>