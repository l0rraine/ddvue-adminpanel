<template>
    <el-container style="height:100%">
        <el-header>
            <ddv-header :title="title" :username="username"></ddv-header>
        </el-header>
        <el-container style="padding:0 20px;">
            <el-container>
                <ddv-sidebar width="220px" :onSelect="handleSidebarMenuClick"
                             :menuData="settings.menu_data">
                </ddv-sidebar>
                <el-container>
                    <el-main>
                        <el-container id="main"></el-container>
                    </el-main>
                    <el-footer></el-footer>
                </el-container>
            </el-container>
        </el-container>
    </el-container>
</template>

<script>
    export default {
        name: 'DdvApp',
        data() {
            return {
                settings: '',
                username: ''
            }
        },
        computed: {
            title: () => window.config.dashboard_name,
            prefix: () => window.config.dashboard_url_prefix,
        },
        created() {
            this.getSettings();
        },
        methods: {
            getSettings() {
                const v = this;
                v.$http.get(`${this.prefix}/settingsJson`).then(function (response) {
                    v.settings = response.data;
                    v.username = response.data.auth.name;
                }).catch(function (response) {
                    console.log('无法取得管理页面通用配置数据，错误信息如下：\n' + response);
                });
            },
            handleSidebarMenuClick(key, keyPath) {
                this.sendToMain(keyPath[1]);
            },
            sendToMain(url) {
                this.$http.get(url).then(function (response) {
                    const v = response.data;
                    let MyComponent = Vue.extend({
                        template: v
                    });
                    let component = new MyComponent().$mount();
                    document.getElementById('main').innerHTML = '';
                    document.getElementById('main').appendChild(component.$el)
                });
            }
        }

    }
</script>