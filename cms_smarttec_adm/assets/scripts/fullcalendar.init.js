/**
 * Theme: Ninja Admin Template
 * Author: NinjaTeam
 * Module/App: Full Calendar
 */
(function($) {
	"use strict";

$(document).ready(function() {


	/* initialize the calendar
	-----------------------------------------------------------------*/

	if ($('#calendar').length){
		var todayDate = moment().startOf('day');
		var YM = todayDate.format('YYYY-MM');
		var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
		var TODAY = todayDate.format('YYYY-MM-DD');
		var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay,list'
			},
			buttonIcons: {
				prev: 'none fa fa-angle-left',
				next: 'none fa fa-angle-right',
				prevYear: 'none fa fa-angle-left',
				nextYear: 'none fa fa-angle-right'
			},
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			navLinks: true,
			droppable: true, // this allows things to be dropped onto the calendar
			drop: function(date, allDay) {
				var originalEventObject = $(this).data('eventObject');
				var valueArray = ($(this).attr('class')).split(" ");
				var thisClass;
				for(var i=0; i<valueArray.length; i++){
					if (valueArray[i].search("bg") > -1){
						thisClass = valueArray[i];
					}
				}
				var copiedEventObject = $.extend({}, originalEventObject);
				copiedEventObject.start = date;
				copiedEventObject.className = thisClass;
				$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
				// is the "remove after drop" checkbox checked?
				if ($('#drop-remove').is(':checked')) {
					// if so, remove the element from the "Draggable Events" list
					$(this).remove();
				}
			},
			
		});
		$('#external-events .fc-event').each(function () {
			// create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
			// it doesn't need to have a start or end
			var eventObject = {
				title: $.trim($(this).text()) // use the element's text as the event title
			};
			// store the Event Object in the DOM element so we can get to it later
			$(this).data('eventObject', eventObject);
			// make the event draggable using jQuery UI
			$(this).draggable({
				zIndex: 999,
				revert: true,      // will cause the event to go back to its
				revertDuration: 0  //  original position after the drag
			});
		});
	}

	if ($("#calendar-widget").length){
		$('#calendar-widget').fullCalendar({
			height: 470,
			header: {
				left: 'prev,next',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			buttonIcons: {
				prev: 'none fa fa-angle-left',
				next: 'none fa fa-angle-right',
				prevYear: 'none fa fa-angle-left',
				nextYear: 'none fa fa-angle-right'
			},
			editable: true,
			defaultDate: '2016-10-11'
		});
	}


});

})(jQuery);