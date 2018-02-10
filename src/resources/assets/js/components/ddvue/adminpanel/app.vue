<template>
    <el-container style="height:100%">
        <el-header>
            <ddv-header :title="title" :username="settings.auth.name"></ddv-header>
        </el-header>
        <el-container style="padding:0 20px;">
            <el-container>
                <ddv-sidebar width="220px" :onSelect="handleSelect" :menuData="settings.menu_data"></ddv-sidebar>
                <el-container>
                    <el-main>
                        <slot name="content"></slot>
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
                settings: ''
            }
        },
        computed: {
            title: () => window.config.dashboard_name,
            prefix: () => window.config.dashboard_url_prefix
        },
        created() {
            this.getSettings();
        },
        methods: {
            getSettings: function () {
                const v = this;
                this.$http.get(`${this.prefix}/settingsJson`).then(function (response) {
                    v.settings = response.data;
                }).catch(function (response) {
                    console.log('无法取得管理页面通用配置数据，错误信息如下：\n' + response);
                });
            },
            handleSelect: function (key, keyPath) {
                this.$http.get(keyPath[1]).then(function (response) {
                    const v = response.data;
                    new Vue({
                        el: this.target,
                        render: function (h) {
                            return h('div', {
                                attrs: {
                                    id: this.target
                                },
                                domProps: {
                                    innerHTML: v.content
                                },
                            })
                        }
                    })
                });

            }
        }

    }
</script>