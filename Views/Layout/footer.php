
    </main>
    <footer>
        <a id="gototop"></a>

            <div id="container_contact_form">

                <form id="contact_form" action="<?=$_ENV['BASE_URL']?>send_email" method="POST">
                    <h2>CONTACTANOS</h2>
                    
                    <a id="contact_form_close">
                        <i class="fa-solid fa-xmark fa-2xl"></i>
                    </a>

                    <?php
                        if(isset($correct_response_email)){
                            echo('<b class="alert_green">'.$correct_response_email.'</b>');
                        } else if(isset($bad_response_email)) {
                            echo('<b class="alert_red">'.$bad_response_email.'</b>');
                        }
                    ?>

                    <!-- <p type="Nombre:">
                        <input type="text" name="nombre" placeholder="Escriba su nombre."/>
                    </p> -->
                    <p type="Email:">
                        <input type="email" name="email" placeholder="¿Cómo deseas contactarnos?"/>
                    </p>
                    <p type="Mensaje:">
                        <input type="text" name="mensaje" placeholder="Escriba su pregunta.."/>
                    </p>
                    
                    <div>
                        <div class="h-captcha" data-sitekey="4a2e7142-8c2a-4441-a912-2f3db8bf8fcc"></div>
                    </div>

                    <input type="reset" value="Cancelar">
                    <input type="submit" value="Enviar">
                </form>

                <a id="btn_contact_form"></a>

            </div>
            
            <div class="info">
            <div class="logo">
                <a href="<?=$_ENV['BASE_URL']?>home">
                    <img src="<?=$_ENV['BASE_URL_IMG']?>Logo.png" class="logo" alt="Library Logo">
                </a>
            </div>
            <div class="box">
                <h2>SOBRE NOSOTROS</h2>
                <p>En Book Cloud, somos una empresa dedicada a venta y reserva de libros online. Desde que fundamos la empresa en 2023, nos hemos comprometido a ofrecer las mejores ofertas de libros.</p>
            </div>
            <div class="box">
                <h2>Social Medias</h2>
                <div class="red-social">
                    <a href="https://www.instagram.com/" title="Instagram" target="_blank">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                    <a href="https://twitter.com/" title="Twitter" target="_blank">
                        <i class="fa-brands fa-twitter"></i>
                    </a>
                    <a href="https://es-es.facebook.com/" title="Facebook" target="_blank">
                        <i class="fa-brands fa-facebook"></i>
                    </a>
                    <a href="https://es.linkedin.com/" title="LinkedIn" target="_blank">
                        <i class="fa-brands fa-linkedin"></i>
                    </a>
                    <a href="https://github.com/Carlitos2910/" title="GitHub" target="_blank">
                        <i class="fa-brands fa-github"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="copy">
            <small>
                &copy; 2023 <b>Carlos López</b> - Todos Los Derechos Reservados.
            </small>
        </div>
    </footer>
    
    <script src="<?=$_ENV['BASE_URL_SRC']?>main.js"></script>

    <script src="<?=$_ENV['BASE_URL_SRC']?>swiper-bundle.min.js"></script>
    <script src="<?=$_ENV['BASE_URL_SRC']?>swiper.js"></script>
</body>
</html>
