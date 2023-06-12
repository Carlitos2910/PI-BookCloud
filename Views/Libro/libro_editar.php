
<?php

    use Models\Autor;
    use Models\Categoria;

    $autores = Autor::getAllAutores();
    $categorias = Categoria::getAllCategoria();

?>


<div class="admin_site">

    <h1 class="titulo_admin"> Editar Libro </h1>

    <a href="<?=$_ENV['BASE_URL']?>admin_libro">
        Ver Libros
    </a>

    <form action="<?=$_ENV['BASE_URL']?>libro_edit" method="POST">
        
        <?php if(isset($error)) :?>
            <b class="alert_red"><?=$error;?></b>
        <?php endif; ?>

        <label for="Id">Id</label>
        <input type="text" name="data[id]" id="Id" value="<?=$id?>" placeholder="<?=$id?>" readonly>

        <label for="Titulo">Titulo</label>
        <input type="text" name="data[titulo]" id="Titulo" pattern="^[a-zA-Z0-9]+$" title="Ingrese solo letras o números" placeholder="Título" required>

        <label for="Descripcion">Descripcion</label>
        <input type="text" name="data[descripcion]" id="Descripcion" pattern="^[a-zA-Z]+$" title="Ingrese solo letras" placeholder="Descripcion" required>

        <label for="Stock">Stock</label>
        <input type="text" name="data[stock]" id="Stock" pattern="^[0-9]+$" title="Ingrese solo numeros" placeholder="Stock" required>

        <label for="StockReserva">Stock Reserva</label>
        <input type="text" name="data[stock_reserva]" id="StockReserva" pattern="^[0-9]+$" title="Ingrese solo numeros" placeholder="Stock_Reserva" required>

        <label for="CategoriaId">Categoria Id</label>
        <select name="data[categoria_id]" id="CategoriaId">
            <?php while ($cat = $categorias->fetch(PDO::FETCH_OBJ)): ?>
                <option value="<?=$cat->id;?>"><?=$cat->id;?>-<?=$cat->nombre;?></option>
            <?php endwhile; ?>
        </select>

        <label for="AutorId">Autor Id</label>
        <select name="data[autor_id]" id="AutorId">
            <?php while ($aut = $autores->fetch(PDO::FETCH_OBJ)): ?>
                <option value="<?=$aut->id;?>"><?=$aut->id;?>-<?=$aut->nombre;?></option>
            <?php endwhile; ?>
        </select>
        

        <label for="FechaPublicacion">Fecha Publicacion</label>
        <input type="date" name="data[fecha_publicacion]" id="FechaPublicacion" placeholder="Ingrese la fecha de publicación" required>


        <input type="submit" value="Editar">

    </form>

</div>