var calendar, mesAtual, anoAtual, especialistaAtual;

function buscaAgendamentos(dia, mes, ano) {
    jQuery.ajax({
        url: base_url + '/wp-json/v1/agendamentos/',
        data: {
            mes: mes,
            ano: ano,
            especialista: especialistaAtual
        },
        success: (response) => {
            montaAgenda(response, ano + '-' + mes + '-' + dia)
        },
        error: () => {
            var calendarEl = document.getElementById('calendar');
            calendarEl.innerHTML('Erro ao carregar dados dos agendamentos!')
        }
    });
}

function montaAgenda(agendamentos, data) {
    var calendarEl = document.getElementById('calendar');
    calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'timeGridOneDay',
        headerToolbar: {
            left: '',
            center: 'title',
            right: '',
        },
        views: {
            timeGridOneDay: {
                type: 'timeGrid',
                duration: { days: 1 },
            }
        },
        allDaySlot: false,
        allDaySlot: false,
        slotDuration: '00:30:00',
        slotLabelFormat: {
            hour: '2-digit',
            minute: '2-digit',
            meridiem: false,
            hour12: false
        },
        slotMinTime: '08:00:00',
        slotMaxTime: '18:00:00',
        expandRows: true,
        events: agendamentos,
        eventTimeFormat: { // like '14:30:00'
            hour: '2-digit',
            minute: '2-digit',
            meridiem: false,
            hour12: false
        }
    });
    calendar.render();
    calendar.gotoDate(data);
}

document.addEventListener('DOMContentLoaded', function () {
    let hoje = new Date();

    if (!mesAtual) {
        mesAtual = hoje.getMonth() + 1;
        mesAtual = mesAtual < 10 ? '0' + mesAtual : mesAtual;
    }

    if (!anoAtual) {
        anoAtual = hoje.getFullYear();
    }

    if (!especialistaAtual) {
        especialistaAtual = jQuery('#especialista').val();
    }

    buscaAgendamentos(hoje.getDate(), mesAtual, anoAtual);

    jQuery('#send-form').on('click', () => {
        let novaBusca = false;
        let date = jQuery('#date').val();
        date = date.split('/').reverse();

        if (!especialistaAtual || especialistaAtual != jQuery('#especialista').val()) {
            especialistaAtual = jQuery('#especialista').val();
            novaBusca = true;
        }

        if (date[0] != anoAtual || date[1] != mesAtual) {
            anoAtual = date[0];
            mesAtual = date[1];
            novaBusca = true;
        } else {
            date = date.join('-');
            calendar.gotoDate(date);
        }

        if (novaBusca) {
            buscaAgendamentos(date[2], mesAtual, anoAtual);
        }

        return false;
    });
});
