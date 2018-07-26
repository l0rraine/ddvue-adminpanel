<template>
    <el-container>
        <el-header style="background-color: rgb(64, 158, 255);margin:0 20px;" height="56px">
            <ddv-header :title="title" :username="username"></ddv-header>
        </el-header>
        <el-container style="padding:0 20px;">
            <ddv-sidebar width="220px" :onSelect="handleSidebarMenuClick"
                         :menuData="settings.menu_data">
            </ddv-sidebar>
            <el-container>
                <el-main>
                    <div id="main">
                        <!--<ddv-welcome></ddv-welcome>-->
                    </div>

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
        },
        created() {
            this.getSettings();
        },
        mounted() {
            this.sendTo('main', `${window.config.dashboard_url_prefix}/welcome`);
        },
        methods: {
            getSettings() {
                const that = this;
                that.$http.get(`${window.config.dashboard_url_prefix}/settingsJson`).then(function (response) {
                    that.settings = response.data;
                    that.username = response.data.auth.displayname || response.data.auth.name;
                    window.config.loginType = response.data.login_type;
                }).catch(function (response) {
                    console.log('无法取得管理页面通用配置数据，错误信息如下：\n' + response);
                });
            },
            handleSidebarMenuClick(key, keyPath) {
                this.sendTo('main', keyPath[1], function () {
                    window.config.main_url = keyPath[1];
                });
            },
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
        height: 30px !important;
    }

    .el-footer span {
        /*line-height:60px;*/
        font-size: 65%;
        color: #8c8b8b;
    }
</style>