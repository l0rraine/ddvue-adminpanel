<template>
    <el-aside :width="width" style="border-right: solid 1px #e6e6e6;">
        <el-row class="tac">
            <el-col>
                <el-menu :default-openeds="openeds"
                         :mode="mode"
                         @select="onSelect"
                         class="ddv-menu"
                >
                    <ddv-submenu v-for="(m,i) in menus" :submenu="m" :key="i+''"></ddv-submenu>
                </el-menu>
            </el-col>
        </el-row>
    </el-aside>
</template>
<script>
    export default {
        name: 'DdvSidebar',
        data() {
            return {
                menus: [],
            }
        },
        props: {
            target: {
                type: String,
                default: '#main'
            },
            width: {
                type: String,
                default: '300px'
            },
            mode: {
                type: String,
                default: 'vertical'
            },
            openeds: {
                type: Array,
                default: function () { return ['1'] }
            },
            onSelect: {
                type: Function,
                default: function () {}
            }
        },
        created() {
            this.fetchMenus();
        },
        methods: {
            fetchMenus() {
                const prefix = window.config.dashboard_url_prefix;
                const v = this;
                this.$http.get(`${prefix}/getmenus`).then(function (response) {
                    v.menus = response.data;
                }).catch(function (response) {
                    console.log('无法取得管理页面菜单数据，错误信息如下：\n' + response);
                });
            }

        }
    }
</script>

<style>
    .ddv-menu {
        display: inline-block;
        /*min-height: 400px;*/
        width: 100%;
        border-right: 0px;
    }
</style>