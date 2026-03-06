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
    }
];


$('#manager-table').bootstrapTable({
    locale: 'es-ES',
    formatNoMatches: function () {
        return 'No hay productos agregados';
    },
    rowStyle: function (row) {
        if (row.status === true) {
            return { classes: 'table-success' };
        }

        if (row.status === false) {
            return { classes: 'table-danger' };
        }

        return {};
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
            field: 'quantity_raw',
            title: 'Cantidad',
            align: 'center',
            formatter: quantityFormatter
        },
        {
            field: 'actions',
            title: 'Validación',
            align: 'center',
            formatter: approveFormatter
        }

    ],
    data: allServices
});

function approveFormatter(value) {
    return `<div class="btn-group" role="group">
                                                <button type="button" class="btn btn-success js-approve">
                                                    <i class="fas fa-check"></i> <span class="d-none d-sm-inline">Validar línea</span>
                                                </button>
                                                <button type="button" class="btn btn-danger js-reject">
                                                    <i class="fas fa-times"></i> <span class="d-none d-sm-inline">Eliminar línea</span>
                                                </button>
                                            </div>`;
}

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
    row.quantity_raw = row.quantity;

    table.bootstrapTable('updateRow', {
        index: rowIndex,
        row: row
    });
});

let continueButton = document.getElementById("continue-to-payment-btn");
const tbody = $('#manager-table tbody');

// --- Function to check if all rows are decided ---
function checkAllDecided() {
    const totalRows = tbody.find('tr').length;
    // Count rows that have either table-success or table-danger class
    const decidedRows = tbody.find('tr.table-success, tr.table-danger').length;

    if (totalRows > 0 && totalRows === decidedRows) {
        // Use a more modern-looking alert if you can, like SweetAlert
        continueButton.disabled = false;
        let data = $('#manager-table').bootstrapTable('getData');
        console.log(data);

    } else {
        continueButton.disabled = true;
    }
}

// --- Handle Approve button clicks ---
tbody.on('click', '.js-approve', function (e) {
     const row = e.target.closest("tr");
    const rowIndex = row.dataset.index;
    const table = $('#manager-table');
    let rowTable = table.bootstrapTable('getData')[rowIndex];
    rowTable.status = true;
    table.bootstrapTable('updateRow', {
        index: rowIndex,
        row: rowTable,
        class:"table-success"
    });
    checkAllDecided();
});
tbody.on('click', '.js-reject', function (e) {
     const row = e.target.closest("tr");
    const rowIndex = row.dataset.index;
    const table = $('#manager-table');
    let rowTable = table.bootstrapTable('getData')[rowIndex];
    rowTable.status = false;
    table.bootstrapTable('updateRow', {
        index: rowIndex,
        row: rowTable,
        class:"table-success"
    });
    checkAllDecided();
});

continueButton.addEventListener("click", function () {
    const table = $('#manager-table');

    const products = table
        .bootstrapTable('getData')
        .filter(row => row.status === true);

    if (products.length === 0) {
        alert('No hay productos validados para continuar.');
        return;
    }

    generateServicesPDF(products);
});
