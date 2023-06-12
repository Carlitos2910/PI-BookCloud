

<div class="admin_site">

    <h1 class="titulo_admin"> Editar Categoria</h1>

    <a href="<?=$_ENV['BASE_URL']?>admin_autor">
        Ver Categorias
    </a>

    <form action="<?=$_ENV['BASE_URL']?>autor_edit" method="POST">
        <?php if(isset($_SESSION['error'])):?>
            <b class="alert_red"><?=$_SESSION['error']?></b>
            <?php unset($_SESSION['error']); ?>
        <?php endif;?>

        <label for="Id">Id</label>
        <input type="text" name="data[id]" id="Id" value="<?=$id?>" placeholder="<?=$id?>" readonly>

        <label for="Nombre">Nombre</label>
        <input type="text" name="data[nombre]" id="Nombre" pattern="^[a-zA-Z]+$" title="Ingrese solo letras." placeholder="Nombre" required>

        <label for="Apellidos">Apellidos</label>
        <input type="text" name="data[apellidos]" id="Apellidos" pattern="^[a-zA-Z]+$" title="Ingrese solo letras." placeholder="Nombre" required>

        <label for="Biografia">Biografia</label>
        <textarea name="data[biografia]" id="Biografia" rows="5" placeholder="Escriba aqui una breve biografia sobre el Autor" required></textarea>

        <label for="Nacionalidad">Nacionalidad</label>
        <input type="text" name="data[nacionalidad]" id="Nacionalidad" pattern="^[a-zA-Z]+$" title="Ingrese solo letras." placeholder="Nacionalidad" required>
        
        <label for="Fecha_Nacimiento">Fecha_Nacimiento</label>
        <input type="date" name="data[fecha_nacimiento]" id="Fecha_Nacimiento" title="Ingrese la fecha de nacimiento" placeholder="Fecha de Nacimiento" required>

        <label for="Fecha_Fallecimiento">Fecha_Fallecimiento</label>
        <input type="date" name="data[fecha_fallecimiento]" id="Fecha_Fallecimiento" title="Ingrese la fecha de fallecimiento" placeholder="Fecha de Fallecimiento" required>


        <input type="submit" value="Editar">
    </form>

</div>