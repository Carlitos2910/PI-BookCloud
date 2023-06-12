<?php

    use Models\Libro;
    use Models\Categoria;
    use Models\Autor;
    use Models\Valoracion;
    use Models\Comentario;
    use Models\Compra;
use Models\Reserva;

    if (isset($id)) {
        $libro = Libro::getAllLibrosFromId($id);
        $libro2 = Libro::getAllLibrosFromId($id);
        $comprobar = $libro2->fetch(PDO::FETCH_OBJ);
        $libro = $libro->fetchAll();

        if($comprobar !== false) {
            // Buscamos la categoria y el autor de ese libro.
            $categoria = Categoria::getAllCategoriaFromId($libro[0]['categoria_id']);
            $categoria = $categoria->fetchAll();
            $autor = Autor::getAutorIdFromId($libro[0]['autor_id']);
            $autor = $autor->fetchAll();

            if(isset($_SESSION['identity'])){
                $valoracion = Valoracion::getAllValoracionesFromUserBook($_SESSION['identity']->id, $id);
                $valoracion = $valoracion->fetchAll();
                // print_r($valoracion);
            }

            $comentarios = Comentario::getRandomComentarios($libro[0]['id']);
            $comentarios = $comentarios->fetchAll();
            // print_r($comentarios);



        }
    }

?>






