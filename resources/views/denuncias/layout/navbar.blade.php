<link rel="stylesheet" href="https://michoacan.gob.mx/cdn/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://michoacan.gob.mx/cdn/css/estilos.css">
        
        <link rel="shortcut icon" href="https://michoacan.gob.mx/cdn/img/favicon/favicon.ico" type="image/x-icon" />
        <link rel="stylesheet" href="{{ asset('assets/css/estiloGob.css') }}">

        <!-- Navbar Oficial -->
        <nav class="navbar main-nav fixed-top navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="https://secoem.michoacan.gob.mx">
                    <img src="https://michoacan.gob.mx/cdn/img/logos/dependencias/secoem.svg" height="85px;" alt="Logo SECOEM">
                </a>
                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link fw-semibold" href="https://secoem.michoacan.gob.mx">Inicio SECOEM</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-semibold" href="#contacto">Contacto</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://www.facebook.com/contraloriamich/" target="_blank" title="Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://twitter.com/contraloriamich/" target="_blank" title="Twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#search" title="Búsqueda">
                                <i class="fas fa-search"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Ajuste dinámico de padding -->
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const navbarHeight = document.querySelector('.navbar').offsetHeight;
                document.querySelector('.container').style.paddingTop = (navbarHeight + 20) + "px";
            });
        </script>