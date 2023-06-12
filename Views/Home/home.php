
<!-- SLIDER PRINCIPAL -->
<div id="slider_container">
    <div id="slider">
        <img src="<?=$_ENV['BASE_URL_IMG']?>Logo.png" alt="Logo de BookCloud">

        <div id="texto">
            <h1>BOOK-CLOUD</h1>
            <h3>"Abre las páginas virtuales y déjate llevar por el poder de las palabras, porque en nuestra librería online, los sueños toman forma y las ideas se transforman en inspiración."</h3>
        </div>
    </div>
</div>



<?php

    // Obtenemos los libros mejores valorados.
    use Models\Valoracion;
    $librosmejorvalorados = Valoracion::getLibrosMejorValorados();
    $comprobar = Valoracion::getLibrosMejorValorados();
    $comprobar = $comprobar->fetch(PDO::FETCH_OBJ);

?>

<!-- Swiper -->
<div id="swiper_container">
    <h1> Libros Mejores Valorados</h1>
    <div class="swiper-container">
        <div class="swiper-wrapper">
    
    <?php if($comprobar !== false):?>
        <?php while($libro = $librosmejorvalorados->fetch(PDO::FETCH_OBJ)):?>
            <?php
                $nombre_imagen = $libro->titulo;
                $nombre_imagen = str_replace(" ", "", $nombre_imagen);
                $imagen =  './Images/Libros/'.$nombre_imagen.'.png';
                if(!file_exists($imagen)) {
                    $imagen = './Images/Error404/ImgNotFound.png';
                }else{
                    $imagen =  './Images/Libros/'.$nombre_imagen.'.png';
                }
            ?>
            <div class="swiper-slide" style="background-image:url(<?=$imagen?>)">
                <h2><?=$libro->titulo?></h2>
                <div class="stars_footer">
                    <div class="boton_most_rated">
                        <a href="<?=$_ENV['BASE_URL']?>libro/<?=$libro->id?>">Ver Libro</a>
                    </div>
                    <div class="stars">
                        <b><?=$libro->suma_valoraciones;?></b>
                        <?php
                            for($i=0; $i<5; $i++){
                                if($i < floor($libro->suma_valoraciones)) {
                                    echo '<i class="fa fa-star orange"></i>';
                                }else if($i == floor($libro->suma_valoraciones) && fmod($libro->suma_valoraciones, 1) >= 0.5) {
                                    echo '<i class="fa fa-star orange-half"></i>';
                                }else {
                                    echo '<i class="fa fa-star gray"></i>';
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>

        <?php endwhile;?>

    <?php else:?>
        <div class="swiper-slide" style="background-image:url(./Images/Error404/ImgNotFound.png)">
            <h2>No hay valoraciones.</h2>
        </div>
                
    <?php endif;?>


        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
    </div>
</div>


<script src="<?=$_ENV['BASE_URL_SRC']?>swiper.min.js"></script>

    <!-- Inicializar Swiper -->
    <script>
        var swiper = new Swiper('.swiper-container', {
            effect: 'coverflow',
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: 'auto',
            coverflowEffect: {
                rotate: 50,
                stretch: 0,
                depth: 100,
                modifier: 1,
                slideShadows : true,
            },
            pagination: {
                el: '.swiper-pagination',
            },
        });
    </script>