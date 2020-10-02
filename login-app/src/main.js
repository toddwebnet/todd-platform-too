import Vue from 'vue';

import App from './components/App.vue'
import LoginForm from "./components/LoginForm";

import BootstrapVue from "bootstrap-vue"
import "bootstrap/dist/css/bootstrap.min.css"
import "bootstrap-vue/dist/bootstrap-vue.css"

import './chunks/icons.js'
import './config.js'


window.axios = require('axios');


Vue.config.productionTip = false
Vue.prototype.$http = axios

new Vue({
    render: h => h(App),
}).$mount('#app');
