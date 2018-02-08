
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');



window.Vue = require('vue');

import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
Vue.use(ElementUI);

Vue.prototype.$http = axios;


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


import App from './components/ddvue/adminpanel/app.vue';
Vue.component(App.name, App);


import Sidebar from './components/ddvue/adminpanel/menu/sidebar.vue';
Vue.component(Sidebar.name, Sidebar);

import DdvSubmenu from './components/ddvue/adminpanel/menu/submenu.vue';
Vue.component(DdvSubmenu.name, DdvSubmenu);

import DdvMenuGroup from './components/ddvue/adminpanel/menu/menugroup.vue';
Vue.component(DdvMenuGroup.name, DdvMenuGroup);


