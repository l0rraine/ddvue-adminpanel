<template>
    <el-container>
        <el-header>
            <ddv-header :title="title" :username="username"></ddv-header>
        </el-header>
        <el-container style="padding:0 20px;">
            <ddv-sidebar width="220px" :onSelect="handleSidebarMenuClick"
                         :menuData="settings.menu_data">
            </ddv-sidebar>
            <el-container>
                <el-main>
                    <el-container id="main">
                        <ddv-welcome></ddv-welcome>
                    </el-container>
                </el-main>
                <el-footer>
                    <span>© 2018 勘探开发研究院计算机室<br>电话:8715872</span>
                </el-footer>
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
                const that = this;
                that.$http.get(`${that.prefix}/settingsJson`).then(function (response) {
                    that.settings = response.data;
                    that.username = response.data.auth.name;
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
<style scoped lang="scss">
    .el-main {
        padding: 0px 20px 20px 20px !important;
    }

    .el-header {
        border-bottom: 1px solid #8c8b8b;
    }

    .el-footer {
        text-align: center;
    }

    .el-footer span {
        /*line-height:60px;*/
        font-size: 65%;
        color: #8c8b8b;
    }
</style>