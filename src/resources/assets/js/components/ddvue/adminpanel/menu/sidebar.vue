<template>
    <el-aside :width="width" style="border-right: solid 1px #e6e6e6;">
        <el-row class="tac">
            <el-col>
                <el-menu :default-openeds="openeds"
                         :mode="mode"
                         @select="onSelect"
                         class="ddv-menu"
                >
                    <ddv-submenu v-for="(m,i) in menuData" :submenu="m" :key="i+''"></ddv-submenu>
                </el-menu>
            </el-col>
        </el-row>
    </el-aside>
</template>
<script>
    export default {
        name: 'DdvSidebar',
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
            },
            menuData: {
                type: Array,
                default: function () { return []}
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