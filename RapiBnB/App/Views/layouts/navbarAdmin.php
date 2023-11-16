<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/RapiBnB/Public/Assets/Css/navbarStyles2.css">
    <link rel="stylesheet" href="/RapiBnB/Public/Assets/Icons/bootstrap-icons-1.11.1/bootstrap-icons.css">

</head>
<body>
    <header>
        <nav class="Navbar">
            <div class="logo">
                <img src="/RapiBnB/Public/Assets/Images/logoRapiBnB.svg" alt="">
            </div>
            <div class="ListaButtons">
                <ul>
                    <li>
                        <a href="http://localhost/RapiBnB/Public/">
                            <i class="bi bi-house"></i>
                            <span>Inicio</span>
                        </a>
                        
                    </li>
                    <li>
                        <a href="http://localhost/RapiBnB/Public/Admin/index">
                            <i class="bi bi-envelope-check"></i>
                            <span>Solicitudes</span>
                        </a>
                    </li>
                    <li id="liPerfil">
                        <a href="">
                            <i class="bi bi-person-circle"></i>
                            <span id="navBarSpanUser"></span>
                        </a>
                        <div class="subMenu" id="perfilSubMenu">
                            <a href="http://localhost/RapiBnB/Public/InicioSesion/cerrarSesion">Cerrar sesión</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <script src="/RapiBnB/Public/Assets/Js/NavbarStyles.js"></script>
    <script src="/RapiBnB/Public/Assets/Js/NavbarUser.js"></script>
</body>
</html>


