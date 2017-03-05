// Pickadate options
var pickadateOptions = {
  // Strings and translations
  monthsFull: [
    'Enero',
    'Febrero',
    'Marzo',
    'Abril',
    'Mayo',
    'Junio',
    'Julio',
    'Agosto',
    'Septiembre',
    'Octubre',
    'Noviembre',
    'Diciembre'
  ],
  monthsShort: [
    'Ene',
    'Feb',
    'Mar',
    'Abr',
    'May',
    'Jun',
    'Jul',
    'Ago',
    'Sep',
    'Oct',
    'Nov',
    'Dic'
  ],
  weekdaysFull: [
    'Domingo',
    'Lunes',
    'Martes',
    'Miércoles',
    'Jueves',
    'Viernes',
    'Sábado'
  ],
  weekdaysShort: [
    'Dom',
    'Lun',
    'Mar',
    'Mié',
    'Jue',
    'Vie',
    'Sáb'
  ],

  // Buttons
  today: 'Hoy',
  clear: '',
  close: 'Cerrar',

// Accessibility labels
  labelMonthNext: 'Mes siguiente',
  labelMonthPrev: 'Mes anterior',
  labelMonthSelect: 'Seleccionar mes',
  labelYearSelect: 'Seleccionar año',

// Formats
  format: 'd mmmm, yyyy',
  formatSubmit: 'yyyy/mm/dd',
  // hiddenPrefix: undefined,
  // hiddenSuffix: '_submit',
  hiddenName: true,

// Editable input
  editable: undefined,

// Dropdown selectors
  selectYears: undefined,
  selectMonths: undefined,

// First day of the week
  firstDay: undefined,

// Date limits
  min: undefined,
  max: undefined,

// Disable dates
  disable: undefined,

// Root picker container
  container: undefined,

// Hidden input container
  containerHidden: undefined,

// Close on a user action
//   closeOnSelect: true,
//   closeOnClear: true,

// Events
//   onStart: undefined,
//   onRender: undefined,
//   onOpen: undefined,
//   onClose: undefined,
//   onSet: undefined,
//   onStop: undefined,

}

// Initialize things
$(function () {
  // Initialize select boxes and datepicker
  $('select').material_select();
  var $input = $('.datepicker').pickadate(pickadateOptions);

  // Get the picker object
  var picker = $input.pickadate('picker');

  // Start with today's date
  picker.set('select', new Date());

  // Close picker when a date is selected
  picker.on({
      set: function (arg) {
        // Prevent closing on selecting month/year
        if ('select' in arg) {
          this.close();
        }
      }
    }
  );
});

