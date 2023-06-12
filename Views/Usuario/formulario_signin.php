<?php if(!isset($_SESSION['identity'])): ?>

    <form class="userform" action="<?=$_ENV['BASE_URL']?>user_signin" method="POST">

        <h2>Register</h2>
        <span class="line"></span>

        <br>
        <?php if(isset($_SESSION['register']) && $_SESSION['register'] == 'complete'): ?>
            <b class="alert_green"> Registro Completado, puedes <a href="login">iniciar sesión.</a> </b>
        <?php elseif(isset($_SESSION['register']) && $_SESSION['register'] == 'failed'):?>
            <b class="alert_red"> Registro Fallido, introduce bien los datos.</b>
        <?php endif; ?>
        
        <div class="input-group">

            <label for="name">Nombre</label>
            <input type="text" name="data[nombre]" id="name" placeholder="Name" required>

            <label for="apellidos">Apellidos</label>
            <input type="text" name="data[apellidos]" id="apellidos" placeholder="Apellidos" required>

            <label for="email">Email</label>
            <input type="email" name="data[email]" id="email" placeholder="Email" required>

            <label for="phone">Phone</label>
            <input type="tel" name="data[phone]" id="phone" placeholder="Phone" required>
            
            <label for="password">Password</label>
            <input type="password" name="data[password]" id="password" placeholder="Password" required>

            <div class="form-txt">
                <input  type="checkbox" class="check-box"       required>
                <span>
                    Agree
                    <a href="term_conditions">
                        Terms & conditions
                    </a>
                </span>
            </div>

            <input type="submit" class="btn" value="Sign In">

            <div class="form-txt">
                <a href="<?=$_ENV['BASE_URL']?>user_login">Loguearse</a>
            </div>

        </div>

    </form>

<?php else: ?>

    <h3><?=$_SESSION['identity']->nombre?><?=$_SESSION['identity']->apellidos?></h3>

<?php endif; ?>