window._ = require("lodash");

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
  window.$ = window.jQuery = require("jquery");

  //require('bootstrap-sass');
  require("select2");
  require("bootstrap");
  require("popper.js");
  require("@coreui/coreui");
  require("@fortawesome/fontawesome-free");
  require("pace");
  require("gijgo");
  require("perfect-scrollbar");
  //require('select2-bootstrap4-theme');
  require("@coreui/coreui");
  require("chart.js");
  require("datatables.net-bs4")();
  require("datatables.net-buttons-bs4")($);
  require("datatables.net-buttons/js/buttons.colVis.js")();
  require("datatables.net-buttons/js/buttons.html5.js")();
  require("datatables.net-buttons/js/buttons.flash.js")();
  require("datatables.net-buttons/js/buttons.print.js")();
  var Highcharts = require("highcharts");
  // Load module after Highcharts is loaded
  require("highcharts/modules/exporting")(Highcharts);
  // Create the chart
  Highcharts.chart("container", {
    /*Highcharts options*/
  });

  // require('@ttskch/select2-bootstrap4-theme');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require("axios");

window.axios.defaults.headers.common["X-CSRF-TOKEN"] = window.Laravel.csrfToken;
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo'

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key'
// });
