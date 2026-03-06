<div class="tab-pane fade" id="pane-calendar" role="tabpanel" aria-labelledby="tab-calendar">
    <div class="container py-4 text-center">
        <div class="py-2">
            <h3 class="fw-bold"><i class="fas fa-calendar-alt me-2 text-primary"></i>Selecciona fecha y hora</h3>
            <p class="text-muted">Elige el día y la hora que prefieras para tu cita.</p>
        </div>
        <div class="row g-4 mb-4">
            <div class="col-lg-5 col-12">
                <div class="card card-dark border border-dark">
                    <div class="card-body">
                        <h5 class="mb-4 text-dark fw-bold">Selecciona la fecha</h5>
                        <div class="px-3">
                            {{-- The Calendar Header --}}
                            <div class="calendar-header">
                                {{-- Add ID for previous month button --}}
                                <i id="prev-month" class="fas fa-chevron-left calendar-nav-icon text-dark"></i>

                                {{-- Add ID for the month/year display --}}
                                <span id="month-year" class="fw-bold text-dark"></span>

                                {{-- Add ID for next month button --}}
                                <i id="next-month" class="fas fa-chevron-right calendar-nav-icon text-dark"></i>
                            </div>

                            <div class="calendar-grid calendar-days text-dark">
                                <div class="day-name fw-bold">D</div>
                                <div class="day-name fw-bold">L</div>
                                <div class="day-name fw-bold">M</div>
                                <div class="day-name fw-bold">M</div>
                                <div class="day-name fw-bold">J</div>
                                <div class="day-name fw-bold">V</div>
                                <div class="day-name fw-bold">S</div>
                            </div>

                            {{-- The Grid Skeleton (JavaScript will fill this) --}}
                            <div id="calendar-grid" class="calendar-grid">
                                {{-- This will be populated by JS --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-12" id="time-container">
                <div class="card card-dark border border-dark">
                    <div class="card-body">
                        <h5 class="mb-4 text-dark fw-bold">Selecciona el horario</h5>
                        <div id="time-slots-container" class="row g-2">
                            <div class="col-12 text-center py-5">
                                <p class="text-primary"><i class="fas fa-calendar-day me-2"></i> Selecciona primero la fecha para ver los horarios disponibles.</p>
                            </div>
                        </div>
                        <p class="mt-4 mb-0 text-muted text-start small opacity-50">* Los espacios grises están no disponibles</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mx-auto fixed-bottom bg-dark py-3 shadow">
        <div class="container">
            <div class="container">
                <div class="row g-2">
                    <div class="col-md-auto col-5">
                        <button type="button" class="btn btn-outline-primary w-100" data-prev="tab-services">Anterior</button>
                    </div>
                    <div class="col-md-auto ms-auto col-7">
                        <button type="button" class="btn btn-primary w-100" disabled id="continue-calendar-button" data-next="tab-info">Continuar a Info</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>