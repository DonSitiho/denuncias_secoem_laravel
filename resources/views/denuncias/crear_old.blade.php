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
                        <span class="text-muted mt-1 fw-semibold fs-7">Complete los siguientes pasos para registrar su
                            denuncia</span>
                    </h3>
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Stepper-->
                    <div class="stepper stepper-pills stepper-column d-flex flex-column flex-xl-row flex-row-fluid"
                        id="kt_stepper_denuncia">
                        <!--begin::Aside-->
                        <div class="d-flex justify-content-center justify-content-xl-start flex-row-auto w-100 w-xl-300px">
                            <!--begin::Nav-->
                            <div class="stepper-nav px-10 px-lg-20 py-10">
                                <!--begin::Step 1-->
                                <div class="stepper-item current" data-kt-stepper-element="nav">
                                    <div class="stepper-wrapper">
                                        <div class="stepper-icon w-40px h-40px">
                                            <i class="stepper-check fas fa-check"></i>
                                            <span class="stepper-number">1</span>
                                        </div>
                                        <div class="stepper-label">
                                            <h3 class="stepper-title">Datos del Denunciante</h3>
                                            <div class="stepper-desc">Información personal</div>
                                        </div>
                                    </div>
                                    <div class="stepper-line h-40px"></div>
                                </div>
                                <!--end::Step 1-->

                                <!--begin::Step 2-->
                                <div class="stepper-item" data-kt-stepper-element="nav">
                                    <div class="stepper-wrapper">
                                        <div class="stepper-icon w-40px h-40px">
                                            <i class="stepper-check fas fa-check"></i>
                                            <span class="stepper-number">2</span>
                                        </div>
                                        <div class="stepper-label">
                                            <h3 class="stepper-title">Datos del Denunciado</h3>
                                            <div class="stepper-desc">Información del funcionario</div>
                                        </div>
                                    </div>
                                    <div class="stepper-line h-40px"></div>
                                </div>
                                <!--end::Step 2-->

                                <!--begin::Step 3-->
                                <div class="stepper-item" data-kt-stepper-element="nav">
                                    <div class="stepper-wrapper">
                                        <div class="stepper-icon w-40px h-40px">
                                            <i class="stepper-check fas fa-check"></i>
                                            <span class="stepper-number">3</span>
                                        </div>
                                        <div class="stepper-label">
                                            <h3 class="stepper-title">Hechos Denunciados</h3>
                                            <div class="stepper-desc">Descripción detallada</div>
                                        </div>
                                    </div>
                                    <div class="stepper-line h-40px"></div>
                                </div>
                                <!--end::Step 3-->

                                <!--begin::Step 4-->
                                <div class="stepper-item" data-kt-stepper-element="nav">
                                    <div class="stepper-wrapper">
                                        <div class="stepper-icon w-40px h-40px">
                                            <i class="stepper-check fas fa-check"></i>
                                            <span class="stepper-number">4</span>
                                        </div>
                                        <div class="stepper-label">
                                            <h3 class="stepper-title">Evidencias</h3>
                                            <div class="stepper-desc">Archivos adjuntos</div>
                                        </div>
                                    </div>
                                    <div class="stepper-line h-40px"></div>
                                </div>
                                <!--end::Step 4-->

                                <!--begin::Step 5-->
                                <div class="stepper-item" data-kt-stepper-element="nav">
                                    <div class="stepper-wrapper">
                                        <div class="stepper-icon w-40px h-40px">
                                            <i class="stepper-check fas fa-check"></i>
                                            <span class="stepper-number">5</span>
                                        </div>
                                        <div class="stepper-label">
                                            <h3 class="stepper-title">Confirmación</h3>
                                            <div class="stepper-desc">Revisión final</div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Step 5-->
                            </div>
                            <!--end::Nav-->
                        </div>
                        <!--end::Aside-->

                        <!--begin::Content-->
                        <div class="flex-row-fluid py-10">
                            <!--begin::Form-->
                            <form class="form" novalidate="novalidate" id="kt_stepper_denuncia_form"
                                action="{{ route('denuncias.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <!--begin::Step 1-->
                                <div class="flex-column current" data-kt-stepper-element="content">
                                    <div class="row mb-5">
                                        <div class="col-md-12">
                                            <h2 class="fw-bolder text-gray-800">Datos del Denunciante</h2>
                                            <div class="text-muted">Proporcione su información personal o seleccione
                                                denuncia anónima</div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="hidden" name="es_anonima" value="0">
                                            <div class="form-check form-switch form-check-custom form-check-solid mb-10">
                                                <input class="form-check-input" type="checkbox" id="es_anonima"
                                                    name="es_anonima" value="1" checked="checked">
                                                <label class="form-check-label fw-bold" for="es_anonima">
                                                    Denuncia Anónima
                                                </label>
                                            </div>

                                            <div id="contactoContainer" style="display: none;">
                                                <div class="fv-row mb-10">
                                                    <label class="form-label">Nombre completo</label>
                                                    <input type="text" class="form-control form-control-solid"
                                                        name="nombre_completo" placeholder="Ingrese su nombre completo" />
                                                </div>
                                                <div class="fv-row mb-10">
                                                    <label class="form-label">Teléfono</label>
                                                    <input type="text" class="form-control form-control-solid"
                                                        name="telefono" placeholder="Ingrese su número telefónico" />
                                                </div>
                                                <div class="fv-row mb-10">
                                                    <label class="form-label">Correo electrónico</label>
                                                    <input type="email" class="form-control form-control-solid"
                                                        name="correo_electronico"
                                                        placeholder="Ingrese su correo electrónico" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Step 1-->

                                <!--begin::Step 2-->
                                <div class="flex-column" data-kt-stepper-element="content">
                                    <div class="row mb-5">
                                        <div class="col-md-12">
                                            <h2 class="fw-bolder text-gray-800">Datos del Denunciado</h2>
                                            <div class="text-muted">Información de la persona o funcionario denunciado
                                            </div>
                                        </div>
                                    </div>

                                    <div class="fv-row mb-10">
                                        <label class="form-label required">Nombre completo del denunciado</label>
                                        <input type="text" class="form-control form-control-solid"
                                            name="nombre_denunciado" placeholder="Nombre del denunciado" required />
                                    </div>
                                    <div class="fv-row mb-10">
                                        <label class="form-label">Puesto</label>
                                        <input type="text" class="form-control form-control-solid"
                                            name="puesto_denunciado" placeholder="Puesto del denunciado" />
                                    </div>
                                    <div class="fv-row mb-10">
                                        <label class="form-label">Dependencia involucrada</label>
                                        <input type="text" class="form-control form-control-solid"
                                            name="dependencia_involucrada" placeholder="Dependencia donde labora" />
                                    </div>
                                </div>
                                <!--end::Step 2-->

                                <!--begin::Step 3-->
                                <div class="flex-column" data-kt-stepper-element="content">
                                    <div class="row mb-5">
                                        <div class="col-md-12">
                                            <h2 class="fw-bolder text-gray-800">Hechos Denunciados</h2>
                                            <div class="text-muted">Describa detalladamente los hechos que motiva su
                                                denuncia</div>
                                        </div>
                                    </div>

                                    <div class="fv-row mb-10">
                                        <label class="form-label required">Motivo de la denuncia</label>
                                        <textarea class="form-control form-control-solid" name="motivo_denuncia" rows="3"
                                            placeholder="Describa el motivo principal de su denuncia" required></textarea>
                                    </div>
                                    <div class="fv-row mb-10">
                                        <label class="form-label required">Fecha de los hechos</label>
                                        <input type="date" class="form-control form-control-solid" name="fecha_hechos"
                                            required />
                                    </div>
                                    <div class="fv-row mb-10">
                                        <label class="form-label required">Municipio</label>
                                        <select class="form-select form-select-solid" name="id_municipio" required>
                                            <option value="">Seleccione un municipio...</option>
                                            @foreach ($municipios as $mun)
                                                <option value="{{ $mun->id_municipio }}">{{ $mun->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="fv-row mb-10">
                                        <label class="form-label required">Dirección o lugar de los hechos</label>
                                        <input type="text" class="form-control form-control-solid"
                                            name="direccion_exacta"
                                            placeholder="Dirección exacta donde ocurrieron los hechos" required />
                                    </div>
                                    <div class="fv-row mb-10">
                                        <label class="form-label required">Descripción detallada de los hechos</label>
                                        <textarea class="form-control form-control-solid" name="circunstancias_detalladas" rows="4"
                                            placeholder="Describa con el mayor detalle posible los hechos ocurridos" required></textarea>
                                    </div>
                                </div>
                                <!--end::Step 3-->

                                <!--begin::Step 4-->
                                <div class="flex-column" data-kt-stepper-element="content">
                                    <div class="row mb-5">
                                        <div class="col-md-12">
                                            <h2 class="fw-bolder text-gray-800">Evidencias y Archivos</h2>
                                            <div class="text-muted">Adjunte los archivos que respalden su denuncia
                                                (opcional)</div>
                                        </div>
                                    </div>

                                    <div class="fv-row mb-10">
                                        <label class="form-label">Adjuntar archivos</label>
                                        <input type="file" name="archivos[]" class="form-control form-control-solid"
                                            multiple accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" />
                                        <div class="text-muted mt-2">Formatos permitidos: PDF, JPG, PNG, DOC, DOCX. Tamaño
                                            máximo por archivo: 10MB.</div>
                                    </div>

                                    <div class="alert alert-info d-flex align-items-center p-5">
                                        <span class="svg-icon svg-icon-2hx svg-icon-info me-4">
                                            <i class="fas fa-info-circle fs-2"></i>
                                        </span>
                                        <div class="d-flex flex-column">
                                            <h4 class="mb-1 text-info">Información importante</h4>
                                            <span>Las evidencias son opcionales pero pueden fortalecer su denuncia.
                                                Asegúrese de que los archivos sean legibles y relevantes para el
                                                caso.</span>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Step 4-->

                                <!--begin::Step 5-->
                                <div class="flex-column" data-kt-stepper-element="content">
                                    <div class="row mb-5">
                                        <div class="col-md-12">
                                            <h2 class="fw-bolder text-gray-800">Confirmación de Denuncia</h2>
                                            <div class="text-muted">Revise cuidadosamente toda la información antes de
                                                enviar</div>
                                        </div>
                                    </div>

                                    <div class="card card-flush bg-light-success mb-10">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <span class="svg-icon svg-icon-2hx svg-icon-success me-4">
                                                    <i class="fas fa-check-circle fs-2 text-success"></i>
                                                </span>
                                                <div class="d-flex flex-column">
                                                    <h4 class="mb-1 text-success">¡Está a punto de enviar su denuncia!</h4>
                                                    <span class="text-gray-700">Una vez enviada, recibirá un folio de
                                                        seguimiento para consultar el estado de su denuncia en cualquier
                                                        momento.</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="fv-row mb-10">
                                        <div class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" id="confirmacion_datos"
                                                required />
                                            <label class="form-check-label fw-semibold" for="confirmacion_datos">
                                                Confirmo que toda la información proporcionada es verídica y acepto los
                                                términos y condiciones del sistema de denuncias.
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Step 5-->

                                <!--begin::Actions-->
                                <div class="d-flex flex-stack pt-15">
                                    <div class="me-2">
                                        <button type="button" class="btn btn-lg btn-light-primary"
                                            data-kt-stepper-action="previous">
                                            <i class="fas fa-arrow-left me-2"></i>
                                            Anterior
                                        </button>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-lg btn-primary me-3"
                                            data-kt-stepper-action="next">
                                            Siguiente
                                            <i class="fas fa-arrow-right ms-2"></i>
                                        </button>
                                        <button type="submit" class="btn btn-lg btn-success d-none"
                                            data-kt-stepper-action="submit">
                                            <i class="fas fa-paper-plane me-2"></i>
                                            Enviar Denuncia
                                        </button>
                                    </div>
                                </div>
                                <!--end::Actions-->
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Stepper-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Inicializar el stepper
                const stepperElement = document.querySelector("#kt_stepper_denuncia");

                if (!stepperElement) {
                    console.error("No se encontró el elemento del stepper");
                    return;
                }

                const stepper = new KTStepper(stepperElement);

                // Manejar el cambio entre pasos
                stepper.on("kt.stepper.changed", function(stepper) {
                    const currentStepIndex = stepper.getCurrentStepIndex();
                    const submitButton = document.querySelector('[data-kt-stepper-action="submit"]');
                    const nextButton = document.querySelector('[data-kt-stepper-action="next"]');

                    console.log("Paso actual:", currentStepIndex);

                    // Mostrar botón de enviar solo en el último paso
                    if (currentStepIndex === 4) { // Paso 5 (índice 4)
                        submitButton.classList.remove("d-none");
                        nextButton.classList.add("d-none");
                    } else {
                        submitButton.classList.add("d-none");
                        nextButton.classList.remove("d-none");
                    }

                    // Actualizar la navegación
                    updateStepperNavigation(stepper);
                });

                // Manejar el botón siguiente
                stepper.on("kt.stepper.next", function(stepper) {
                    console.log("Botón siguiente presionado. Paso actual:", stepper.getCurrentStepIndex());
                    // Validar el paso actual antes de continuar
                    if (validateCurrentStep(stepper.getCurrentStepIndex())) {
                        stepper.goNext();
                    } else {
                        console.log("Validación falló en el paso", stepper.getCurrentStepIndex());
                    }
                });

                // Manejar el botón anterior
                stepper.on("kt.stepper.previous", function(stepper) {
                    stepper.goPrevious();
                });

                // Toggle para denuncia anónima
                // Toggle para denuncia anónima
const esAnonimaCheckbox = document.getElementById("es_anonima");
const contactoContainer = document.getElementById("contactoContainer");

if (esAnonimaCheckbox && contactoContainer) {
    // Función para actualizar visibilidad y atributos
    function toggleContactoFields() {
        const contactoInputs = contactoContainer.querySelectorAll("input");

        if (esAnonimaCheckbox.checked) {
            contactoContainer.style.display = "none";

            contactoInputs.forEach(input => {
                input.value = "";
                input.removeAttribute("required");
            });
        } else {
            contactoContainer.style.display = "block";

            // Solo añade 'required' si así lo deseas
            contactoContainer.querySelector('[name="nombre_completo"]').setAttribute("required", "");
            contactoContainer.querySelector('[name="telefono"]').setAttribute("required", "");
            contactoContainer.querySelector('[name="correo_electronico"]').setAttribute("required", "");
        }
    }

    // Ejecutar en carga inicial (ya viene marcada como anónima)
    toggleContactoFields();

    // Ejecutar al cambiar el checkbox
    esAnonimaCheckbox.addEventListener("change", toggleContactoFields);
}

                // Manejar el envío del formulario
                const form = document.getElementById("kt_stepper_denuncia_form");
                if (form) {
                    form.addEventListener("submit", function(e) {
                        e.preventDefault();

                        // Validar el checkbox de confirmación en el último paso
                        const confirmacionCheckbox = document.getElementById("confirmacion_datos");
                        if (stepper.getCurrentStepIndex() === 4 && (!confirmacionCheckbox || !
                                confirmacionCheckbox.checked)) {
                            Swal.fire({
                                icon: "warning",
                                title: "Confirmación requerida",
                                text: "Debe confirmar que la información es verídica antes de enviar la denuncia.",
                                confirmButtonText: "Entendido"
                            });
                            return;
                        }

                        // Mostrar confirmación
                        Swal.fire({
                            title: "¿Confirmar envío de denuncia?",
                            text: "Una vez enviada, recibirás un folio de seguimiento para consultar el estado de tu denuncia.",
                            icon: "question",
                            showCancelButton: true,
                            confirmButtonText: "Sí, enviar denuncia",
                            cancelButtonText: "Cancelar",
                            reverseButtons: true
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Mostrar carga
                                Swal.fire({
                                    title: "Enviando denuncia...",
                                    text: "Por favor espere un momento.",
                                    allowOutsideClick: false,
                                    didOpen: () => {
                                        Swal.showLoading();
                                    }
                                });

                                // Enviar el formulario
                                setTimeout(() => {
                                    form.submit();
                                }, 1000);
                            }
                        });
                    });
                }

                // Función para validar el paso actual
                function validateCurrentStep(stepIndex) {
                    console.log("Validando paso:", stepIndex);
                    const currentStep = stepperElement.querySelectorAll('[data-kt-stepper-element="content"]')[
                        stepIndex];
                    if (!currentStep) {
                        console.error("No se encontró el paso", stepIndex);
                        return false;
                    }
                    const requiredFields = currentStep.querySelectorAll('[required]');
                    console.log("Campos requeridos en el paso", stepIndex, ":", requiredFields.length);

                    // Si no hay campos requeridos, retornar true
                    if (requiredFields.length === 0) {
                        console.log("No hay campos requeridos en el paso", stepIndex, "- validación aprobada.");
                        return true;
                    }

                    let isValid = true;

                    requiredFields.forEach(field => {
                        if (!field.value.trim()) {
                            isValid = false;
                            field.classList.add("is-invalid");

                            // Remover la clase después de un tiempo
                            setTimeout(() => {
                                field.classList.remove("is-invalid");
                            }, 3000);
                        } else {
                            field.classList.remove("is-invalid");
                        }
                    });

                    if (!isValid) {
                        Swal.fire({
                            icon: "warning",
                            title: "Campos requeridos",
                            text: "Por favor complete todos los campos obligatorios antes de continuar.",
                            confirmButtonText: "Entendido"
                        });
                    }

                    return isValid;
                }

                // Función para actualizar la navegación del stepper
                function updateStepperNavigation(stepper) {
                    const steps = stepperElement.querySelectorAll('.stepper-item');
                    steps.forEach((step, index) => {
                        if (index < stepper.getCurrentStepIndex()) {
                            step.classList.add('completed');
                            step.classList.remove('current');
                        } else if (index === stepper.getCurrentStepIndex()) {
                            step.classList.add('current');
                            step.classList.remove('completed');
                        } else {
                            step.classList.remove('current', 'completed');
                        }
                    });
                }

                console.log("Stepper inicializado correctamente");
            });
        </script>
    @endsection
</x-auth-layout>
