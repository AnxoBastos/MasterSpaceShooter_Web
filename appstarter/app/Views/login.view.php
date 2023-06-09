<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/main.css"/>
    <script src="https://kit.fontawesome.com/06f7e1b310.js" crossorigin="anonymous"></script>
    <title>Master Space Shooter</title>
</head>
<body>
    <main class="access-main">
        <div class="access-logo"><a href="/">MASTER SPACE SHOOTER</a></div>
        <div class="access-container">
            <form action="/login" method="post" class="login">
                <div class="login-tittle">
                    <p>LOGIN</p>
                </div>
                <div class="inputs">
                    <input type="text" name="email" placeholder="Correo electronico" required>
                    <input type="password" name="password" autocomplete="current-password" placeholder="Contraseña" minlength="8" required>
                    <input type="submit" name="submitLogin" value="Iniciar sesión" required>
                </div>
                <?php if( isset($loginError) ){ ?>
                    <div class="error-container">
                        <span><?php echo $loginError ?></span>
                    </div>
                <?php } ?>
            </form>
            <form action="/register" method="post" class="register">
                <div class="register-tittle">
                    <p>REGISTER</p>
                </div>
                <div class="inputs">
                    <input type="text" name="newUsername" placeholder="Usuario" required>
                    <input type="email" name="newEmail" placeholder="Correo electronico" required>
                    <input type="password" name="newPassword" autocomplete="current-password" placeholder="Contraseña" minlength="8" required>
                    <input type="submit" name="submitRegister" value="Registrarse">
                </div>
                <?php if( isset($registerError) ){ ?>
                    <div class="error-container">
                        <span><?php echo $registerError ?></span>
                    </div>
                <?php } ?>
           </form>
        </div>
    </main>
</body>
</html>