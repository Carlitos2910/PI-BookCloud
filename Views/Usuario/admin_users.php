<?php

    use Models\User;
    $usuarios = User::getAllUsers();
    
?>

<div class="admin_site">

    <h1 class="titulo_admin"> Gestionar Usuarios</h1>

    <!-- <a href="usuario_create">
        Crear Usuario
    </a> -->

    <?php if(isset($error)):?>
        <b class="alert_red"><?=$error?></b>
    <?php endif;?>

    <table id="myTable" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Email</th>
                <th>Phone</th>
                <!-- <th>Password</th> -->
                <th>Rol</th>
                <th>Admin</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($user = $usuarios->fetch(PDO::FETCH_OBJ)): ?>
            <tr>
                <td><?=$user->id;?></td>
                <td><?=$user->nombre;?></td>
                <td><?=$user->apellidos;?></td>
                <td><?=$user->email;?></td>
                <td><?=$user->phone;?></td>
                <td><?=$user->rol;?></td>
                <td>
                    <a href="<?=$_ENV["BASE_URL"]?>user_delete/<?=$user->id;?>" class="delete">Eliminar</a>
                    <a href="<?=$_ENV["BASE_URL"]?>user_edit/<?=$user->id;?>" class="edit">Editar</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
    
</div>