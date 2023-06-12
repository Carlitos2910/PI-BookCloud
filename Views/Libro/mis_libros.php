<?php

    use Models\Compra;
    use Models\Libro;
    $libros_comprados = Compra::getAllComprasFromUser($_SESSION['identity']->id);
    $libros_comprados = $libros_comprados->fetchAll();
    // print_r($libros_comprados);

?>


<?php if(!empty($libros_comprados)):?>
    <div class="mis_libros1">
        <?php foreach($libros_comprados as $libro_comprado):?>
            <?php
                $libro = Libro::getAllLibrosFromId($libro_comprado['libro_id']);
                $libro = $libro->fetchAll();
                // print_r($libro);
            
                $nombre_imagen = $libro[0]['titulo'];
                // echo $nombre_imagen;
                $nombre_imagen = str_replace(" ", "", $nombre_imagen);
                // echo $nombre_imagen;
                $imagen =  './Images/Libros/'.$nombre_imagen.'.png';
                // echo $imagen;
                if(!file_exists($imagen)) {
                    $imagen = $_ENV['BASE_URL_IMG'].'Error404/ImgNotFound.png';
                }
            ?>
            <form action="<?=$_ENV['BASE_URL']?>mi_libro" method="POST">
                <input type="hidden" name="id" value="<?=$libro[0]['id']?>">
                <button type="submit" style="border:none;background:none;">
                    <figure>
                        <img src="<?=$imagen?>" alt="<?=$libro[0]['titulo']?>">
                        <figcaption>
                            <?=$libro[0]['titulo']?>
                        </figcaption>
                    </figure>
                </button>
            </form>
        <?php endforeach;?>
    </div>
<?php else:?>
    <div class="mis_libros">
        <section id="page_404">
            <div id="contenedor">
                <div id="columna">
                    <div id="col1">
                        <div id="col2">
                            <div id="four_zero_four_bg">
                                <h1></h1>
                            </div>
                            <div id="contant_box_404">
                                <h2>
                                    No hay libros en propiedad.
                                </h2>
                            <p>Ve a la página de libros y compra alguno.</p>
                            <a href="<?=$_ENV['BASE_URL']?>libros" id="link_404"> Ver Libros </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php endif;?>