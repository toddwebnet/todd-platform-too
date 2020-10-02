import Vue from 'vue'
import {library} from "@fortawesome/fontawesome-svg-core";
import { FontAwesomeIcon} from "@fortawesome/vue-fontawesome";
import {faUser, faKey} from "@fortawesome/free-solid-svg-icons";

library.add(faUser, faKey);
Vue.component('fa-icon', FontAwesomeIcon)
