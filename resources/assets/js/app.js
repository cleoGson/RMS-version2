/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");
import VueRouter from "vue-router";
import { Form, HasError, AlertError } from "vform";
import routes from "./routes";
import VueProgressBar from "vue-progressbar";
import Highcharts from "highcharts";
import { mapState } from "vuex";
import Vuex from "vuex";
import Swal from "sweetalert2";
import "vue-ctk-date-time-picker/dist/vue-ctk-date-time-picker.css";
window.Swal = Swal;
window.moment = require("moment");
window.Form = Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
Vue.use(Highcharts);
Vue.component("mapState", mapState);
import Store from "./store";
Vue.use(Vuex);

const store = new Vuex.Store(Store);

/**
 * Components
 */

/*
Nprogress
 */

import "nprogress/nprogress.css";

/*
Spinner
 */

/**
 * Spinner
 *
 *
 */

Vue.component("spinner", require("vue-simple-spinner"));

/*
Plugins
 */

import Pagination from "./plugins/pagination";
Vue.use(Pagination);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component("example", require("./components/Example.vue").default);
Vue.component(
  "coin-add-component",
  require("./components/charts/AddComponent.vue").default
);
Vue.component("categories", require("./app.vue").default);
Vue.component(
  "chart-component",
  require("./components/charts/ChartComponent.vue").default
);

const app = new Vue({
  el: "#app"
});
Vue.use(VueRouter);
Vue.use({ mapState });

const toast = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 3000
});
window.toast = toast;
const router = new VueRouter({
  mode: "history",
  routes
});

window.Fire = new Vue();
Vue.filter("upperText", function(text) {
  return text.toUpperCase();
});
//Vue.use(DatatableFactory);

const options = {
  color: "#bffaf3",
  failedColor: "#874b4b",
  thickness: "5px",
  transition: {
    speed: "0.2s",
    opacity: "0.6s",
    termination: 300
  },
  autoRevert: true,
  location: "left",
  inverse: false
};

Vue.use(VueProgressBar, options);
