<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  
  
  <link rel='stylesheet prefetch' href='http://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css'>

      <link rel="stylesheet" href="/EEmobi/resources/css/test/styleAdminLogin.css">

  
</head>

<body>
    <div class="wrapper">
    
    <form class="form-signin" method="POST" action="./admin.php">  
    <input type="hidden" name="submit-form" value="form-admin-login">     
      <h2 class="form-signin-heading">Iniciar sessió</h2>
      <input type="text" class="form-control" name="username" placeholder="Usuari" required="" autofocus="" />
      <input type="password" class="form-control" name="password" placeholder="Contrasenya" required=""/>      
      <?php if($fail): ?>
            <div class="errors">
              <p>El usuario y contraseña son incorrectos.</p>
            </div>
      <?php endif; ?>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>   
    </form>
  </div>
  
  
</body>
</html>
