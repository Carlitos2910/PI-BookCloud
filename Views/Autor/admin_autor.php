<?php

    use Models\Autor;
    $autores = Autor::getAllAutores();


?>

<div class="admin_site">

    <h1 class="titulo_admin"> Gestionar Autores</h1>

    <a href="autor_create">
        Crear Autor
    </a>


    <?php if(isset($_SESSION['error'])):?>
        <b class="alert_red"><?=$_SESSION['error']?></b>
        <?php unset($_SESSION['error']); ?>
    <?php endif;?>

    <table id="myTable" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Biografia</th>
                <th>Nacionalidad</th>
                <th>Fecha_nacimiento</th>
                <th>Fecha_fallecimiento</th>
                <th>Admin</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($autor = $autores->fetch(PDO::FETCH_OBJ)): ?>
            <tr>
                <td><?=$autor->id;?></td>
                <td><?=$autor->nombre;?></td>
                <td><?=$autor->apellidos;?></td>
                <td class="biografia"><?=$autor->biografia;?></td>
                <td><?=$autor->nacionalidad;?></td>
                <td><?=$autor->fecha_nacimiento;?></td>
                <td><?=$autor->fecha_fallecimiento;?></td>
                <td>
                    <a href="autor_delete/<?=$autor->id;?>" class="delete">Eliminar</a>
                    <a href="autor_edit/<?=$autor->id;?>" class="edit">Editar</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
    
</div>