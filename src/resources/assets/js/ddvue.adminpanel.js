
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



Vue.mixin({
    methods:{
        sendTo(id,url) {
            this.$http.get(url).then(function (response) {
                const v = response.data;
                let MyComponent = Vue.extend({
                    template: v
                });
                let component = new MyComponent().$mount();
                document.getElementById(id).innerHTML = '';
                document.getElementById(id).appendChild(component.$el)
            });
        }
    },

})
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import DdvLogin from './components/ddvue/adminpanel/auth/login.vue';
Vue.component(DdvLogin.name, DdvLogin);

import DdvApp from './components/ddvue/adminpanel/layout/app.vue';
Vue.component(DdvApp.name, DdvApp);

import DdvHeader from './components/ddvue/adminpanel/layout/header.vue';
Vue.component(DdvHeader.name, DdvHeader);

import DdvSidebar from './components/ddvue/adminpanel/layout/sidebar/sidebar.vue';
Vue.component(DdvSidebar.name, DdvSidebar);

import DdvSubmenu from './components/ddvue/adminpanel/layout/sidebar/submenu.vue';
Vue.component(DdvSubmenu.name, DdvSubmenu);

import DdvMenuGroup from './components/ddvue/adminpanel/layout/sidebar/menugroup.vue';
Vue.component(DdvMenuGroup.name, DdvMenuGroup);

import DdvWelcome from './components/ddvue/adminpanel/welcome.vue';
Vue.component(DdvWelcome.name, DdvWelcome);

import DdvMenuList from './components/ddvue/adminpanel/menu/list.vue';
Vue.component(DdvMenuList.name, DdvMenuList);

import DdvMenuEdit from './components/ddvue/adminpanel/menu/edit.vue';
Vue.component(DdvMenuEdit.name, DdvMenuEdit);



