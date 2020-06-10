require('./bootstrap');

window.Vue = require('vue');


import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import Axios from 'axios';
import config from './components/config';

import swal from 'sweetalert2';
window.Swal = swal;
window.App = config;


Vue.use(VueRouter,VueAxios,Axios);

import App from './components/App.vue';
import routes from './routes';
import { Icon } from 'leaflet';
import 'leaflet/dist/leaflet.css';
import 'ag-grid-community/dist/styles/ag-grid.css'
import 'ag-grid-community/dist/styles/ag-theme-alpine.css';
import 'vue-loading-overlay/dist/vue-loading.css';

delete Icon.Default.prototype._getIconUrl;

Icon.Default.mergeOptions({
  iconRetinaUrl: require('leaflet/dist/images/marker-icon-2x.png'),
  iconUrl: require('leaflet/dist/images/marker-icon.png'),
  shadowUrl: require('leaflet/dist/images/marker-shadow.png')
});


const router = new VueRouter({ mode: 'history', routes: routes });
new Vue(Vue.util.extend({ router }, App)).$mount("#app");