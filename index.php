<?php
  ob_start();
  require_once('includes/load.php');
  if($session->isUserLoggedIn(true)) { redirect('home.php', false);}   ///comprueba si ya esta una session activa en caso de que si redirige a home
?>
<?php include_once('layouts/header.php'); ?>
<!DOCTYPE html>
<html lang="es" >

<head>
  <meta charset="UTF-8">
  <title>SCI</title>
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Raleway:300,600" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>

      <link rel="stylesheet" href="css/style.css">
<link rel="icon" type="image/png" href="logo_sobre.png"/>
  
</head>

<body>

<div class="login-page">
  
<div class="container">
   <section id="formHolder">

      <div class="row">

         <!-- Brand Box -->
         <div class="col-sm-6 brand">
        <a href="http://envipaq.com.mx/" class="logo"> <img src="uploads/logo_rojo.png" width="150">
      </a>

            <div class="heading">
               <h2>envipaq</h2>
               <p>SISTEMA DE CONTROL INTERNO.</p>
            </div>

            <div class="success-msg">
               <!--<p>¡Estupendo! Eres uno de nuestros miembros ahora.</p>
               <a href="#" class="profile">Mi perfil</a>-->
            </div>
         </div>


         <!-- Form Box -->
         <div class="col-sm-6 form">

            <!-- Login Form -->
            <div class="login form-peice switched">
            
           <form class="signup-form" action="#" method="post">

                  <div class="form-group">
                     <label for="name">Nombre completo</label>
                     <input type="text" name="username" id="name" class="name">
                     <span class="error"></span>
                  </div>

                  <div class="form-group">
                     <label for="email">Correo electrónico</label>
                     <input type="email" name="emailAdress" id="email" class="email">
                     <span class="error"></span>
                  </div>

                  <div class="form-group">
                     <label for="phone">Número de teléfono - <small>Opcional</small></label>
                     <input type="text" name="phone" id="phone">
                  </div>

                  <div class="form-group">
                     <label for="password">Contraseña</label>
                     <input type="password" name="password" id="password" class="pass">
                     <span class="error"></span>
                  </div>

                  <div class="form-group">
                     <label for="passwordCon">Confirmar contraseña</label>
                     <input type="password" name="passwordCon" id="passwordCon" class="passConfirm">
                     <span class="error"></span>
                  </div>

                  <div class="CTA">
                     <a href="#" class="switch">Tengo Una Cuenta</a>
                   <!--<input type="submit" value="Registrarse" id="submit">
                   --> 
                    </div>
               </form>
            </div><!-- End Login Form -->


            <!-- Signup Form -->
            <div class="signup form-peice">
               <form method="post" action="auth.php" class="login-form" >
                  <div class="form-group">
                     <!--<label for="loginemail">Correo Electrónico</label>
                     <input type="email" name="loginemail" id="loginemail" required>
                     -->
                     <label for="username">Usuario</label>
              <input type="name"  name="username" id="name" required>
                     
                  </div>

                  <div class="form-group">
                     <label for="Password">Contraseña</label>
                     <input type="password" name="password" id="loginPassword" required>
                  </div>

                  <div class="CTA">
                     <!--<a href="#" class="switch">Solicitud de Alta.</a>
                     &nbsp;&nbsp;-->   <input type="submit" class="btn-block" value="iniciar sesión">
                     
                  </div>
               </form>
					<?php echo display_msg($msg);
				
				
				
				?>
             </div><!-- End Signup Form -->
         </div>
      </div>

   </section>



</div>
</div>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
    <script  src="js/index.js"></script>




</body>

</html>
<?php include_once('layouts/footer.php'); ?>