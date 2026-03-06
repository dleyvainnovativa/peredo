document.addEventListener('DOMContentLoaded', function () {

    let allServices = [
    {
        id: '1',
        category: 'Insumos',
        category_id: 1,
        icon: 'fas fa-seedling',
        name: 'Semilla de maíz',
        description: 'Semilla certificada para siembra de maíz de alto rendimiento.',
        quantity: 25,
        status: "",
        quantity_raw: 25,
        cost: 480
    },
    {
        id: '2',
        category: 'Insumos',
        category_id: 1,
        icon: 'fas fa-seedling',
        name: 'Semilla de sorgo',
        description: 'Semilla seleccionada para cultivo forrajero.',
        quantity: 20,
        status: "",
        quantity_raw: 20,
        cost: 420
    },
    {
        id: '3',
        category: 'Fertilizantes',
        category_id: 2,
        icon: 'fas fa-flask',
        name: 'Fertilizante nitrogenado',
        description: 'Fertilizante granulado para mejorar el crecimiento del cultivo.',
        quantity: 30,
        status: "",
        quantity_raw: 30,
        cost: 520
    },
    {
        id: '4',
        category: 'Fertilizantes',
        category_id: 2,
        icon: 'fas fa-vial',
        name: 'Fertilizante foliar',
        description: 'Fertilizante líquido para aplicación directa en hojas.',
        quantity: 15,
        status: "",
        quantity_raw: 15,
        cost: 310
    },
    {
        id: '5',
        category: 'Alimento',
        category_id: 3,
        icon: 'fas fa-drumstick-bite',
        name: 'Alimento para ganado',
        description: 'Alimento balanceado para ganado bovino.',
        quantity: 40,
        status: "",
        quantity_raw: 40,
        cost: 290
    },
    {
        id: '6',
        category: 'Alimento',
        category_id: 3,
        icon: 'fas fa-bone',
        name: 'Sales minerales',
        description: 'Suplemento mineral para nutrición del ganado.',
        quantity: 18,
        status: "",
        quantity_raw: 18,
        cost: 260
    },
    {
        id: '7',
        category: 'Sanidad',
        category_id: 4,
        icon: 'fas fa-syringe',
        name: 'Vacuna para ganado',
        description: 'Vacuna preventiva para enfermedades comunes del ganado.',
        quantity: 30,
        status: "",
        quantity_raw: 30,
        cost: 110
    },
    {
        id: '8',
        category: 'Sanidad',
        category_id: 4,
        icon: 'fas fa-bug',
        name: 'Insecticida agrícola',
        description: 'Insecticida para control de plagas en cultivos.',
        quantity: 12,
        status: "",
        quantity_raw: 12,
        cost: 360
    },
    {
        id: '9',
        category: 'Combustibles',
        category_id: 5,
        icon: 'fas fa-gas-pump',
        name: 'Diésel agrícola',
        description: 'Combustible para tractores y maquinaria agrícola.',
        quantity: 200,
        status: "",
        quantity_raw: 200,
        cost: 23
    },
    {
        id: '10',
        category: 'Herramientas',
        category_id: 6,
        icon: 'fas fa-tools',
        name: 'Herramientas de mano',
        description: 'Palas, picos y azadones para labores del rancho.',
        quantity: 10,
        status: "",
        quantity_raw: 10,
        cost: 950
    }
];


    $('#manager-table').bootstrapTable({
        locale: 'es-ES',
        formatNoMatches: function () {
            return 'No hay productos agregados';
        },
        formatLoadingMessage: function () {
            return '<b>Cargando...</b>';
        },
        columns: [{
                field: 'name',
                title: 'Nombre de Producto'
            },
            {
                field: 'category',
                title: 'Categoría'
            },
            {
                field: 'quantity',
                title: 'Cantidad',
                visible: false
            },
            {
                field: 'validation',
                title: 'Cantidad',
                align: 'center',
                formatter: quantityFormatter
            },
            {
                field: 'actions',
                title: '',
                align: 'center',
                formatter: deleteFormatter
            }

        ]
    });
    $('#preview-table').bootstrapTable({
        locale: 'es-ES',
        formatNoMatches: function () {
            return 'No hay productos agregados';
        },
        formatLoadingMessage: function () {
            return '<b>Cargando...</b>';
        },
        columns: [{
                field: 'name',
                title: 'Nombre de Producto'
            },
            {
                field: 'category',
                title: 'Categoría'
            },
            {
                field: 'quantity',
                title: 'Cantidad',
            }
        ],
    });

    window.SERVICES_DATA = allServices;

    window.accountChoices = null;

    buildSelect(allServices)

    async function buildSelect(accounts) {
        const select = document.querySelector("#parent_id");

        if (!window.accountChoices) {
            // initialize once
            window.accountChoices = new Choices(select, {
                searchPlaceholderValue: "Buscar cuenta...",
                removeItemButton: false,
                shouldSort: false,
            });
        } else {
            // if already initialized, clear previous choices
            window.accountChoices.clearChoices();
        }

        // set new choices
        window.accountChoices.setChoices(
            accounts.map(m => ({
                value: m.id,
                label: `${m.name}`,
                selected: false,
                customProperties: {
                    category: m.category,
                    root: m.name
                }
            })),
            'value',
            'label',
            false
        );
    }


    const addBtn = document.getElementById("add_btn");
    const parentSelect = document.getElementById("parent_id");
    const quantityInput = document.getElementById("quantity");

    addBtn.addEventListener("click", () => {

        const parentId = parentSelect.value;
        const parentText = parentSelect.options[parentSelect.selectedIndex]?.text;
        let selectProperties = JSON.parse(parentSelect.options[parentSelect.selectedIndex].getAttribute("data-custom-properties"));
        const quantity = parseInt(quantityInput.value, 10);
        let category = selectProperties.category;

        // 🔒 VALIDATIONS
        if (!parentId) {
            alert("Debes seleccionar un item.");
            return;
        }

        if (isNaN(quantity) || quantity < 1) {
            alert("La cantidad debe ser mayor o igual a 1.");
            return;
        }

        // 🚫 Prevent duplicates
        const existing = $('#manager-table').bootstrapTable('getData')
            .some(row => row.id == parentId);

        if (existing) {
            alert("Este item ya fue agregado.");
            return;
        }

        // ➕ APPEND ROW (bootstrap-table way)
        $('#manager-table').bootstrapTable('append', {
            id: parentId,
            name: parentText,
            category: category,
            quantity: quantity,
            validation: quantity
        });

        // ♻️ Reset
        parentSelect.value = "";
        quantityInput.value = "";

        // ❌ Close modal
        bootstrap.Modal.getInstance(
            document.getElementById("addItem")
        ).hide();
    });

    function quantityFormatter(value) {
        return `
        <div class="input-group quantity-form justify-content-center">
            <button class="btn btn-outline-secondary js-quantity-minus" type="button">
                <i class="fas fa-minus"></i>
            </button>
            <input type="text"
                   class="form-control text-center js-quantity-input card-dark"
                   value="${value}"
                   readonly
                   style="max-width: 60px; min-width: 60px;">
            <button class="btn btn-outline-secondary js-quantity-plus" type="button">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    `;
    }

    function deleteFormatter() {
        return `
        <button type="button"
                class="btn btn-outline-danger btn-sm js-delete-row"
                title="Eliminar">
            <i class="fas fa-trash"></i>
        </button>
    `;
    }


});

