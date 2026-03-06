<style>
    #scroll-navbar {
        transition: transform .25s ease, opacity .25s ease;
    }

    #scroll-navbar.d-none {
        opacity: 0;
        transform: translateY(-100%);
        display: block !important;
    }
</style>

<ul class="nav nav-pills d-flex container px-0" id="stepperTabs" role="tablist" style="gap:0;">
    <li class="nav-item flex-fill text-center calendar-options" role="presentation">
        <button disabled class="nav-link text-center active mx-auto" id="tab-option" data-bs-toggle="pill" data-bs-target="#pane-option" type="button">
            <div class="rounded-circle bg-primary-subtle border border-dark text-secondary d-flex align-items-center justify-content-center mx-auto">
                <i class="fas fa-list"></i>
            </div>
            <small class="d-xl-block d-none mt-2 text-muted" id="main_name">Lista de Plantillas</small>
        </button>
    </li>
    <li class="nav-item flex-fill text-center calendar-options" role="presentation">
        <button disabled class="nav-link text-center  mx-auto" id="tab-employee" data-bs-toggle="pill" data-bs-target="#pane-employee" type="button">
            <div class="rounded-circle bg-primary-subtle border border-dark text-secondary d-flex align-items-center justify-content-center mx-auto">
                <i class="fas fa-user"></i>
            </div>
            <small class="d-xl-block d-none mt-2 text-muted">Datos del Empleado</small>
        </button>
    </li>
    <li class="nav-item flex-fill text-center calendar-options" role="presentation">
        <button disabled class="nav-link text-center  mx-auto" id="tab-branches" data-bs-toggle="pill" data-bs-target="#pane-branches" type="button">
            <div class="rounded-circle bg-primary-subtle border border-dark text-secondary d-flex align-items-center justify-content-center mx-auto">
                <i class="fas fa-building"></i>
            </div>
            <small class="d-xl-block d-none mt-2 text-muted">Datos del Promotor</small>
        </button>
    </li>
    <li class="nav-item flex-fill text-center calendar-options" role="presentation">
        <button disabled class="nav-link text-center mx-auto" id="tab-services" data-bs-toggle="pill" data-bs-target="#pane-services" type="button">
            <div class="rounded-circle bg-primary-subtle border border-dark text-secondary d-flex align-items-center justify-content-center mx-auto">
                <i class="fas fa-clipboard-list"></i>
            </div>
            <small class="d-xl-block d-none mt-2 text-muted">Productos a Solicitar</small>
        </button>
    </li>
    <li class="nav-item flex-fill text-center calendar-options" role="presentation">
        <button disabled class="nav-link text-center mx-auto" id="tab-review" data-bs-toggle="pill" data-bs-target="#pane-review" type="button">
            <div class="rounded-circle bg-primary-subtle border border-dark text-secondary d-flex align-items-center justify-content-center mx-auto">
                <i class="fas fa-user"></i>
            </div>
            <small class="d-xl-block d-none mt-2 text-muted">Resumen de Solicitud</small>
        </button>
    </li>
</ul>


<nav id="scroll-navbar"
    class="navbar navbar-dark bg-dark fixed-top shadow-sm d-none transition">
    <div class="container">
        <div class="container">
            <ul class="nav nav-pills d-flex  px-0" id="stepperTabs" role="tablist" style="gap:0;">
                <li class="nav-item flex-fill text-center calendar-options" role="presentation">
                    <button disabled class="nav-link text-center active mx-auto" id="tab-branches" data-bs-toggle="pill" data-bs-target="#pane-branches" type="button">
                        <div class="rounded-circle bg-primary-subtle border border-dark text-secondary d-flex align-items-center justify-content-center mx-auto">
                            <i class="fas fa-building"></i>
                        </div>
                        <small class="d-xl-block d-none mt-2 text-muted">Sucursal</small>
                    </button>
                </li>
                <li class="nav-item flex-fill text-center calendar-options" role="presentation">
                    <button disabled class="nav-link text-center mx-auto" id="tab-services" data-bs-toggle="pill" data-bs-target="#pane-services" type="button">
                        <div class="rounded-circle bg-primary-subtle border border-dark text-secondary d-flex align-items-center justify-content-center mx-auto">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                        <small class="d-xl-block d-none mt-2 text-muted">Servicios</small>
                    </button>
                </li>
                <li class="nav-item flex-fill text-center calendar-options" role="presentation">
                    <button disabled class="nav-link text-center mx-auto" id="tab-review" data-bs-toggle="pill" data-bs-target="#pane-review" type="button">
                        <div class="rounded-circle bg-primary-subtle border border-dark text-secondary d-flex align-items-center justify-content-center mx-auto">
                            <i class="fas fa-user"></i>
                        </div>
                        <small class="d-xl-block d-none mt-2 text-muted">Información</small>
                    </button>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script>
    // document.addEventListener('DOMContentLoaded', () => {
    //     const navbar = document.getElementById('scroll-navbar');
    //     const trigger = document.getElementById('stepperTabs');

    //     if (!navbar || !trigger) return;
    //     const observer = new IntersectionObserver(
    //         ([entry]) => {
    //             if (entry.isIntersecting) {
    //                 // Back button visible → hide navbar
    //                 navbar.classList.add('d-none');
    //             } else {
    //                 // Back button hidden → show navbar
    //                 navbar.classList.remove('d-none');
    //             }
    //         }, {
    //             root: null,
    //             threshold: 0,
    //         }
    //     );
    //     observer.observe(trigger);
    // });
</script>