<nav id="navbar-top" class="navbar navbar-expand-lg navbar-dark text-bg-dark fixed-top border-bottom" aria-label="Offcanvas navbar large">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between container">
            <a class="navbar-brand" href="{{env('APP_URL')}}">
                <img src="{{$logo}}" id="main_img" width="150" alt="">

            </a>
            <div class="ms-auto w-100 text-end">
                <span class="badge text-bg-primary" id="template_badge"></span>
            </div>
            <!-- <a href="#" class="position-relative">
                <button id="themeToggle" class="btn btn-primary">
                    <i class="fas fa-sun"></i>
                </button>
            </a> -->
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation"><i class="fas fa-bars-staggered text-dark"></i></button>
            <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <a class="navbar-brand" href="{{env('APP_URL')}}">
                        <!-- <img src="{{asset('img/logo.svg')}}" width="200" alt=""> -->
                        <img src="{{asset('img/logo.png')}}" width="150" alt="">
                    </a>
                    <button type="button" class="btn btn-dark ms-auto" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fas fa-xmark fa-lg text-dark"></i></button>
                </div>
                <div class="offcanvas-body">
                    <!-- <ul class="navbar-nav justify-content-end flex-grow-1">
                        <li class="nav-item py-2">
                            <a class="btn btn-primary fw-bold" href="#">Ver tutorial</a>
                        </li>
                    </ul> -->
                </div>
                <div class="offcanvas-footer">
                    <div class="d-block d-lg-none pt-4">
                        <div class="container p-4">
                            <hr>

                            <div class="row g-3 mx-auto">
                                <div class="col-auto">
                                    <a class="text-dark" href="#"><i class="fab fa-facebook fa-lg"></i></a>
                                </div>
                                <div class="col-auto">
                                    <a class="text-dark" href="#"><i class="fab fa-instagram fa-lg"></i></a>
                                </div>
                                <div class="col-auto">
                                    <a class="text-dark" href="#"><i class="fab fa-tiktok fa-lg"></i></a>
                                </div>
                            </div>
                            <div class="text-center mt-4 pb-2">
                                <small class="text-muted fw-lighter">© 2025 {{ env('APP_NAME')}}. Todos los derechos reservados. </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>