document.addEventListener("click", function (e) {

    const deleteBtn = e.target.closest(".js-delete-row");
    if (!deleteBtn) return;

    const rowEl = deleteBtn.closest("tr");
    const rowIndex = rowEl.dataset.index;

    const table = $('#manager-table');

    table.bootstrapTable('remove', {
        field: '$index',
        values: [Number(rowIndex)]
    });
});


document.addEventListener("click", function (e) {

    const plusBtn = e.target.closest(".js-quantity-plus");
    const minusBtn = e.target.closest(".js-quantity-minus");
    if (!plusBtn && !minusBtn) return;
    const rowEl = e.target.closest("tr");
    const rowIndex = rowEl.dataset.index;
    const table = $('#manager-table');

    let row = table.bootstrapTable('getData')[rowIndex];

    if (plusBtn) {
        row.quantity++;
    }
    if (minusBtn) {
        if (row.quantity <= 1) {
            return;
        }
        row.quantity--;
    }
    row.validation = row.quantity;

    table.bootstrapTable('updateRow', {
        index: rowIndex,
        row: row
    });
});
document.getElementById("continue-services-button").addEventListener("click", async function () {
    const table = $('#manager-table');
    let products = table.bootstrapTable('getData');
    generateServicesTable(products);
});

document.getElementById("send_request").addEventListener("click", async function () {
    let message = await showNotification(" Se ha enviado la solicitud", "El almacenista será notificado para su aprobación", null, "me-2 fas fa-check-circle");
        window.location = "almacen";
})
