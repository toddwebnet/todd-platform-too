import Vue from 'vue';

import App from './components/App.vue'
import './config.js'
import './chunks/axios.js'
import './chunks/bootstrap-vue'
import './chunks/cookies'

// Vue.config.productionTip = false


Vue.prototype.$globalValue = 'Global Scope!';

new Vue({
    render: h => h(App),
}).$mount('#app');
