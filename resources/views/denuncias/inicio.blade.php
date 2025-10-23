<x-auth-layout>
    @section('title', 'Sistema de Denuncias Ciudadanas - SECOEM')

    @section('content')
        <!-- Estilos oficiales -->
        @include('denuncias.layout.navbar')

        <!-- Contenido Principal -->
        <div class="container">
            <!-- Hero Section -->
            <section class="hero-section" style="background-color: #fbfbfb; background: url(https://michoacan.gob.mx/images/backgrounds/bg.png) fixed no-repeat; background-size: cover; padding: 10px 0; border-radius: 10px; margin-bottom: 10px;">
                <div class="text-center mb-5">
                    <!-- Logo y Título -->
                    <div class="mb-6">
                        {{-- <img src="https://michoacan.gob.mx/cdn/img/logos/dependencias/secoem.svg" alt="SECOEM" height="80" class="mb-4"> --}}
                        <h1 class="textoGuinda fw-bold mb-3" style="color: #6A0F49; font-size: 2.5rem;">
                            Sistema de Denuncias Ciudadanas
                        </h1>
                       
                    </div>
                    
                    <!-- Descripción -->
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <p class="fs-5 text-gray-700 mb-6">
                                Plataforma oficial del Gobierno del Estado de Michoacán para recibir y dar seguimiento 
                                a denuncias ciudadanas sobre posibles actos de corrupción y irregularidades en el servicio público.
                            </p>
                            
                            <!-- Características -->
                            <div class="row g-4 mb-8">
                                <div class="col-md-4">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <i class="fas fa-shield-alt fs-2x text-guinda me-3"></i>
                                        <span class="text-gray-800 fw-semibold">Protegemos su identidad</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <i class="fas fa-clock fs-2x text-guinda me-3"></i>
                                        <span class="text-gray-800 fw-semibold">Seguimiento continuo</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <i class="fas fa-lock fs-2x text-guinda me-3"></i>
                                        <span class="text-gray-800 fw-semibold">Información confidencial</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Servicios Section -->
                <div class="row justify-content-center g-8">
                    <!-- Presentar Denuncia -->
                    <div class="col-md-5">
                        <div class="card card-flush h-100 shadow-sm hover-elevate-up" style="border-left: 4px solid #6A0F49;">
                            <div class="card-body text-center p-6">
                               
                                <h3 class="fw-bold text-gray-800 mb-4">Presentar Denuncia</h3>
                                <p class="text-gray-600 mb-5 fs-6">
                                    Reporte actos de corrupción, irregularidades o malas prácticas en el servicio público. 
                                    Puede realizarlo de manera anónima o proporcionando sus datos para seguimiento.
                                </p>
                                <a href="{{ route('denunciar') }}" class="btn botonGinda btn-lg w-100 py-3 fw-bold">
                                    Iniciar Denuncia
                                </a>
                                {{-- <div class="mt-3">
                                    <small class="text-muted">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Tiempo estimado: 10-15 minutos
                                    </small>
                                </div> --}}
                            </div>
                        </div>
                    </div>

                    <!-- Consultar Seguimiento -->
                    <div class="col-md-5">
                        <div class="card card-flush h-100 shadow-sm hover-elevate-up" style="border-left: 4px solid #8B2A5D;">
                            <div class="card-body text-center p-6">
                                
                                <h3 class="fw-bold text-gray-800 mb-4">Consultar Seguimiento</h3>
                                <p class="text-gray-600 mb-5 fs-6">
                                    Verifique el estado de su denuncia anterior utilizando el folio de seguimiento.
                                </p>
                                <a href="{{ route('buscar.denuncia') }}" class="btn botonGuindaClaro btn-lg w-100 py-3 fw-bold">
                                    Consultar Denuncia
                                </a>
                                {{-- <div class="mt-3">
                                    <small class="text-muted">
                                        <i class="fas fa-qrcode me-1"></i>
                                        Compatible con código QR
                                    </small>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Información Importante -->
            

            <!-- Call to Action Section -->
            <section class="text-center py-8 mt-5" style="background-color: #eeeeee; border-radius: 10px;">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <h2 class="text-guinda fw-bold mb-4">¿Requiere Asistencia o Tiene Dudas?</h2>
                            <p class="text-guinda fs-5 mb-5 opacity-75">
                                Nuestro equipo está disponible para brindarle orientación sobre el proceso de denuncia 
                                y resolver cualquier inquietud que pueda tener.
                            </p>
                            <div class="d-flex flex-column flex-sm-row justify-content-center gap-4">
                                <a href="tel:014434322600" class="btn botonGuinda btn-lg fw-bold">
                                    <i class="fas fa-phone me-2"></i>
                                    Llamar al (443) 432-2600
                                </a>
                                <a href="mailto:denuncias@secoem.michoacan.gob.mx" class="btn botonGuinda btn-lg fw-bold">
                                    <i class="fas fa-envelope me-2"></i>
                                    Enviar Correo
                                </a>
                            </div>
                            <div class="mt-4">
                                <small class="text-guinda opacity-75">
                                    <i class="fas fa-clock me-1"></i>
                                    Horario de atención: Lunes a Viernes de 8:00 a 16:00 hrs
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Información de Contacto -->
            <section id="contacto" class="mt-12">
                <div class="row g-6">
                    <div class="col-md-4">
                        <div class="text-center">
                            <i class="fas fa-map-marker-alt fs-2x text-guinda mb-3"></i>
                            <h5 class="fw-bold text-gray-800">Dirección</h5>
                            <p class="text-gray-600">Av. Francisco I. Madero Oriente No. 560<br>Col. Centro, Morelia, Michoacán</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center">
                            <i class="fas fa-phone fs-2x text-guinda mb-3"></i>
                            <h5 class="fw-bold text-gray-800">Teléfono</h5>
                            <p class="text-gray-600">(443) 432-2600<br>Ext. 1234, 1235</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center">
                            <i class="fas fa-envelope fs-2x text-guinda mb-3"></i>
                            <h5 class="fw-bold text-gray-800">Correo Electrónico</h5>
                            <p class="text-gray-600">denuncias@secoem.michoacan.gob.mx<br>secoem@michoacan.gob.mx</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Footer Oficial -->
        <footer>
            <div class="container footer-main">
                <div class="row">
                    <div class="col-lg-4 text-center">
                        <div class="footer-logo">
                            <img src="https://michoacan.gob.mx/images/logo-gris.png?1222259157" class="logoFooter"
                                alt="footer-logo">
                        </div>

                    </div>
                    <div class="col-lg-4 text-center">
                        <!-- Social Icons -->
                        <ul class="social-icons list-inline">
                            <li class="list-inline-item">
                                <br>
                                <a href="https://twitter.com/GobMichoacan" target="_blank"><i
                                        class="fab fa-2x fa-twitter"></i></a>&nbsp;&nbsp;
                            </li>
                            <li class="list-inline-item">
                                <br>
                                <a href="https://www.facebook.com/gobmichoacan/" target="_blank"><i
                                        class="fab fa-2x fa-facebook"></i></a>&nbsp;&nbsp;
                            </li>
                            <li class="list-inline-item">
                                <br>
                                <a href="https://www.instagram.com/gobmichoacan/?hl=es" target="_blank"><i
                                        class="fab fa-2x fa-instagram"></i></a>&nbsp;&nbsp;
                            </li>
                            <li class="list-inline-item">
                                <br>
                                <a href="https://t.me/GobiernodeMichoacan" target="_blank"><i
                                        class="fab fa-2x fa-telegram-plane"></i></a>&nbsp;&nbsp;
                            </li>
                            <li class="list-inline-item">
                                <br>
                                <a href="https://open.spotify.com/user/rr3zgtpveoxmy02i5t9bj9l7z" target="_blank"><i
                                        class="fab fa-2x fa-spotify"></i></a>&nbsp;&nbsp;
                            </li>
                        </ul>
                        <!-- Footer Links -->
                        <a href="http://smo.michoacan.gob.mx">Correo institucional</a><br>
                        <a href="https://michoacan.gob.mx/aviso-de-privacidad/">Aviso de privacidad</a> <br>
                    </div>
                    <div class="col-lg-4 text-center">
                        <br>
                        <h4 class="textoGris">#MichoacánEsMejor</h4>
                    </div>
                    <div class="col-12">
                        <hr>
                    </div>
                    <div class="col-12 text-center">
                        © Desarrollado por la Secretaría de Contraloría | <b class="textoGuinda">Gobierno del Estado de
                            Michoacán {{ date('Y') }}</b>
                    </div>
                </div>
            </div>
            <div class="container-fluid footer-pleca">
                <div class="row">
                    <div class="col">
                        <br><br>
                    </div>
                </div>
            </div>
        </footer>

    @endsection
</x-auth-layout>