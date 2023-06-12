<?php

    use Models\Libro;
    $libros = Libro::getAllLibros();

?>



<div class="admin_site">

    <h1 class="titulo_admin"> Gestionar Libros </h1>

    <a href="<?=$_ENV['BASE_URL']?>libro_create">
        Crear Libro
    </a>

    <?php if(isset($_SESSION['error'])):?>
        <b class="alert_red"><?=$_SESSION['error']?></b>
        <?php unset($_SESSION['error']); ?>
    <?php endif;?>

    <table id="myTable" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Descripcion</th>
                <th>Stock</th>
                <th>Stock_Reserva</th>
                <th>Categoria_Id</th>
                <th>Autor_Id</th>
                <th>Fecha_Publicacion</th>
                <th>Admin</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($lib = $libros->fetch(PDO::FETCH_OBJ)): ?>
            <tr>
                <td><?=$lib->id;?></td>
                <td><?=$lib->titulo;?></td>
                <td class="descripcion"><?=$lib->descripcion;?></td>
                <td>
                    <?=$lib->stock;?>
                    <a href="<?=$_ENV['BASE_URL']?>libro_sumar_stock/<?=$lib->id;?>" class="stock">+</a>
                    <?php
                        if($lib->stock > 0){
                            echo "<a href='" . $_ENV['BASE_URL'] . "libro_restar_stock/$lib->id' class='stock'>-</a>";
                        }
                    ?>
                </td>
                <td>
                    <?=$lib->stock_reserva;?>
                    <!-- <a href="<?=$_ENV['BASE_URL']?>libro_sumar_stock_reserva/<?=$lib->id;?>" class="stock">+</a>
                    <?php
                        if($lib->stock_reserva > 0){
                            echo "<a href='" . $_ENV['BASE_URL'] . "libro_restar_stock_reserva/$lib->id' class='stock'>-</a>";
                        }
                    ?> -->
                </td>
                <td><?=$lib->categoria_id;?></td>
                <td><?=$lib->autor_id;?></td>
                <td><?=$lib->fecha_publicacion;?></td>
                <td>
                    <a href="<?=$_ENV['BASE_URL']?>libro_delete/<?=$lib->id;?>" class="delete">Eliminar</a>
                    <a href="<?=$_ENV['BASE_URL']?>libro_edit/<?=$lib->id;?>" class="edit">Editar</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>

</div>