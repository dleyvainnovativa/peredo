<div class="tab-pane fade show active" id="pane-info" role="tabpanel" aria-labelledby="tab-info">
    <div class="container py-4">
        <div class="py-2 text-center">
            <h3 class="fw-bold"><i class="fas fa-user me-2 text-primary"></i>Tus datos</h3>
            <p class="text-muted">Por favor, proporciona tu información de contacto para confirmar la reservación.</p>
        </div>
        @php
        $products = [
        [
        'id' => 1,
        'name' => 'Laptop Dell Inspiron 15',
        'category' => 'Electronics',
        'quantity' => 2,
        ],
        [
        'id' => 2,
        'name' => 'Office Chair Ergonomic',
        'category' => 'Furniture',
        'quantity' => 5,
        ],
        [
        'id' => 3,
        'name' => 'Wireless Mouse Logitech',
        'category' => 'Accessories',
        'quantity' => 10,
        ],
        [
        'id' => 4,
        'name' => 'A4 Printing Paper (500 sheets)',
        'category' => 'Office Supplies',
        'quantity' => 20,
        ],
        [
        'id' => 5,
        'name' => 'HP LaserJet Toner Cartridge',
        'category' => 'Office Supplies',
        'quantity' => 3,
        ],
        ];
        @endphp

        <div class="row g-4 mb-4">
            <div class="col-12">
                <div class="card card-dark border border-dark">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4"><i class="fas fa-user me-2 text-primary" aria-hidden="true"></i> Datos del Solicitante</h5>
                        <div class="row g-3">
                            <div class="col-12 col-md-6">
                                <p><b>Nombre: </b><span id="review_name">Angel Samuel Chavez Camacho</span></p>
                            </div>
                            <div class="col-12 col-md-6">
                                <p><b>Correo electrónico: </b><span id="review_email">gestion.documental@sistemascontino.com.mx</span></p>
                            </div>
                            <div class="col-12 col-md-6">
                                <p><b>Días disponibles: </b><span id="review_days">4</span></p>
                            </div>
                            <div class="col-12 col-md-6">
                                <p><b>Departamento: </b><span id="review_department">Tecnologias de la información</span></p>
                            </div>
                            <div class="col-12 col-md-6">
                                <p><b>Puesto: </b><span id="review_position">Desarrollador IBM</span></p>
                            </div>
                            <div class="col-12 col-md-6 d-none">
                                <p><b>Puesto: </b><span id="review_payment">Quincenal</span></p>
                            </div>
                            <div class="col-12 col-md-6 d-none">
                                <p><b>Puesto: </b><span id="review_shift">Matutino</span></p>
                            </div>
                            <div class="col-12 col-md-6 d-none">
                                <p><b>Team Leader: </b><span id="review_team_leader">Elias Castellanos</span></p>
                            </div>
                            <div class="col-12 col-md-6 d-none">
                                <p><b>Correo Leader: </b><span id="review_team_leader_email">acontisign@gmail.com</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12 mx-auto">
                <div class="card card-dark border border-dark h-100">
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table id="manager-table" class="table table-hover align-middle rounded text-bg-dark">
                                <thead class="table-light text-bg-dark">
                                    <tr>
                                        <th scope="col">Nombre de Producto</th>
                                        <th scope="col">Categoría</th>
                                        <th scope="col" class="text-center">Cantidad</th>
                                        <th scope="col" class="text-end">Validación</th>
                                    </tr>
                                </thead>
                                {{-- Added id="products-tbody" for easier selection in JS --}}
                                <tbody id="products-tbody">
                                    @foreach ($products as $product)
                                    <tr>
                                        {{-- Product Name --}}
                                        <td class="fw-medium">
                                            {{ $product['name'] }}
                                        </td>

                                        {{-- Category --}}
                                        <td>
                                            <span class="badge text-bg-primary fw-normal">
                                                {{ $product['category'] }}
                                            </span>
                                        </td>

                                        {{-- Quantity --}}
                                        <td class="text-center">
                                            <div class="input-group quantity-form justify-content-center">
                                                {{-- Added js-quantity-minus class --}}
                                                <button class="btn btn-outline-secondary js-quantity-minus" type="button">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                {{-- Added js-quantity-input class --}}
                                                <input type="text" class="form-control  text-center js-quantity-input card-dark" value="{{ $product['quantity'] }}" readonly style="max-width: 60px; min-width: 60px;">
                                                {{-- Added js-quantity-plus class --}}
                                                <button class="btn btn-outline-secondary js-quantity-plus" type="button">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                        </td>

                                        {{-- Actions --}}
                                        <td class="text-end">
                                            <div class="btn-group" role="group">
                                                {{-- Added js-approve class --}}
                                                <button type="button" class="btn btn-success js-approve">
                                                    <i class="fas fa-check"></i> <span class="d-none d-sm-inline">Validar línea</span>
                                                </button>
                                                {{-- Added js-reject class --}}
                                                <button type="button" class="btn btn-danger js-reject">
                                                    <i class="fas fa-times"></i> <span class="d-none d-sm-inline">Eliminar línea</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mx-auto fixed-bottom bg-dark py-3 shadow">
        <div class="container">
            <div class="container">
                <div class="row g-2">
                    <!-- <div class="col-md-auto col-5">
                        <button type="button" class="btn btn-outline-primary w-100" data-prev="tab-calendar">Anterior</button>
                    </div> -->
                    <div class="col-md-auto col-7 ms-auto">
                        <button type="button" disabled class="btn btn-primary w-100" id="continue-to-payment-btn" data-next="tab-confirm">Generar PDF</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>