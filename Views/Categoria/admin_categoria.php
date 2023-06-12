<?php

    use Models\Categoria;
    $categorias = Categoria::getAllCategoria();


?>

<div class="admin_site">

    <h1 class="titulo_admin"> Gestionar Categorías</h1>

    <a href="<?=$_ENV['BASE_URL']?>categoria_create">
        Crear Categoria
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
                <th>Descripcion</th>
                <th>Admin</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($cat = $categorias->fetch(PDO::FETCH_OBJ)): ?>
            <tr>
                <td><?=$cat->id;?></td>
                <td><?=$cat->nombre;?></td>
                <td><?=$cat->descripcion;?></td>
                <td>
                    <a href="<?=$_ENV['BASE_URL']?>categoria_delete/<?=$cat->id;?>" class="delete">Eliminar</a>
                    <a href="<?=$_ENV['BASE_URL']?>categoria_edit/<?=$cat->id;?>" class="edit">Editar</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
    
</div>