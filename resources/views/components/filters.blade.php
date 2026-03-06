{{-- Offcanvas Filters --}}

@php
$categories = [
[
'id' => '1',
'name' => 'Inventario',
'icon' => 'fas fa-boxes-stacked'
],
[
'id' => '2',
'name' => 'Almacenamiento',
'icon' => 'fas fa-warehouse'
],
[
'id' => '3',
'name' => 'Control de calidad',
'icon' => 'fas fa-clipboard-check'
],
[
'id' => '4',
'name' => 'Mantenimiento',
'icon' => 'fas fa-screwdriver-wrench'
],
];


$services = [
[
'id' => 'recepcion_mercancia',
'icon' => 'fas fa-truck-loading',
'title' => 'Recepción de mercancía',
'description' => 'Registro, inspección y acomodo inicial de insumos y productos recibidos en el almacén.',
'duration' => 30,
'cost' => 150
],
[
'id' => 'salida_mercancia',
'icon' => 'fas fa-dolly',
'title' => 'Salida de mercancía',
'description' => 'Preparación y entrega de materiales, herramientas o productos para uso en el rancho.',
'duration' => 20,
'cost' => 120
],
[
'id' => 'inventario_fisico',
'icon' => 'fas fa-clipboard-check',
'title' => 'Inventario físico',
'description' => 'Conteo y verificación física de existencias en bodega.',
'duration' => 60,
'cost' => 300
],
[
'id' => 'control_inventario',
'icon' => 'fas fa-boxes-stacked',
'title' => 'Control de inventario',
'description' => 'Actualización y control de entradas y salidas de productos en el sistema.',
'duration' => 45,
'cost' => 250
],
[
'id' => 'almacenamiento_insumos',
'icon' => 'fas fa-warehouse',
'title' => 'Almacenamiento de insumos',
'description' => 'Resguardo y organización adecuada de insumos agrícolas, fertilizantes y alimentos.',
'duration' => 30,
'cost' => 180
],
[
'id' => 'clasificacion_productos',
'icon' => 'fas fa-tags',
'title' => 'Clasificación de productos',
'description' => 'Separación y etiquetado de productos por tipo, lote o fecha.',
'duration' => 40,
'cost' => 200
],
[
'id' => 'revision_caducidades',
'icon' => 'fas fa-calendar-xmark',
'title' => 'Revisión de caducidades',
'description' => 'Verificación de fechas de caducidad y condiciones de los productos almacenados.',
'duration' => 25,
'cost' => 130
],
[
'id' => 'limpieza_bodega',
'icon' => 'fas fa-broom',
'title' => 'Limpieza de bodega',
'description' => 'Limpieza general y orden del área de almacén.',
'duration' => 50,
'cost' => 220
],
];
@endphp

<div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasCategories" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header text-bg-primary">
        <h5 class="offcanvas-title fw-bolder" id="offcanvasRightLabel">Filtros</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="d-flex flex-wrap gap-3">
            <div id="category-filters">
                <label class="form-label text-muted small">Category</label>
                <div class="d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-primary">All Services</button>
                    @foreach ($categories as $category)
                    <button type="button" class="btn btn-outline-primary">{{$category["name"]}}</button>
                    @endforeach
                </div>
            </div>
            <div id="price-filters">
                <label class="form-label text-muted small">Price Range</label>
                <div class="d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-primary">All Prices</button>
                    <button type="button" class="btn btn-outline-primary">Under $40</button>
                    <button type="button" class="btn btn-outline-primary">$40 - $60</button>
                    <button type="button" class="btn btn-outline-primary">Over $60</button>
                </div>
            </div>
        </div>
        <div class="my-4 text-muted" id="service-count-display">
            <p class="text-muted">{{ count($services) }} services available</p>
        </div>
    </div>
    <div class="offcanvas-footer">
        <div class="p-3">
            <button class="btn btn-outline-primary w-100" data-bs-dismiss="offcanvas">Aplicar filtros</button>
        </div>

    </div>
</div>