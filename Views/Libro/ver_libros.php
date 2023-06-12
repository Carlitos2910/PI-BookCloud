<?php

    use Models\Libro;
    use Models\Autor;
    use Models\Valoracion;
    
    $libros = Libro::getAllLibros();
    $libros2 = Libro::getAllLibros();
    $comprobar = $libros2->fetch(PDO::FETCH_OBJ);

    $prueba = [];
    while($lib = $libros->fetch(PDO::FETCH_OBJ)) {
        $prueba[] = $lib;
    }
?>


<div class="libros">

    <h1 class="titulo"> Libros </h1>

    <div class="searchbox">

        <input type="search" name="buscar" id="buscar2" placeholder="Buscar Por Título:" oninput="buscar_ahora2($('#buscar2').val());">
        <button onclick="buscar_ahora2($('#buscar2').val());">
            <i class="fa-solid fa-magnifying-glass"></i>
        </button>

    </div>

    <div id="datos_buscador">
        <div class="grid-container">
        
            <?php if($comprobar !== false ):?>
                <?php foreach($prueba as $libro):?>
                    <!-- Comprobamos que la imagen existe, para añadirla o meter una de error -->
                    <?php
                        $nombre_imagen = $libro->titulo;
                        $nombre_imagen = str_replace(" ", "", $nombre_imagen);
                        $imagen =  './Images/Libros/'.$nombre_imagen.'.png';
                        if(!file_exists($imagen)) {
                            $imagen = $_ENV['BASE_URL_IMG'].'Error404/ImgNotFound.png';
                        }else{
                            $imagen =  $_ENV['BASE_URL_IMG'].'Libros/'.$nombre_imagen.'.png';
                        }
                    ?>
                        <div class="container" style="background-image: url(<?=$imagen?>)">
                        <a href="<?=$_ENV['BASE_URL']?>libro/<?=$libro->id?>">
                            <div class="overlay">
                                <div class="items"></div>
                                <div class="items head">
                                    <p class="titulo"><?=$libro->titulo?></p>
                                    <hr>
                                </div>
                                <div class="items price">
                                    <?php
                                        $autor = Autor::getAutorIdFromId($libro->autor_id);
                                        $autor = $autor->fetchAll();

                                    ?>
                                    <p class="nombre_autor"><?= $autor[0]['nombre']?> <?= $autor[0]['apellidos']?></p>
                                    <p><?=$libro->fecha_publicacion?></p>
                                </div>
                                <!-- <div class="items cart">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>ADD TO CART</span>
                                </div> -->
                                <div class="items cart">
                                    <?php
                                        $valoracion = Valoracion::getAllValoracionesFromLibroId($libro->id);
                                        $valoracion = $valoracion->fetchAll();
                                        echo "<p><i>".$valoracion[0][0]."<b> Valoraciones.</b></i></p>";
                                    ?>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach;?>
            <?php else:?>
                <?php
                    echo "No hay existe ningún libro.";
                ?>
            <?php endif;?>
        </div> 
    </div>

</div>




<script type="text/javascript">
    function buscar_ahora2(buscar) {
        var parametros = {"buscar": buscar};
        $.ajax({
            data: parametros,
            type:  "POST",
            url: 'buscador_libros',
            success: function(data) {
                $('#datos_buscador').html(data);
            }
        })
    };
</script>