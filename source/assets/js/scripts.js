$(document).ready(function(){

    if($('#de2').attr('value') == ''){
        var start = moment().subtract(29, 'days');
        var end = moment();
    }else{
        var start = moment(new Date($('#de2').attr('value')));
        var end = moment(new Date($('#ate2').attr('value')));
    }
    console.log('New date range selected: ' + start + ' to ' + end + ')');

    function cb(start, end) {
        $('#reportrange span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));

        $('#de').val(start.format('MM/DD/YYYY'));
        $('#ate').val(end.format('MM/DD/YYYY'));

        $('#de2').val(start);
        $('#ate2').val(end);
    
    }


    //cb(start, end);

    $('#reportrange').daterangepicker({
        ranges: {
            'Hoje': [moment(), moment()],
            'Ontem': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Últimos 7 Dias': [moment().subtract(6, 'days'), moment()],
            'Últimos 30 Dias': [moment().subtract(29, 'days'), moment()],
            'Este Mês': [moment().startOf('month'), moment().endOf('month')],
            'Mês Passado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        "locale": {
            "format": "DD/MM/YYYY",
            "separator": " - ",
            "applyLabel": "Aplicar",
            "cancelLabel": "Cancelar",
            "fromLabel": "De",
            "toLabel": "Até",
            "customRangeLabel": "Personalizado",
            "weekLabel": "S",
            "daysOfWeek": [
                "Dom",
                "Seg",
                "Ter",
                "Qua",
                "Qui",
                "Sex",
                "Sab"
            ],
            "monthNames": [
                "Janeiro",
                "Fevereiro",
                "Março",
                "Abril",
                "Maio",
                "Junho",
                "Julho",
                "Agosto",
                "Setembro",
                "Outubro",
                "Novembro",
                "Dezembro"
            ],
            "firstDay": 1
        },
        "linkedCalendars": false,
        "autoUpdateInput": true,
        "alwaysShowCalendars": true,
        "startDate": start.format('DD/MM/YYYY'),
        "endDate": end.format('DD/MM/YYYY'),
        "opens": "center",
        "drops": "auto"
        }, function(start, end, label) {
            cb(start, end);      
            console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
        });
       
        cb(start, end);    

        

        var col = document.querySelector('[data-coluna]');
        console.log(col);




});