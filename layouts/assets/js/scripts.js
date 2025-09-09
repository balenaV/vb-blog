
$(document).ready(function () {
    $('busca').on('keyup', function () {
        let termo = $(this).val().trim();

        // Se o campo estiver vazio, limpa os resultados e esconde o container
        if (termo.length === 0) {
            $('#buscaResultado').html('').hide();
            return;
        }

        $.ajax({
            url: $('#formBusca').attr('data-url-busca'), // Arquivo PHP que fará a busca
            method: 'POST',
            data: { busca: termo },
            dataType: 'json',
            success: function (data) {
                $('#buscaResultado').html('').show();

                if (data.length > 0) {
                    // Monta a lista de resultados com Bootstrap
                    let html = '<div class="list-group shadow">';
                    $.each(data, function (index, item) {
                        html += `<a href="post.php?id=${item.id}" class="list-group-item list-group-item-action fw-bold">${item.titulo}</a>`;
                    });
                    html += '</div>';
                    $('#buscaResultado').html(html);
                } else {
                    // Se não encontrar nada, exibe alerta bonito do Bootstrap
                    $('#buscaResultado').html(`
                        <div class="alert alert-warning shadow" role="alert">
                            Nenhum resultado encontrado!
                        </div>
                    `);
                }
            },
            error: function () {
                $('#buscaResultado').html(`
                    <div class="alert alert-danger shadow" role="alert">
                        Ocorreu um erro na busca. Tente novamente.
                    </div>
                `).show();
            }
        });
    });
});
