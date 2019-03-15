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


import VueBus from 'vue-bus';

Vue.use(VueBus);

Vue.prototype.$http = axios;

Vue.prototype.$eventHub = Vue.prototype.$eventHub || new Vue();

Vue.mixin({
    methods: {
        sendTo(id, url, callback = function () {}) {
            const that = this;
            that.$http.get(url).then(function (response) {
                const v = response.data;
                const MyComponent = Vue.extend({
                    template: v
                });
                const component = new MyComponent().$mount();
                document.getElementById(id).innerHTML = '';
                document.getElementById(id).appendChild(component.$el);
                // const el = that.$refs[id].$el;
                // el.replaceChild(component.$el,el.childNodes[0]);
                callback();
            }).catch(function (e) {
                that.handleError(e);
            });
        },
        insertEl(that, url, callback = function () {}) {
            if (url === '') return;
            that.$http.get(url).then(function (response) {
                const v = response.data;
                let MyComponent = Vue.extend({
                    template: v
                });
                const component = new MyComponent().$mount();
                callback(component);
                that.$el.appendChild(component.$el);

            }).catch(function (e) {
                that.handleError(e);
            });
        },
        handleError(e) {
            switch (e.response.status) {
                case 403:
                    window.location.reload(true);
                    break;
                default:
                    this.$message({
                        type: 'error',
                        duration: 4000,
                        message: e.message
                    });
                    break;

            }
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


/**************************  partials  **************************/
import DdvPartialsDropDownTwoColumns from './components/ddvue/adminpanel/partials/dropdown-two-columns';

Vue.component(DdvPartialsDropDownTwoColumns.name, DdvPartialsDropDownTwoColumns);

import DdvPartialsDropDownTwoRows from './components/ddvue/adminpanel/partials/dropdown-two-rows.vue';

Vue.component(DdvPartialsDropDownTwoRows.name, DdvPartialsDropDownTwoRows);


/****************************  layout  ************************/
import DdvApp from './components/ddvue/adminpanel/layout/app.vue';

Vue.component(DdvApp.name, DdvApp);

import DdvMainContainer from './components/ddvue/adminpanel/layout/main-container.vue';

Vue.component(DdvMainContainer.name, DdvMainContainer);

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

import DdvDepartmentSelect from './components/ddvue/crud/partials/department-select'

Vue.component(DdvDepartmentSelect.name, DdvDepartmentSelect);

/**************************  角色管理  **************************/
import DdvRoleList from './components/ddvue/adminpanel/role/list.vue';

Vue.component(DdvRoleList.name, DdvRoleList);

import DdvRoleEdit from './components/ddvue/adminpanel/role/edit.vue';

Vue.component(DdvRoleEdit.name, DdvRoleEdit);


/**************************  权限管理  **************************/
import DdvPermissionList from './components/ddvue/adminpanel/permission/list.vue';

Vue.component(DdvPermissionList.name, DdvPermissionList);

import DdvPermissionEdit from './components/ddvue/adminpanel/permission/edit.vue';

Vue.component(DdvPermissionEdit.name, DdvPermissionEdit);


/**************************  数据导入  **************************/
import DdvImporter from './components/ddvue/adminpanel/importer/main.vue';

Vue.component(DdvImporter.name, DdvImporter);


import DdvImporterUpload from './components/ddvue/adminpanel/importer/upload.vue';

Vue.component(DdvImporterUpload.name, DdvImporterUpload);


import DdvImporterCorrectColumn from './components/ddvue/adminpanel/importer/correct-column.vue';

Vue.component(DdvImporterCorrectColumn.name, DdvImporterCorrectColumn);


import DdvImporterPreview from './components/ddvue/adminpanel/importer/preview.vue';

Vue.component(DdvImporterPreview.name, DdvImporterPreview);

import DdvImporterProgress from './components/ddvue/adminpanel/importer/progress.vue';

Vue.component(DdvImporterProgress.name, DdvImporterProgress);


