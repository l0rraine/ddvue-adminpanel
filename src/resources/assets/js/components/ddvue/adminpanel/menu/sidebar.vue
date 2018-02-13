<template>
    <el-aside :width="width"  style="border-right: solid 1px #e6e6e6;">
        <el-row class="tac">
            <el-col>
                <el-menu :default-openeds="openeds"
                         @select="onSelect"
                         class="ddv-menu"
                         :mode="direction"
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
            width: {
                type: String,
                default: '300px'
            },
            direction: {
                type: String,
                default: 'vertical'
            },
            openeds: {
                type: Array,
                default: function () { return ['1'] }
            },
            onSelect: Function,
            menuData: Array
        }
    }
</script>

<style scoped>
    .ddv-menu {
        display: inline-block;
        /*min-height: 400px;*/
        width: 100%;
        border-right: 0px;
    }
</style>