<?php if($comprobar !== false):?>

    <div class="autor">
        <div class="autor_info">
            <h2><?=$libro[0]['titulo']?></h2>
            <p><?=$libro[0]['descripcion']?></p>
            <p><b>Categoría:</b> <?=$categoria[0]['nombre']?> </p>
            <p><b>Autor:</b> <?=$autor[0]['nombre']?> <?=$autor[0]['apellidos']?></p>
            <p><b>Fecha_Publicacion:</b> <?=$libro[0]['fecha_publicacion']?></p>

            <?php if($libro[0]['stock'] > 0):?>
                <?php if(isset($_SESSION['identity'])) :?>
                    <?php
                        $libro_comprado = Compra::getAllComprasFromUserBook($libro[0]['id']);
                        $libro_comprado = $libro_comprado->fetchAll();
                    ?>
                    <?php if(empty($libro_comprado)):?>
                        <a href="<?=$_ENV['BASE_URL']?>libro_comprar/<?=$libro[0]['id']?>" id="btn_comprar">Comprar</a>
                    <?php else:?>
                        <a href="<?=$_ENV['BASE_URL']?>mis_libros" id="btn_comprar">Ver Libro Comprado</a>
                    <?php endif;?>
                <?php else:?>
                    <a href="<?=$_ENV['BASE_URL']?>user_login" id="btn_comprar">Iniciar Sesion para Comprar</a>
                <?php endif;?>
            <?php else:?>
                <?php if(isset($_SESSION['identity'])) :?>
                    <?php
                        $libro_reservado = Reserva::getAllReservasFromUserBook($libro[0]['id']);
                        $libro_reservado = $libro_reservado->fetchObject();
                    ?>
                    <?php if(empty($libro_reservado)):?>
                        <a href="<?=$_ENV['BASE_URL']?>libro_reservar/<?=$libro[0]['id']?>" id="btn_reservar">Reservar</a>
                    <?php else:?>

                            <?php if($libro_reservado->comprada == 0):?>
                                <a id="btn_comprar" title="Se le asignará un libro lo antes posible.">Reservado</a>
                            <?php else:?>
                                <!-- Comprobar que el libro no esta en la tabla compras. -->
                                <?php
                                    $libro_comprado = Compra::getAllComprasFromUserBook($libro[0]['id']);
                                    $libro_comprado = $libro_comprado->fetchObject();
                                ?>
                                <?php if(empty($libro_comprado)):?>
                                    <a href="<?=$_ENV['BASE_URL']?>libro_comprar_reserva/<?=$libro[0]['id']?>" id="btn_comprar" title="Se le añadirá a 'Mis Libros' al obtener.">Obtener Reserva</a>
                                <?php else:?>
                                    <a href="<?=$_ENV['BASE_URL']?>mis_libros" id="btn_comprar">Ver Libro Comprado</a>
                                <?php endif;?>

                            <?php endif;?>

                    <?php endif;?>
                <?php else:?>
                    <a href="<?=$_ENV['BASE_URL']?>user_login" id="btn_reservar">Iniciar Sesión para Reservar</a>
                <?php endif;?>
            <?php endif;?>


            <a id="btn_valorar">Valorar</a>
        </div>


        <div class="libro_image" id="libro_img">

            <form id="valoration_form" action="<?=$_ENV['BASE_URL']?>valorar" method="POST">
                <?php if(isset($_SESSION['identity'])) :?>

                    <a id="valoration_form_close">
                        <i class="fa-solid fa-xmark fa-2xl"></i>
                    </a>

                    <?php
                        if(isset($correct_response_valoration)){
                            echo('<b class="alert_green">'.$correct_response_valoration.'</b>');
                        } else if(isset($bad_response_email)) {
                            echo('<b class="alert_red">'.$bad_response_valoration.'</b>');
                        }
                    ?>

                    <label for="Texto">Comentario:</label>
                    <textarea name="data[texto]" id="Texto" rows="5" placeholder="Escriba aqui una breve reseña del Libro" required></textarea>

                    <label>Valoración:</label>
                    <p class="clasificacion">
                        <input id="radio1" type="radio" name="data[estrellas]" value="5">
                        <label for="radio1">★</label>
                        <input id="radio2" type="radio" name="data[estrellas]" value="4">
                        <label for="radio2">★</label>
                        <input id="radio3" type="radio" name="data[estrellas]" value="3">
                        <label for="radio3">★</label>
                        <input id="radio4" type="radio" name="data[estrellas]" value="2">
                        <label for="radio4">★</label>
                        <input id="radio5" type="radio" name="data[estrellas]" value="1">
                        <label for="radio5">★</label>
                    </p>

                    <input type="hidden" name="data[libro_id]" value="<?=$libro[0]['id']?>">
                    <input type="hidden" name="data[user_id]" value="<?=$_SESSION['identity']->id?>">
                    
                    <?php
                        if(!empty($valoracion)){
                            echo "<i>Has valorado el libro ".$valoracion[0][0]." veces.</i>";
                        }else{
                            echo "<i>Has valorado el libro 0 veces.</i>";
                        }
                    ?>

                    <input type="reset" value="Cancelar">
                    <input type="submit" value="Enviar">
                <?php else:?>

                    <div class="login_necessary">
                        <h3>Es necesario iniciar sesión para valorar un libro.</h3>
                        <a href="<?=$_ENV['BASE_URL']?>user_login">Login</a>
                    </div>
                    
                <?php endif;?>
            </form>

            <?php
                $imagen = $libro[0]['titulo'];
                $imagen = str_replace(" ", "", $imagen);
            ?>
            <img src="<?=$_ENV['BASE_URL_IMG']?>Libros/<?=$imagen?>.png" alt="Imagen de <?=$libro[0]['titulo']?>">
        </div>
    </div>

    <div class="container_parent">
        <div class="container">
            <div id="demo" class="carousel slide" data-ride="carousel">


                <div class="carousel-inner">

                    <?php if(!empty($comentarios)) :?>
                        <?php if(!empty($comentarios[0])) :?>
                            <div class="carousel-item active">
                                <div class="carousel-caption">
                                    <p><?=$comentarios[0]['texto']?></p>
                                    <?php
                                        $color = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                                    ?>
                                    <img src="<?=$_ENV['BASE_URL_IMG']?>Users/user1.png" style="background-color: <?=$color?>">
                                    <div id="image-caption">
                                        <b>Fecha Publicación: </b> <?=$comentarios[0]['fecha_publicacion']?>
                                    </div>
                                    <b class="paginacion">
                                        1
                                    </b>
                                </div>   
                            </div>
                        <?php endif;?>
                        <?php if(!empty($comentarios[1])) :?>
                            <div class="carousel-item">
                                <div class="carousel-caption">
                                    <p><?=$comentarios[1]['texto']?></p>
                                    <?php
                                        $color = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                                    ?>
                                    <img src="<?=$_ENV['BASE_URL_IMG']?>Users/user1.png" style="background-color: <?=$color?>">
                                    <div id="image-caption">
                                        <b>Fecha Publicación: </b> <?=$comentarios[1]['fecha_publicacion']?>
                                    </div>
                                    <b class="paginacion">
                                        2
                                    </b>
                                </div>   
                            </div>
                        <?php endif;?>
                        <?php if(!empty($comentarios[2])) :?>
                            <div class="carousel-item">
                                <div class="carousel-caption">
                                    <p><?=$comentarios[2]['texto']?></p>
                                    <?php
                                        $color = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                                    ?>
                                    <img src="<?=$_ENV['BASE_URL_IMG']?>Users/user1.png" style="background-color: <?=$color?>">
                                    <div id="image-caption">
                                        <b>Fecha Publicación: </b> <?=$comentarios[2]['fecha_publicacion']?>
                                    </div>
                                    <b class="paginacion">
                                        3
                                    </b>
                                </div>   
                            </div>
                        <?php endif;?>
                        <?php if(!empty($comentarios[3])) :?>
                            <div class="carousel-item">
                                <div class="carousel-caption">
                                    <p><?=$comentarios[3]['texto']?></p>
                                    <?php
                                        $color = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                                    ?>
                                    <img src="<?=$_ENV['BASE_URL_IMG']?>Users/user1.png" style="background-color: <?=$color?>">
                                    <div id="image-caption">
                                        <b>Fecha Publicación: </b> <?=$comentarios[3]['fecha_publicacion']?>
                                    </div>
                                    <b class="paginacion">
                                        4
                                    </b>
                                </div>   
                            </div>
                        <?php endif;?>
                        <?php if(!empty($comentarios[4])) :?>
                            <div class="carousel-item">
                                <div class="carousel-caption">
                                    <p><?=$comentarios[4]['texto']?></p>
                                    <?php
                                        $color = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                                    ?>
                                    <img src="<?=$_ENV['BASE_URL_IMG']?>Users/user1.png" style="background-color: <?=$color?>">
                                    <div id="image-caption">
                                        <b>Fecha Publicación: </b> <?=$comentarios[4]['fecha_publicacion']?>
                                    </div>
                                    <b class="paginacion">
                                        5
                                    </b>
                                </div>
                            </div>
                        <?php endif;?>
                    <?php else :?>
                        <div class="carousel-item active">
                            <div class="carousel-caption">
                                <p>No hay comentarios sobre este libro.</p>
                                <img src="<?=$_ENV['BASE_URL_IMG']?>Users/user1.png" style="background:gray">
                                <div id="image-caption">
                                </div>
                            </div>   
                        </div>
                    <?php endif ;?>


                </div>

                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                    <i class='fas fa-arrow-left'></i>
                </a>
                <a class="carousel-control-next" href="#demo" data-slide="next">
                    <i class='fas fa-arrow-right'></i>
                </a>
            </div>
        </div>
    </div>

<?php else:?>

    <div class="autor">
        <div class='not_found'>
            No hay datos disponibles de este libro.
            <p>
                <a href="<?=$_ENV['BASE_URL']?>libros">Ver libros</a>
            </p>
        </div>
    </div>

<?php endif;?>



