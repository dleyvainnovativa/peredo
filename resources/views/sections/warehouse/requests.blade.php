<div class="container">
    <div class="py-2 text-start">
        <h3 class="fw-bold"><i class="fas fa-list me-2 text-primary"></i>Lista de Solicitudes</h3>
        <p class="text-muted">Por favor, proporciona tu información de contacto para confirmar la reservación.</p>
    </div>
    @php
    $products = [
    [
    'id' => 1,
    'name' => 'Solicitud #0001',
    'category' => 'Electronics',
    'quantity' => 2,
    ],
    [
    'id' => 2,
    'name' => 'Solicitud #0002',
    'category' => 'Furniture',
    'quantity' => 5,
    ],
    [
    'id' => 3,
    'name' => 'Solicitud #0003',
    'category' => 'Accessories',
    'quantity' => 10,
    ],
    [
    'id' => 4,
    'name' => 'Solicitud #0004',
    'category' => 'Office Supplies',
    'quantity' => 20,
    ],
    ];
    @endphp
    <div class="row g-4">
        <div class="col-12">
            <div class="card card-dark border border-dark">
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table id="requests-table" class="table table-hover align-middle rounded text-bg-dark">
                            <thead class="table-light text-bg-dark">
                                <tr>
                                    <th scope="col">Nombre de Producto</th>
                                    <th scope="col" class="text-start">Cantidad</th>
                                    <th scope="col" class="text-end">Ver</th>
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

                                    <td class="fw-medium">
                                        {{ $product['quantity'] }}
                                    </td>

                                    {{-- Actions --}}
                                    <td class="text-end">
                                        {{-- Added js-approve class --}}
                                        <a href="request" class="btn btn-success">
                                            <i class="fas fa-eye"></i> <span class="d-none d-sm-inline">Ver Solicitud</span>
                                        </a>
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