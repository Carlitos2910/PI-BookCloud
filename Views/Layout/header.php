<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/1aac6cce8b.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- FAVICON WEB -->
    <link rel="shortcut icon" href="<?=$_ENV['BASE_URL_IMG']?>faviconlogo.png" type="image/x-icon">
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="<?=$_ENV['BASE_URL_CSS']?>bootstrap.css">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

    <!-- LINK CSS -->
    <link rel="stylesheet" href="<?=$_ENV['BASE_URL_CSS']?>main.css" />
    

    <!-- Libreria DATATABLE LINKS-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

    <!-- Libreria SLIDER -->
    <link rel="stylesheet" href="<?=$_ENV['BASE_URL_CSS']?>swiper.css" />
    <link rel="stylesheet" href="<?=$_ENV['BASE_URL_CSS']?>swiper-bundle.min.css" />
    <link rel="stylesheet" href="<?=$_ENV['BASE_URL_CSS']?>swiper.min.css" />

    
    <!-- Catpcha -->
    <script src="https://js.hcaptcha.com/1/api.js" async defer></script>

    <!-- LIBRERIA DATATABLE ARCHIVOS -->
    <!-- <link href="../DataTables/datatables.min.css" rel="stylesheet"/>
    <script src="../DataTables/datatables.min.js"></script> -->

    <title>Library</title>
</head>
<body>
    
    <header>
        <div class="logo">
            <a href="<?=$_ENV['BASE_URL']?>home">
                <!-- <img src="../Images/Logo.png" onerror="this.onerror=null;this.src='../../Images/Logo.png';" class="logo" alt="Library Logo"> -->
                <img src="<?=$_ENV['BASE_URL_IMG']?>Logo.png" class="logo" alt="Library Logo">
            </a>
        </div>
        <input type="checkbox" id="nav_check" hidden>
        <nav>
            <label for="nav_check" class="hamburger">
                <i class="fa-solid fa-close"></i>
            </label>
            <div class="logo">
                <a href="<?=$_ENV['BASE_URL']?>home">
                    <!-- <img src="../Images/Logo.png" onerror="this.onerror=null;this.src='../../Images/Logo.png';" class="logo" alt="Library Logo"> -->
                    <img src="<?=$_ENV['BASE_URL_IMG']?>Logo.png" class="logo" alt="Library Logo">
                </a>
            </div>
            <ul>
                <li>
                    <a href="<?=$_ENV['BASE_URL']?>home">Home</a>
                </li>
                <li>
                    <a href="<?=$_ENV['BASE_URL']?>autores">Autores</a>
                </li>
                <li>
                    <a href="<?=$_ENV['BASE_URL']?>libros">Libros</a>
                </li>
                <!-- <li>
                    <a href="#">4º Link</a>
                </li> -->
                <?php if(isset($_SESSION['identity'])):?>
                    <li>
                        <a href="<?=$_ENV['BASE_URL']?>mis_libros">Mis Libros</a>
                    </li>
                <?php endif;?>

                <?php if(isset($_SESSION['admin'])):?>
                    <li>
                        <div class="dropdown">
                            <!-- <a href="" class="link"> -->
                                <i class="fa-solid fa-screwdriver-wrench" onclick="mostrar_dropdown_content()"></i>
                            <!-- </a> -->
                            <div class="dropdown-content">
                                <a href="<?=$_ENV['BASE_URL']?>admin_categoria">Categorias</a>
                                <a href="<?=$_ENV['BASE_URL']?>admin_autor">Autores</a>
                                <a href="<?=$_ENV['BASE_URL']?>admin_libro">Libros</a>
                                <a href="<?=$_ENV['BASE_URL']?>admin_users">Usuarios</a>
                            </div>
                        </div>
                    </li>
                <?php endif; ?>

                <?php if(!isset($_SESSION['identity'])):?>
                    <li>
                        <a href="<?=$_ENV['BASE_URL']?>user_login" class="link">
                            <i class="fa-solid fa-user"></i>
                            <span class="linktip">Login</span>
                        </a>
                    </li>
                <?php endif; ?>
                
                <?php if(isset($_SESSION['identity'])):?>
                    <li>
                        <a href="<?=$_ENV['BASE_URL']?>user_logout" class="link">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            <span class="linktip">LogOut</span>
                        </a>
                    </li>
                <?php endif; ?>

                <li>
                    <a id="dark-mode" onclick="dark_mode()" class="link">
                        <i class="fa-solid fa-moon"></i>
                        <span class="linktip">DarkMode</span>
                    </a>
                </li>

            </ul>
        </nav>
        <label for="nav_check" class="hamburger">
            <i class="fa-solid fa-bars"></i>
        </label>
    </header>
    <main>

    