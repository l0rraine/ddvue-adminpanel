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
    methods: {
        sendTo(id, url, callback = function () {}) {
            this.$http.get(url).then(function (response) {
                const v = response.data;
                let MyComponent = Vue.extend({
                    template: v
                });
                let component = new MyComponent().$mount();
                document.getElementById(id).innerHTML = '';
                document.getElementById(id).appendChild(component.$el);
                callback();
            });
        },
        insertEl(that, url) {
            if (url === '') return;
            that.$http.get(url).then(function (response) {
                const v = response.data;
                let MyComponent = Vue.extend({
                    template: v
                });
                let component = new MyComponent().$mount();
                that.$el.appendChild(component.$el);
            });
        },
        reloadMain(url = '', callback = function () {}) {
            url = url || this.getMainUrl();
            this.sendTo('main', url, callback);
        },
        getUrlPrefix() {
            return window.config.dashboard_url_prefix;
        },
        getMainUrl() {
            return window.config.main_url;
        },
        convertToFormArray(obj) {
            let returnArray = [];
            Object.keys(obj).forEach(function (key) {
                returnArray.push({name: key, value: obj[key]});
            });
            return returnArray;
        }
    }

});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


import DdvLogin from './components/ddvue/adminpanel/auth/login.vue';

Vue.component(DdvLogin.name, DdvLogin);

import DdvChangePassword from './components/ddvue/adminpanel/auth/change-password.vue';

Vue.component(DdvChangePassword.name, DdvChangePassword);

/****************************  layout  ************************/
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

import DdvMain from './components/ddvue/adminpanel/layout/main.vue';

Vue.component(DdvMain.name, DdvMain);

import DdvBreadcrumbs from './components/ddvue/adminpanel/layout/breadcrumbs.vue';

Vue.component(DdvBreadcrumbs.name, DdvBreadcrumbs);

import DdvWelcome from './components/ddvue/adminpanel/welcome.vue';

Vue.component(DdvWelcome.name, DdvWelcome);

/**************************  后台菜单  **************************/
import DdvMenuList from './components/ddvue/adminpanel/menu/list.vue';

Vue.component(DdvMenuList.name, DdvMenuList);

import DdvMenuEdit from './components/ddvue/adminpanel/menu/edit.vue';

Vue.component(DdvMenuEdit.name, DdvMenuEdit);


/**************************  用户  **************************/
import DdvUserList from './components/ddvue/adminpanel/user/list.vue';

Vue.component(DdvUserList.name, DdvUserList);

import DdvUserEdit from './components/ddvue/adminpanel/user/edit.vue';

Vue.component(DdvUserEdit.name, DdvUserEdit);

import DdvPageUserChangePassword from './components/ddvue/adminpanel/user/change-password.vue';

Vue.component(DdvPageUserChangePassword.name, DdvPageUserChangePassword);

/**************************  单位  **************************/
import DdvDepartmentList from './components/ddvue/adminpanel/department/list.vue';

Vue.component(DdvDepartmentList.name, DdvDepartmentList);

import DdvDepartmentEdit from './components/ddvue/adminpanel/department/edit.vue';

Vue.component(DdvDepartmentEdit.name, DdvDepartmentEdit);

/**************************  角色管理  **************************/
import DdvRoleList from './components/ddvue/adminpanel/role/list.vue';

Vue.component(DdvRoleList.name, DdvRoleList);

import DdvRoleEdit from './components/ddvue/adminpanel/role/edit.vue';

Vue.component(DdvRoleEdit.name, DdvRoleEdit);


/**************************  数据导入  **************************/
import DdvImporter from './components/ddvue/adminpanel/importer/main.vue';

Vue.component(DdvImporter.name, DdvImporter);


import DdvImporterUpload from './components/ddvue/adminpanel/importer/upload.vue';

Vue.component(DdvImporterUpload.name, DdvImporterUpload);


import DdvImporterCorrectColumn from './components/ddvue/adminpanel/importer/correct-column.vue';

Vue.component(DdvImporterCorrectColumn.name, DdvImporterCorrectColumn);


import DdvImporterPreview from './components/ddvue/adminpanel/importer/preview.vue';

Vue.component(DdvImporterPreview.name, DdvImporterPreview);


