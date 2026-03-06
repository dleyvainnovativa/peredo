function generateServicesPDF(products) {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();
    // PDF title
    doc.setFontSize(16);
    doc.text('Lista de productos seleccionados', 14, 20);
    // Table headers
    const tableHeaders = [['Producto', 'Categoría', 'Cantidad']];
    // Table body
    console.log(products);
    const tableBody = products.map(product => [
        product.name,
        product.category,
        product.quantity,
       
    ]);

    // Generate table
    doc.autoTable({
        startY: 30,
        head: tableHeaders,
        body: tableBody,
        theme: 'striped',
        headStyles: {
            fillColor: [33, 37, 41], // dark
            textColor: 255
        },
        styles: {
            fontSize: 11,
            cellPadding: 4
        }
    });

    // Render PDF into iframe
    const pdfBlob = doc.output('blob');
    const pdfUrl = URL.createObjectURL(pdfBlob);

    document.getElementById('generatedPDF').innerHTML = `
        <iframe 
            src="${pdfUrl}" 
            width="100%" 
            height="100%" 
            style="border:none;"
        ></iframe>
    `;
}

function generateServicesTable(products) {
    $('#preview-table').bootstrapTable('load', products);

}


window.generateServicesPDF = generateServicesPDF;
window.generateServicesTable = generateServicesTable;

