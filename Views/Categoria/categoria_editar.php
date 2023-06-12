

<div class="admin_site">

    <h1 class="titulo_admin"> Editar Categoria</h1>

    <a href="<?=$_ENV['BASE_URL']?>admin_categoria">
        Ver Categorias
    </a>

    <form action="<?=$_ENV['BASE_URL']?>categoria_edit" method="POST">
        <?php if(isset($error)) :?>
            <b class="alert_red"><?=$error;?></b>
        <?php endif; ?>

        <label for="Id">Id</label>
        <input type="text" name="data[id]" id="Id" value="<?=$id?>" placeholder="<?=$id?>" readonly>

        <label for="Nombre">Nombre</label>
        <input type="text" name="data[nombre]" id="Nombre" pattern="^[a-zA-Z]+$" title="Ingrese solo letras." placeholder="Nombre" required>

        <label for="descripcion">Descripcion</label>
        <textarea name="data[descripcion]" id="descripcion" rows="5" placeholder="Escriba aqui una breve descipción sobre la Categoria" required></textarea>
        
        <input type="submit" value="Editar">
    </form>

</div>
