<?php if(!isset($_SESSION['identity'])): ?>


    <form class="userform" action="<?=$_ENV['BASE_URL']?>user_login" method="POST">

        <h2>Login</h2>
        <span class="line"></span>

        <br>
        <?php if(isset($_SESSION['error_login']) && $_SESSION['error_login'] == 'Identificación Fallida'): ?>
            <b class="alert_red"> Datos Incorrectos Introduce de nuevo los datos. </b>
        <?php endif; ?>
        
        <div class="input-group">

            <label for="email">Email</label>
            <input type="email" name="data[email]" id="email" placeholder="Email" required>
            
            
            <label for="password">Password</label>
            <input type="password" name="data[password]" id="password" placeholder="Password" required>

            <div class="form-txt">
                <a href="term_conditions">T&eacute;rminos y Condiciones</a>
            </div>

            <input type="submit" class="btn" value="Log In">


            <div class="form-txt">
                <a href="<?=$_ENV['BASE_URL']?>user_signin">Registrarse</a>
            </div>


        </div>

    </form>


<?php else: ?>


    <form class="userform">

        <h2>Logueado</h2>
        <span class="line"></span>
        
        <div class="input-group">

            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" placeholder="<?=$_SESSION['identity']->nombre?>" disabled>
            
            <label for="apellidos">Apellidos</label>
            <input type="text" id="apellidos" placeholder="<?=$_SESSION['identity']->apellidos?>" disabled>

            <div class="form-txt">
                <a href="<?=$_ENV['BASE_URL']?>user_logout">Cerrar Sesión</a>
            </div>
            
        </div>

    </form>

<?php endif; ?>