

<div class="admin_site">

    <h1 class="titulo_admin"> Crear Nueva Categoria</h1>

    <a href="<?=$_ENV['BASE_URL']?>admin_categoria">
        Ver Categorias
    </a>

    <form action="<?=$_ENV['BASE_URL']?>categoria_create" method="POST">
        <?php if(isset($error)) :?>
            <b class="alert_red"><?=$error;?></b>
        <?php endif; ?>
        <label for="Nombre">Nombre</label>
        <input type="text" name="data[nombre]" id="Nombre" pattern="^[a-zA-Z]+$" title="Ingrese solo letras." placeholder="Nombre" required>

        <label for="Descripcion">Descripcion</label>
        <textarea name="data[descripcion]" id="Descripcion" rows="5" placeholder="Escriba aqui una breve descripción sobre la Categoria" required></textarea>
        
        <input type="submit" value="Crear">
    </form>

</div>
