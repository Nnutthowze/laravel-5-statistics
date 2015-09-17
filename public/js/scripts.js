$(function() {

    $('#from').val('2015-01-01');
    $('#to').val('2015-08-06');

    loadChart();

    // Change event for inputs date
    $('input[type=date]').change(function() {
        fromDate = $('#from').val();
        toDate = $('#to').val();

        $('#form-errors').html('');
        loadChart();
    });

    // Ajax call to update the dashboard
    function loadChart() {

        var form = $('#dashboard-date');

        $.ajax({
            url: form.prop('action'),
            data: form.serialize(),
            method: form.prop('method'),
            dataType: 'json'
        })
        //$.getJSON(window.location.href + '/from/' + fromDate + '/to/' + toDate)
            .done(function (data, textStatus, jqXHR) {
                if(jqXHR.status === 200 ) {
                    console.log(data);

                }
            })
            .fail(function (jqXHR, textStatus, errorThrown) {

                var errorsHtml = '<div class="alert alert-danger"><ul>';

                /*if(jqXHR.status === 401 ) {
                    $( location ).prop( 'pathname', 'auth/login' );
                    var errors = data.responseJSON.msg;
                    errorsHtml = '<div class="alert alert-danger">' + errors + '</div>';
                    $( '#form-errors' ).html( errorsHtml );
                }*/

                // Laravel error message
                if (jqXHR.status === 422 ) {
                    var errors = jqXHR.responseJSON;
                    $.each(errors , function(key, value) {
                        errorsHtml += '<li>' + value[0] + '</li>';
                    });
                }

                // if not found
                /*if (jqXHR.status === 404) {
                 console.log(errorThrown);
                 //$('.alert.alert-danger').html(errorThrown);
                 }*/

                if (jqXHR.status === 500)
                {
                    if ($('#from').val() > $('#to').val()) {
                        errorsHtml += "<li>from date field can't be greater than to</li>";
                    }
                    else {
                        errorsHtml += "<li>no data for these time intervals</li>";
                    }
                }

                errorsHtml += '</ul></div>';
                $('#form-errors').html(errorsHtml);
            });
    }
});