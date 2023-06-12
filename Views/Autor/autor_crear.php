

<div class="admin_site">

    <h1 class="titulo_admin"> Crear Nueva Autor</h1>

    <a href="admin_autor">
        Ver Autores
    </a>

    <form action="autor_create" method="POST">
        <?php if(isset($error)) :?>
            <b class="alert_red"><?=$error;?></b>
        <?php endif; ?>
        <label for="Nombre">Nombre</label>
        <input type="text" name="data[nombre]" id="Nombre" pattern="^[a-zA-Z]+$" title="Ingrese solo letras." placeholder="Nombre" required>

        <label for="Apellidos">Apellidos</label>
        <input type="text" name="data[apellidos]" id="Apellidos" pattern="^[a-zA-Z]+$" title="Ingrese solo letras." placeholder="Apellidos" required>

        <label for="Biografia">Biografia</label>
        <textarea name="data[biografia]" id="Biografia" rows="5" maxlength="499" placeholder="Escriba aqui una breve biografia sobre el autor." required></textarea>
        
        <label for="Nacionalidad">Nacionalidad</label>
        <input type="text" name="data[nacionalidad]" id="Nacionalidad" pattern="^[a-zA-Z]+$" title="Ingrese solo letras." placeholder="Nacionalidad" required>

        <label for="Fecha_Nacimiento">Fecha_Nacimiento</label>
        <input type="date" name="data[fecha_nacimiento]" id="Fecha_Nacimiento" placeholder="Fecha_Nacimiento" required>

        <label for="Fecha_Fallecimiento">Fecha_Fallecimiento</label>
        <input type="date" name="data[fecha_fallecimiento]" id="Fecha_Fallecimiento" placeholder="Fecha_Fallecimiento" required>

        
        <input type="submit" value="Crear">
    </form>

</div>
