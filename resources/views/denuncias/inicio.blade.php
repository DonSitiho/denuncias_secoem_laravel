<x-auth-layout>
    @section('content')
        <!-- Estilos oficiales -->
        <link rel="stylesheet" href="https://michoacan.gob.mx/cdn/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://michoacan.gob.mx/cdn/css/estilos.css">
        <link rel="shortcut icon" href="https://michoacan.gob.mx/cdn/img/favicon/favicon.ico" type="image/x-icon" />

        <!-- Navbar -->
        <nav class="navbar main-nav fixed-top navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="https://secoem.michoacan.gob.mx">
                    <img src="https://michoacan.gob.mx/cdn/img/logos/dependencias/secoem.svg" height="85px;" alt="logo">
                </a>
                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="https://secoem.michoacan.gob.mx">SECOEM</a>
                        </li>
                        <li class="nav-item linkancla">
                            <a class="nav-link ancla" href="#contacto">Contacto</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://www.facebook.com/contraloriamich/" target="_blank"><i
                                    class="fab fa-facebook-f"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://twitter.com/contraloriamich/" target="_blank"><i
                                    class="fab fa-twitter"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#search">
                                <em class="fa fa-search"></em>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Ajuste dinámico de padding para que el contenido no sea tapado -->
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const navbarHeight = document.querySelector('.navbar').offsetHeight;
                document.querySelector('.container').style.paddingTop = navbarHeight + "px";
            });
        </script>

        <!-- Contenido Principal -->
        <div class="container">
            <section style="background-color: #F6F6F6; background: url(https://michoacan.gob.mx/images/backgrounds/bg.png) fixed no-repeat; background-size: cover; padding:20px 0;">
                <!-- Hero Section -->
                <div class="text-center mb-12">
                    <h2 class="textoGuinda" data-aos="zoom-in-up" data-aos-delay="100"
                        style="margin-bottom: 0; color: #6A0F49;">
                        Ejemplo de Sistema de Denuncias Ciudadanas
                    </h2>
                    <h5 data-aos="zoom-in-up" data-aos-delay="200" style="padding-top:5px;">
                        Puedes realizar una denuncia o buscar el seguimiento de tu caso de manera fácil y segura.
                    </h5>
                    <h2>Falta darle estilacho</h2>
                </div>

                <!-- Options Section -->
                <div class="row justify-content-center g-6 mb-15">
                    <!-- Denunciar -->
                    <div class="col-md-4">
                        <div class="card h-100 hover-elevate-up">
                            <div class="card-body text-center">
                                <img src="https://preview.keenthemes.com/metronic8/demo1/assets/media/svg/illustrations/communication.svg"
                                    class="mb-5" style="width:100px;" alt="Denunciar">
                                <h3 class="fw-bold text-gray-800 mb-3">Denunciar</h3>
                                <p class="text-gray-600 mb-5">Reporta un incidente o irregularidad de manera anónima o identificada.</p>
                                <a href="{{ route('denunciar') }}" class="btn btn-primary btn-lg w-100">
                                    Crear Denuncia
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Buscar Denuncia -->
                    <div class="col-md-4">
                        <div class="card h-100 hover-elevate-up">
                            <div class="card-body text-center">
                                <img src="https://preview.keenthemes.com/metronic8/demo1/assets/media/svg/illustrations/search.svg"
                                    class="mb-5" style="width:100px;" alt="Buscar Denuncia">
                                <h3 class="fw-bold text-gray-800 mb-3">Buscar Denuncia</h3>
                                <p class="text-gray-600 mb-5">Consulta el estado de tu denuncia usando tu folio o escaneando un QR.</p>
                                <a href="{{ route('buscar.denuncia') }}" class="btn btn-success btn-lg w-100">
                                    Buscar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Call to Action Section -->
            <div class="text-center mt-12">
                <h2 class="fw-bold text-gray-800 mb-3">¿Necesitas Ayuda?</h2>
                <p class="fs-6 text-gray-600 mb-5">
                    No dudes en contactarnos si tienes alguna pregunta o necesitas asistencia.
                </p>
                <a href="https://preview.keenthemes.com/metronic8/demo1/pages/contact.html" class="btn btn-primary btn-lg">
                    Contactar Soporte
                </a>
            </div>
        </div>
    @endsection
</x-auth-layout>
