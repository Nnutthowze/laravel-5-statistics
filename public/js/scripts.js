$(function() {

$('#from').val('2015-01-01');
    $('#to').val('2015-08-06');

    loadChart();

    // Change event for inputs date
    $('input[type=date]').change(function() {
        $('#form-errors').html('');
        loadChart();
    });

    // Ajax call to update the dashboard
    function loadChart() {

        var form = $('#dashboard-date');

        $.getJSON(form.prop('action'), form.serialize(),
            function (data, textStatus, jqXHR) {
                if(jqXHR.status === 200 ) {
                    console.log(data);
                    // TODO: need to add here some stuff for c3js
                }
            })
            .fail(function (jqXHR, textStatus, errorThrown) {

                var errorsHtml = '<div class="alert alert-danger"><ul>';

                // Laravel error message
                if (jqXHR.status === 422 ) {
                    var errors = jqXHR.responseJSON;
                    $.each(errors , function(key, value) {
                        errorsHtml += '<li>' + value[0] + '</li>';
                    });
                }
                else {
                    errorsHtml += '<li>' + errorThrown + '</li>';
                }

                errorsHtml += '</ul></div>';
                $('#form-errors').html(errorsHtml);
            });
    }

});