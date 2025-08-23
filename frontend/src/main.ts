import './assets/main.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'

import $ from "jquery";
import _ from "lodash"
import "datatables.net";
import "dropzone/dist/dropzone-min.js";
import * as VanillaCalendarPro from "vanilla-calendar-pro";

window._ = _;
window.$ = $;
window.jQuery = $;
window.DataTable = $.fn.dataTable;
window.VanillaCalendarPro = VanillaCalendarPro;

const app = createApp(App)

app.use(createPinia())
app.use(router)

app.mount('#app')

import("preline/dist/index.js");

