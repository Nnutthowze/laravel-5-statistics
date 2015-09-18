$(function() {

    "use strict";

    $('#from').val('2015-07-06');
    $('#to').val('2015-08-06');

    loadData();

    // Change event for inputs date
    $('input[type=date]').change(function() {
        $('#form-errors').html('');
        loadData();
    });

    // Ajax call to update the dashboard
    function loadData() {

        var form = $('#dashboard-date');

        $.getJSON(form.prop('action'), form.serialize(),
            function (jsonData, textStatus, jqXHR) {
                if(jqXHR.status === 200 ) {
                    // TODO: need to add here some stuff for c3js

                    generateChart(jsonData);
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

    // chart generator
    function generateChart(data) {

        console.log(data);

        var chart = c3.generate({
            data: {
                x : 'Data Recorded',
                type: 'line',
                json: data,
                keys: {
                    // x: 'name', // it's possible to specify 'x' when category axis
                    value: ['Data Recorded', 'Mean Temperature',
                        'Median Temperature', 'Mean Pressure',
                        'Median Pressure', 'Mean Speed', 'Median Speed']
                }
            },
            bar: {
                width: {
                    ratio: 0.9
                }
            },
            axis: {
                x: {
                    type: 'timeseries',
                    tick: {
                        format: '%Y-%m-%d'
                    }
                } // x
            }, // axis
            subchart: {
                show: true
            }
        }); // chart

        setTimeout(function () {
            chart.load({
                value: ['Mean Temperature']
            });
        }, 1000);
    }
});