<?php

    use Models\Autor;
    use Models\Libro;


    if (isset($id)) {
        $autor = Autor::getAutorIdFromId($id);
        $autor2 = Autor::getAutorIdFromId($id);
        $comprobar = $autor2->fetch(PDO::FETCH_OBJ);
        $autor = $autor->fetchAll();

        $libro = Libro::getCantidadLibrosFromAutor($id);
        $libros = $libro->fetchColumn();


        $all_libros = Libro::getAllLibrosFromAutor($id);
        $all_libros2 = Libro::getAllLibrosFromAutor($id);
        $comprobar_libros = $all_libros2->fetch(PDO::FETCH_OBJ);

    }

?>


<?php if($comprobar !== false):?>

    <div class="autores">
        <div class="autor">
            <div class="autor_info">
                <h2><?=$autor[0]['nombre']?> <?=$autor[0]['apellidos']?></h2>
                <p><?=$autor[0]['biografia']?></p>
                <p><b>Nacionalidad:</b> <?=$autor[0]['nacionalidad']?></p>
                <p> <b>Fecha_Nacimiento:</b> <?=$autor[0]['fecha_nacimiento']?></p>
                <?php if(isset($autor[0]['fecha_fallecimiento'])):?>
                    <p class="old"> <b>Fecha_Fallecimiento:</b> <?=$autor[0]['fecha_fallecimiento']?></p>
                <?php endif;?>

                <p class="libros_escritos"><i><?=$autor[0]['nombre']?> <?=$autor[0]['apellidos']?></i> ha escrito <b><?=$libros[0][0]?></b> libros.</p>
            </div>
            <div class="autor_image">
                <?php
                    $imagen = $autor[0]['nombre'];
                    $imagen = str_replace(" ", "", $imagen);
                ?>
                <img src="<?=$_ENV['BASE_URL_IMG']?>Autores/<?=$imagen?>.png" alt="Imagen de <?=$autor[0]['nombre']?>">
            </div>
        </div>


        <?php if($comprobar_libros !== false):?>
        <h2>Libros de <?=$autor[0]['nombre']?> <?=$autor[0]['apellidos']?></h2>
        <div class="autor">
            <div class="slide-container swiper">
                <div class="slide-content">
                    <div class="card-wrapper swiper-wrapper">

                        <?php while($lib = $all_libros->fetch(PDO::FETCH_OBJ)):?>
                            <?php
                                $nombre_imagen = $lib->titulo;
                                $nombre_imagen = str_replace(" ", "", $nombre_imagen);
                                $imagen =  './Images/Libros/'.$nombre_imagen.'.png';
                                if(!file_exists($imagen)) {
                                    $imagen = $_ENV["BASE_URL_IMG"].'Error404/ImgNotFound.png';
                                }else{
                                    $imagen =  $_ENV["BASE_URL_IMG"].'Libros/'.$nombre_imagen.'.png';
                                }
                            ?>
                        <div class="card swiper-slide">
                            <div class="image-content">
                                <span class="overlay"></span>

                                <div class="card-image">
                                    <img src="<?=$imagen?>" alt="" class="card-img">
                                </div>
                            </div>

                            <div class="card-content">
                                <h2 class="name"><?=$lib->titulo?></h2>
                                <p class="description"><?=$lib->descripcion?></p>

                                <a href="<?=$_ENV['BASE_URL']?>libro/<?=$lib->id?>" class="button">Ver más</a>
                            </div>
                        </div>
                        <?php endwhile;?>

                    </div>
                </div>
                <div class="swiper-button-next swiper-navBtn"></div>
                <div class="swiper-button-prev swiper-navBtn"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <?php endif;?>
    </div>

<?php else:?>

    <div class="autores">
        <div class="autor">
        <div class='not_found'>
                No hay datos disponibles de este autor.
                <p>
                    <a href="<?=$_ENV['BASE_URL']?>autores">Ver autores</a>
                </p>
            </div>
        </div>
    </div>

<?php endif;?>