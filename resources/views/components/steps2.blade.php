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
        <button disabled class="nav-link text-center active mx-auto" id="tab-info" data-bs-toggle="pill" data-bs-target="#pane-info" type="button">
            <div class="rounded-circle bg-primary-subtle border border-dark text-secondary d-flex align-items-center justify-content-center mx-auto">
                <i class="fas fa-building"></i>
            </div>
            <small class="d-xl-block d-none mt-2 text-muted">Revisión de Almacén</small>
        </button>
    </li>
    <li class="nav-item flex-fill text-center calendar-options" role="presentation">
        <button disabled class="nav-link text-center mx-auto" id="tab-confirm" data-bs-toggle="pill" data-bs-target="#pane-confirm" type="button">
            <div class="rounded-circle bg-primary-subtle border border-dark text-secondary d-flex align-items-center justify-content-center mx-auto">
                <i class="fas fa-clipboard-list"></i>
            </div>
            <small class="d-xl-block d-none mt-2 text-muted">Resumen</small>
        </button>
    </li>
</ul>


<!-- <nav id="scroll-navbar"
    class="navbar navbar-dark bg-dark fixed-top shadow-sm d-none transition">
    <div class="container">
        <div class="container">
            <ul class="nav nav-pills d-flex  px-0" id="stepperTabs" role="tablist" style="gap:0;">
                <li class="nav-item flex-fill text-center calendar-options" role="presentation">
                    <button disabled class="nav-link text-center active mx-auto" id="tab-info" data-bs-toggle="pill" data-bs-target="#pane-info" type="button">
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
</nav> -->

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