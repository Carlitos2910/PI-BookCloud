

<div class="admin_site">

    <h1 class="titulo_admin"> Editar Usuario</h1>

    <a href="<?=$_ENV['BASE_URL']?>admin_users">
        Ver Usuarios
    </a>

    <form action="<?=$_ENV['BASE_URL']?>user_edit" method="POST">
        <?php if(isset($error)) :?>
            <b class="alert_red"><?=$error;?></b>
        <?php endif; ?>

        <label for="Id">Id</label>
        <input type="text" name="data[id]" id="Id" value="<?=$id?>" placeholder="<?=$id?>" readonly>

        <label for="Nombre">Nombre</label>
        <input type="text" name="data[nombre]" id="Nombre" pattern="^[a-zA-Z0-9]+$" title="Ingrese solo letras." placeholder="Nombre" required>
        
        <label for="Apellidos">Apellidos</label>
        <input type="text" name="data[apellidos]" id="Apellidos" pattern="^[a-zA-Z0-9]+$" title="Ingrese solo letras." placeholder="Apellidos" required>

        <label for="Email">Email</label>
        <input type="email" name="data[email]" id="Email" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" title="" placeholder="Email" required>

        <label for="Phone">Phone</label>
        <input type="tel" name="data[phone]" id="Phone" pattern="^[6789]\d{8}$" title="Tel: [6,7,8,9] + {8 numeros}" placeholder="Phone" required>

        <label for="Rol">Rol</label>
        <select name="data[rol]" id="Rol" required>
            <option value="user" selected>User</option>
            <option value="admin">Admin</option>
        </select>
        
        <input type="submit" value="Editar">
    </form>

</div>