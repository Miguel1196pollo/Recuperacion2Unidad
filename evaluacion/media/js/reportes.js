$(document).ready(function () {
    $("#divtabla").hide();
    $("#tablausuario").DataTable();


    $("#excelUsuario").on('click', function () {
        creaExcelUsuario();
    });

    $("#pdfUsuario").on('click', function () {
        creaPdfUsuario();
    });
});

function creaExcelUsuario() {
    $("#tablausuario").table2excel({
        exclude: ".noExl",
        name: "usuarios",
        filename: "Reporte de Usuarios",
        fileext: ".xls"
    });
}

function creaPdfUsuario() {
    var pdf = new jsPDF('landscape', 'pt', 'letter', true);

    construyeTabla(pdf, $("#tablausuario")[0]);

    function construyeTabla(doc, contenidoTabla) {
        var totalPagesExp = "{total_pages_count_string}";

        var res = doc.autoTableHtmlToJson(contenidoTabla, true);

//        //Indice del ultimo renglon de la tabla
//        var indice = res.data.length - 1;
//
//        //Se elimina la primer columna de la tabla
//        res.columns.splice(0, 1); //Indice a borrar, Elementos a borrar
//        //Se elimina el ultimo renglon de la tabla
//        res.data.splice(indice, indice);
//
//        for (var i = 0, max = res.data.length; i < max; i++) {
//            //Se elimina la primer columna de la tabla
//            res.data[i].splice(0, 1); //Indice a borrar, Elementos a borrar
//
//            if (res.data[i][3].innerHTML == "<i class='ti-check'>") {
//                res.data[i][3] = 'Activo';
//            } else {
//                res.data[i][3] = 'Inactivo';
//            }
//        }

        doc.autoTableSetDefaults({
            // Funcion para cargar encabezado y pie de pagina
            addPageContent: function (data) {
                //Encabezado
                doc.setFont("arial", "bold");
                doc.setFontSize(20);
                doc.setTextColor(0, 0, 0);
                doc.text("Reporte de usuarios Registrados", 270, doc.internal.pageSize.height - 570);
                pdf.setFillColor(10, 10, 10);

                // Pie de pagina
                var piePagina = "P\u00e1gina " + data.pageCount;
                if (typeof doc.putTotalPages === 'function') {
                    piePagina = piePagina + " de " + totalPagesExp;
                }
                doc.setFontSize(10);
                doc.text(piePagina, data.settings.margin.rigth, doc.internal.pageSize.height - 10);

                doc.setFontSize(10);
                doc.setFont("arial", "bold");
                doc.text("Barber Shop *TEXAS*", 650, doc.internal.pageSize.height - 10);
            }
        });

        doc.autoTable(res.columns, res.data, {
            tableWidth: 'auto',
            cellWidth: 'wrap',
            theme: 'grid',
            startY: 80,
            margin: {
                horizontal: 20,
                top: 90,
                bottom: 60
            },
            styles: {// Defaul style
                lineWidth: 0.03,
                lineColor: 0,
                fillStyle: 'DF',
                halign: 'center',
                valign: 'middle',
                overflow: 'linebreak'
            },
            tableLineColor: [10, 10, 10],
            tableLineWidth: 0,
            headerStyles: {
                lineColor: [10, 10, 10],
                fontSize: 9,
                fontStyle: 'bold',
                textColor: [0, 0, 0],
                fillColor: [217, 217, 217],
                columnWidth: [80, 104, 104, 104, 104, 130, 123, 122, 115, 104, 104, 105],
                overflow: 'linebreak'
            },
            bodyStyles: {
                lineColor: [10, 10, 10],
                fontSize: 8,
                overflow: 'linebreak',
                textColor: [0, 0, 0]
            },
            createdHeaderCell: function (cell) {
                cell.styles.halign = 'center';
            },
            createdCell: function (cell) {
                cell.styles.halign = 'center';
            }
        }
        );
        // Total page number plugin only available in jspdf v1.0+
        if (typeof doc.putTotalPages === 'function') {
            pdf.putTotalPages(totalPagesExp);
        }

        pdf.save("Reporte de Usuarios.pdf");
    }
}



