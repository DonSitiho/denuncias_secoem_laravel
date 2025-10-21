<x-auth-layout>
    @section('content')
        <!--begin::Container-->
        <div class="container py-10">
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-3 mb-1">Sistema de Denuncias Ciudadanas</span>
                        <span class="text-muted mt-1 fw-semibold fs-7">Complete el siguiente formulario para registrar su denuncia</span>
                    </h3>
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Form-->
                    <form class="form" novalidate="novalidate" id="kt_denuncia_form"
                        action="{{ route('denuncias.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!--begin::Sección 1: Datos del Denunciante -->
                        <div class="mb-15">
                            <!--begin::Heading-->
                            <div class="d-flex align-items-center mb-8">
                                <!--begin::Icon-->
                                <span class="svg-icon svg-icon-primary svg-icon-2hx me-4">
                                    <i class="fas fa-user fs-2 text-primary"></i>
                                </span>
                                <!--end::Icon-->
                                <!--begin::Title-->
                                <h2 class="fw-bolder text-gray-800 mb-0">Datos del Denunciante</h2>
                                <!--end::Title-->
                            </div>
                            <!--end::Heading-->

                            <div class="row">
                                <div class="col-md-12">
                                    <input type="hidden" name="es_anonima" value="0">
                                    <div class="form-check form-switch form-check-custom form-check-solid mb-10">
                                        <input class="form-check-input" type="checkbox" id="es_anonima"
                                            name="es_anonima" value="1" checked="checked">
                                        <label class="form-check-label fw-bold fs-6 text-gray-700" for="es_anonima">
                                            Realizar denuncia anónima
                                        </label>
                                    </div>

                                    <div id="contactoContainer" style="display: none;">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="fv-row mb-8">
                                                    <label class="form-label fs-6 fw-bold text-gray-700 required">Nombre completo</label>
                                                    <input type="text" class="form-control form-control-solid"
                                                        name="nombre_completo" placeholder="Ingrese su nombre completo" />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="fv-row mb-8">
                                                    <label class="form-label fs-6 fw-bold text-gray-700 required">Teléfono</label>
                                                    <input type="text" class="form-control form-control-solid"
                                                        name="telefono" placeholder="Ingrese su número telefónico" />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="fv-row mb-8">
                                                    <label class="form-label fs-6 fw-bold text-gray-700 required">Correo electrónico</label>
                                                    <input type="email" class="form-control form-control-solid"
                                                        name="correo_electronico"
                                                        placeholder="Ingrese su correo electrónico" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Sección 1-->

                        <!--begin::Separator-->
                        <div class="separator separator-dashed my-10"></div>
                        <!--end::Separator-->

                        <!--begin::Sección 2: Datos del Hecho -->
                        <div class="mb-15">
                            <!--begin::Heading-->
                            <div class="d-flex align-items-center mb-8">
                                <!--begin::Icon-->
                                <span class="svg-icon svg-icon-warning svg-icon-2hx me-4">
                                    <i class="fas fa-exclamation-triangle fs-2 text-warning"></i>
                                </span>
                                <!--end::Icon-->
                                <!--begin::Title-->
                                <h2 class="fw-bolder text-gray-800 mb-0">Hechos Denunciados</h2>
                                <!--end::Title-->
                            </div>
                            <!--end::Heading-->

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="fv-row mb-8">
                                        <label class="form-label fs-6 fw-bold text-gray-700 required">Motivo de la denuncia</label>
                                        <textarea class="form-control form-control-solid" name="motivo_denuncia" rows="3"
                                            placeholder="Describa el motivo principal de su denuncia" required></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="fv-row mb-8">
                                        <label class="form-label fs-6 fw-bold text-gray-700 required">Fecha de los hechos</label>
                                        <input type="date" class="form-control form-control-solid" name="fecha_hechos"
                                            required />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="fv-row mb-8">
                                        <label class="form-label fs-6 fw-bold text-gray-700">Hora de los hechos</label>
                                        <input type="time" class="form-control form-control-solid" name="hora_hechos"
                                            placeholder="HH:MM" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="fv-row mb-8">
                                        <label class="form-label fs-6 fw-bold text-gray-700">Municipio</label>
                                        <select class="form-select form-select-solid" name="id_municipio">
                                            <option value="">Seleccione un municipio...</option>
                                            @foreach ($municipios as $mun)
                                                <option value="{{ $mun->id_municipio }}">{{ $mun->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="fv-row mb-8">
                                        <label class="form-label fs-6 fw-bold text-gray-700 required">Dirección exacta</label>
                                        <input type="text" class="form-control form-control-solid"
                                            name="direccion_exacta"
                                            placeholder="Dirección exacta donde ocurrieron los hechos" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="fv-row mb-8">
                                        <label class="form-label fs-6 fw-bold text-gray-700">Localidad</label>
                                        <input type="text" class="form-control form-control-solid"
                                            name="localidad" placeholder="Localidad o colonia" />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="fv-row mb-8">
                                        <label class="form-label fs-6 fw-bold text-gray-700">Dependencia involucrada</label>
                                        <input type="text" class="form-control form-control-solid"
                                            name="dependencia_involucrada" placeholder="Dependencia gubernamental involucrada" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="fv-row mb-8">
                                        <label class="form-label fs-6 fw-bold text-gray-700">Trámite solicitado</label>
                                        <input type="text" class="form-control form-control-solid"
                                            name="tramite_solicitado" placeholder="Trámite o servicio relacionado" />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="fv-row mb-8">
                                        <label class="form-label fs-6 fw-bold text-gray-700">Circunstancias detalladas</label>
                                        <textarea class="form-control form-control-solid" name="circunstancias_detalladas" rows="4"
                                            placeholder="Describa con el mayor detalle posible los hechos ocurridos, incluyendo personas involucradas, testigos, y cualquier información relevante"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Sección 2-->

                        <!--begin::Separator-->
                        <div class="separator separator-dashed my-10"></div>
                        <!--end::Separator-->

                        <!--begin::Sección 3: Personas Involucradas -->
                        <div class="mb-15">
                            <!--begin::Heading-->
                            <div class="d-flex align-items-center mb-8">
                                <!--begin::Icon-->
                                <span class="svg-icon svg-icon-danger svg-icon-2hx me-4">
                                    <i class="fas fa-users fs-2 text-danger"></i>
                                </span>
                                <!--end::Icon-->
                                <!--begin::Title-->
                                <h2 class="fw-bolder text-gray-800 mb-0">Personas Involucradas</h2>
                                <!--end::Title-->
                            </div>
                            <!--end::Heading-->

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="fv-row mb-8">
                                        <label class="form-label fs-6 fw-bold text-gray-700">Involucrados</label>
                                        <div id="involucrados-container">
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" name="involucrados[]" placeholder="Nombre del involucrado">
                                                <button type="button" class="btn btn-icon btn-light-danger remove-field">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-light-primary" id="add-involucrado">
                                            <i class="fas fa-plus me-2"></i>Agregar involucrado
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="fv-row mb-8">
                                        <label class="form-label fs-6 fw-bold text-gray-700">Testigos</label>
                                        <div id="testigos-container">
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" name="testigos[]" placeholder="Nombre del testigo">
                                                <button type="button" class="btn btn-icon btn-light-danger remove-field">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-light-primary" id="add-testigo">
                                            <i class="fas fa-plus me-2"></i>Agregar testigo
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Sección 3-->

                        <!--begin::Separator-->
                        <div class="separator separator-dashed my-10"></div>
                        <!--end::Separator-->

                        <!--begin::Sección 4: Evidencias -->
                        <div class="mb-15">
                            <!--begin::Heading-->
                            <div class="d-flex align-items-center mb-8">
                                <!--begin::Icon-->
                                <span class="svg-icon svg-icon-info svg-icon-2hx me-4">
                                    <i class="fas fa-paperclip fs-2 text-info"></i>
                                </span>
                                <!--end::Icon-->
                                <!--begin::Title-->
                                <h2 class="fw-bolder text-gray-800 mb-0">Evidencias y Archivos</h2>
                                <!--end::Title-->
                            </div>
                            <!--end::Heading-->

                            <div class="fv-row mb-8">
                                <label class="form-label fs-6 fw-bold text-gray-700">Adjuntar archivos</label>
                                <input type="file" name="archivos[]" class="form-control form-control-solid"
                                    multiple accept=".pdf,.jpg,.jpeg,.png,.doc,.docx,.mp4,.avi,.mov" />
                                <div class="text-muted mt-2 fs-7">
                                    <i class="fas fa-info-circle text-info me-2"></i>
                                    Formatos permitidos: PDF, JPG, PNG, DOC, DOCX, MP4, AVI, MOV. Tamaño máximo por archivo: 10MB.
                                </div>
                            </div>
                        </div>
                        <!--end::Sección 4-->

                        <!--begin::Separator-->
                        <div class="separator separator-dashed my-10"></div>
                        <!--end::Separator-->

                        <!--begin::Sección 5: Confirmación -->
                        <div class="mb-15">
                            <!--begin::Heading-->
                            <div class="d-flex align-items-center mb-8">
                                <!--begin::Icon-->
                                <span class="svg-icon svg-icon-success svg-icon-2hx me-4">
                                    <i class="fas fa-check-circle fs-2 text-success"></i>
                                </span>
                                <!--end::Icon-->
                                <!--begin::Title-->
                                <h2 class="fw-bolder text-gray-800 mb-0">Confirmación Final</h2>
                                <!--end::Title-->
                            </div>
                            <!--end::Heading-->

                            <div class="fv-row mb-8">
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" id="confirmacion_datos" required />
                                    <label class="form-check-label fw-semibold fs-6 text-gray-700" for="confirmacion_datos">
                                        Confirmo bajo protesta de decir verdad que toda la información proporcionada es verídica, exacta y completa. 
                                        Acepto los términos y condiciones del sistema de denuncias y comprendo que proporcionar información falsa 
                                        puede tener consecuencias legales.
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!--end::Sección 5-->

                        <!--begin::Acciones-->
                        <div class="d-flex justify-content-end pt-10">
                            <button type="reset" class="btn btn-lg btn-light me-5">
                                <i class="fas fa-eraser me-2"></i>
                                Limpiar Formulario
                            </button>
                            <button type="submit" class="btn btn-lg btn-primary">
                                <i class="fas fa-paper-plane me-2"></i>
                                Enviar Denuncia
                            </button>
                        </div>
                        <!--end::Acciones-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Toggle para denuncia anónima
                const esAnonimaCheckbox = document.getElementById("es_anonima");
                const contactoContainer = document.getElementById("contactoContainer");

                if (esAnonimaCheckbox && contactoContainer) {
                    function toggleContactoFields() {
                        const contactoInputs = contactoContainer.querySelectorAll("input");

                        if (esAnonimaCheckbox.checked) {
                            contactoContainer.style.display = "none";
                            contactoInputs.forEach(input => {
                                input.value = "";
                                input.removeAttribute("required");
                                input.classList.remove("is-invalid");
                                
                                // Limpiar mensajes de error
                                const errorMsg = input.parentNode.querySelector('.invalid-feedback');
                                if (errorMsg) errorMsg.remove();
                            });
                        } else {
                            contactoContainer.style.display = "block";
                            contactoInputs.forEach(input => {
                                input.setAttribute("required", "");
                            });
                        }
                    }

                    // Ejecutar en carga inicial
                    toggleContactoFields();

                    // Ejecutar al cambiar el checkbox
                    esAnonimaCheckbox.addEventListener("change", toggleContactoFields);
                }

                // Funcionalidad para campos dinámicos de arrays
                function setupDynamicFields(addButtonId, containerId, placeholder) {
                    const addButton = document.getElementById(addButtonId);
                    const container = document.getElementById(containerId);

                    if (addButton && container) {
                        addButton.addEventListener('click', function() {
                            const newField = document.createElement('div');
                            newField.className = 'input-group mb-2';
                            newField.innerHTML = `
                                <input type="text" class="form-control" name="${containerId.replace('-container', '[]')}" placeholder="${placeholder}">
                                <button type="button" class="btn btn-icon btn-light-danger remove-field">
                                    <i class="fas fa-minus"></i>
                                </button>
                            `;
                            container.appendChild(newField);
                        });

                        // Delegación de eventos para botones de eliminar
                        container.addEventListener('click', function(e) {
                            if (e.target.closest('.remove-field')) {
                                const fieldGroup = e.target.closest('.input-group');
                                if (fieldGroup && container.querySelectorAll('.input-group').length > 1) {
                                    fieldGroup.remove();
                                }
                            }
                        });
                    }
                }

                // Configurar campos dinámicos
                setupDynamicFields('add-involucrado', 'involucrados-container', 'Nombre del involucrado');
                setupDynamicFields('add-testigo', 'testigos-container', 'Nombre del testigo');

                // Validación del formulario
                const form = document.getElementById("kt_denuncia_form");
                if (form) {
                    form.addEventListener("submit", function(e) {
                        e.preventDefault();

                        // Limpiar errores previos
                        clearErrors();

                        // Validar formulario
                        if (validateForm()) {
                            // Mostrar confirmación
                            Swal.fire({
                                title: "¿Confirmar envío de denuncia?",
                                text: "Una vez enviada, recibirá un folio de seguimiento para consultar el estado de su denuncia.",
                                icon: "question",
                                showCancelButton: true,
                                confirmButtonText: "Sí, enviar denuncia",
                                cancelButtonText: "Revisar información",
                                reverseButtons: true,
                                customClass: {
                                    confirmButton: 'btn btn-primary',
                                    cancelButton: 'btn btn-light'
                                }
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Enviar el formulario
                                    form.submit();
                                }
                            });
                        }
                    });
                }

                // Función para validar el formulario completo
                function validateForm() {
                    let isValid = true;

                    // Validar datos del denunciante si NO es anónima
                    const esAnonima = document.getElementById('es_anonima').checked;
                    if (!esAnonima) {
                        const camposContacto = [
                            { field: document.querySelector('[name="nombre_completo"]'), name: "Nombre completo" },
                            { field: document.querySelector('[name="telefono"]'), name: "Teléfono" },
                            { field: document.querySelector('[name="correo_electronico"]'), name: "Correo electrónico" }
                        ];

                        camposContacto.forEach(campo => {
                            if (!campo.field.value.trim()) {
                                showError(campo.field, `${campo.name} es requerido`);
                                isValid = false;
                            } else if (campo.name === "Correo electrónico" && !isValidEmail(campo.field.value)) {
                                showError(campo.field, "Ingrese un correo electrónico válido");
                                isValid = false;
                            }
                        });
                    }

                    // Validar campos requeridos principales
                    const camposRequeridos = [
                        { field: document.querySelector('[name="motivo_denuncia"]'), name: "Motivo de la denuncia" },
                        { field: document.querySelector('[name="fecha_hechos"]'), name: "Fecha de los hechos" },
                        { field: document.querySelector('[name="direccion_exacta"]'), name: "Dirección exacta" }
                    ];

                    camposRequeridos.forEach(campo => {
                        if (!campo.field.value.trim()) {
                            showError(campo.field, `${campo.name} es requerido`);
                            isValid = false;
                        }
                    });

                    // Validar fecha no futura
                    const fechaHechos = document.querySelector('[name="fecha_hechos"]');
                    if (fechaHechos.value) {
                        const fechaIngresada = new Date(fechaHechos.value);
                        const hoy = new Date();
                        hoy.setHours(0, 0, 0, 0);
                        
                        if (fechaIngresada > hoy) {
                            showError(fechaHechos, "La fecha no puede ser futura");
                            isValid = false;
                        }
                    }

                    // Validar confirmación
                    const confirmacionCheckbox = document.getElementById("confirmacion_datos");
                    if (!confirmacionCheckbox.checked) {
                        showError(confirmacionCheckbox, "Debe confirmar que la información es verídica");
                        isValid = false;
                    }

                    if (!isValid) {
                        // Scroll al primer error
                        const firstError = document.querySelector('.is-invalid');
                        if (firstError) {
                            firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        }

                        Swal.fire({
                            icon: "warning",
                            title: "Campos requeridos",
                            text: "Por favor complete todos los campos obligatorios marcados en rojo.",
                            confirmButtonText: "Entendido"
                        });
                    }

                    return isValid;
                }

                // Función para mostrar errores
                function showError(field, message) {
                    field.classList.add("is-invalid");
                    
                    // Remover mensaje de error previo
                    let existingError = field.parentNode.querySelector('.invalid-feedback');
                    if (existingError) {
                        existingError.remove();
                    }
                    
                    // Crear nuevo mensaje de error
                    let errorMessage = document.createElement('div');
                    errorMessage.className = 'invalid-feedback';
                    errorMessage.textContent = message;
                    errorMessage.style.display = 'block';
                    
                    field.parentNode.appendChild(errorMessage);
                }

                // Función para limpiar errores
                function clearErrors() {
                    const invalidFields = document.querySelectorAll('.is-invalid');
                    invalidFields.forEach(field => {
                        field.classList.remove('is-invalid');
                        const errorMsg = field.parentNode.querySelector('.invalid-feedback');
                        if (errorMsg) errorMsg.remove();
                    });
                }

                // Función para validar email
                function isValidEmail(email) {
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    return emailRegex.test(email);
                }

                // Botón limpiar formulario
                const resetButton = form.querySelector('button[type="reset"]');
                if (resetButton) {
                    resetButton.addEventListener("click", function() {
                        Swal.fire({
                            title: "¿Limpiar formulario?",
                            text: "Se perderán todos los datos ingresados.",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonText: "Sí, limpiar",
                            cancelButtonText: "Cancelar",
                            reverseButtons: true
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.reset();
                                clearErrors();
                                // Restablecer el estado de denuncia anónima
                                if (esAnonimaCheckbox) {
                                    esAnonimaCheckbox.checked = true;
                                    toggleContactoFields();
                                }
                                // Limpiar campos dinámicos (dejar solo uno)
                                const clearDynamicContainer = (containerId) => {
                                    const container = document.getElementById(containerId);
                                    if (container) {
                                        container.innerHTML = `
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" name="${containerId.replace('-container', '[]')}" placeholder="${containerId === 'involucrados-container' ? 'Nombre del involucrado' : 'Nombre del testigo'}">
                                                <button type="button" class="btn btn-icon btn-light-danger remove-field">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                        `;
                                    }
                                };
                                
                                clearDynamicContainer('involucrados-container');
                                clearDynamicContainer('testigos-container');
                                
                                Swal.fire({
                                    icon: "success",
                                    title: "Formulario limpiado",
                                    text: "Todos los campos han sido restablecidos.",
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                            }
                        });
                    });
                }
            });
        </script>
    @endsection
</x-auth-layout>