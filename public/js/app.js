

let mensaje = localStorage.getItem('mensaje');

if (mensaje) {
    Swal.fire({
        icon: 'success',
        title: '¡Éxito!',
        text: mensaje,
    });
    localStorage.removeItem('mensaje_error');
    localStorage.removeItem('mensaje');
}
let mensaje_error = localStorage.getItem('mensaje_error');

if (mensaje_error) {
    Swal.fire({
        icon: 'error',
        title: 'Oops!',
        text: mensaje_error,
    });
    localStorage.removeItem('mensaje');
    localStorage.removeItem('mensaje_error');
}
$(document).ready(function() {
    $('.summernote').summernote({
        height: 500,
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['codeview', 'help']],
            ['height', ['height']]
        ]
    });
    $('.data_table').DataTable({
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "«",
                "sLast": "»",
                "sNext": "›",
                "sPrevious": "‹"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    });
});
