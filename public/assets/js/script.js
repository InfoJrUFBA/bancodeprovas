$('#new-pswd').click(function () {
    if ($('#pswd-group').hasClass("pswd-group")) {
        $('#pswd-group').slideDown();
        $('#pswd-group').removeClass("pswd-group");
        $('#pswd-group').removeAttr("style");
    } else {
        $('#pswd-group').slideUp(function() {
            $('#pswd-group').addClass("pswd-group");
        });
    }
});

$(document).ready(function() {
    $('.datatable').DataTable ({
        "responsive": true,
        // "columnDefs": [
        //         { responsivePriority: 1, targets: 0 },
        //         { responsivePriority: 2, targets: -1 }
        // ],
        "language": {
            // "url": "/assets/js/datatables-ptBR.lang"
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_ resultados por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado... Ainda! :)",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            }
        }
    });
});
