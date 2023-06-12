<?php

    use Models\Autor;
    
    $autores = Autor::getAllAutores();
    $autores2 = Autor::getAllAutores();
    $comprobar = $autores2->fetch(PDO::FETCH_OBJ);

    $prueba = [];
    while($aut = $autores->fetch(PDO::FETCH_OBJ)) {
        $prueba[] = $aut;
    }
?>



<div class="autores">

    <h1 class="titulo"> Autores </h1>

    <div class="searchbox">
        
        <input type="search" name="buscar" id="buscar" placeholder="Buscar Por Nombre:" oninput="buscar_ahora($('#buscar').val());">
        <button onclick="buscar_ahora($('#buscar').val());">
            <i class="fa-solid fa-magnifying-glass"></i>
        </button>

    </div>

    

    <div id="datos_buscador">
        <div class="grid-container">

            <?php if($comprobar !== false ):?>
                <?php foreach($prueba as $autor):?>
                    <!-- Comprobamos que la imagen existe, para añadirla o meter una de error -->
                    <?php
                        $nombre_imagen = $autor->nombre;
                        $nombre_imagen = str_replace(" ", "", $nombre_imagen);
                        $imagen =  './Images/Autores/'.$nombre_imagen.'.png';
                        if(!file_exists($imagen)) {
                            $imagen = $_ENV['BASE_URL_IMG'].'/Error404/ImgNotFound.png';
                        }else{
                            $imagen =  $_ENV['BASE_URL_IMG'].'Autores/'.$nombre_imagen.'.png';
                        }
                    ?>
                        <div class="container" style="background-image: url(<?=$imagen?>)">
                            <a href="<?=$_ENV['BASE_URL']?>autor/<?=$autor->id?>">
                                <div class="overlay">
                                    <div class="items"></div>
                                    <div class="items head">
                                        <p class="nombre"><?=$autor->nombre?></p>
                                        <p class="apellidos"><?=$autor->apellidos?></p>
                                        <hr>
                                    </div>
                                    <div class="items price">
                                        <p><?=$autor->fecha_nacimiento?></p>
                                        <p class="old"><?=$autor->fecha_fallecimiento?></p>
                                    </div>
                                    <!-- <div class="items cart">
                                        <i class="fa fa-shopping-cart"></i>
                                        <span>ADD TO CART</span>
                                    </div> -->
                                </div>
                            </a>
                        </div>
                <?php endforeach;?>
            <?php else:?>
                <?php
                    echo "No hay existe ningún autor.";
                ?>
            <?php endif;?>
        </div> 
    </div>

</div>





<script type="text/javascript">
    function buscar_ahora(buscar) {
        var parametros = {"buscar": buscar};
        $.ajax({
            data: parametros,
            type:  "POST",
            url: 'buscador_autor',
            success: function(data) {
                $('#datos_buscador').html(data);
            }
        })
    };
</script>