$(document).ready(function () {
    var calendar = $('#calendar').fullCalendar({
        editable: true,
        selectable: true,
        selctHelper: true,
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        buttonText: {
            today: 'today',
            month: 'month',
            week: 'week',
            day: 'day'
        },
        events: "<?php echo base_url('calendar/load');?>",
    });
});