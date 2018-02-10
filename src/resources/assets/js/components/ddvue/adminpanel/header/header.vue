<template>
    <el-row type="flex" class="row-bg" justify="space-between">
        <el-col :xs="22" :sm="18" :md="10" :lg="12" :xl="12">
            <h3 style="padding:0 20px;">
                <slot name="title">网站后台文字banner</slot>
            </h3>
        </el-col>
        <el-col :span="4">
            <el-menu mode="horizontal" @select="handleSelect" v-if="auth!=null" menu-trigger="click" class="pull-right"
                     text-color="white" background-color="#409EFF">
                <el-submenu index="1">
                    <template slot="title">
                        <slot name="username">用户名</slot>
                    </template>
                    <el-menu-item index="2-3">退出</el-menu-item>
                </el-submenu>
            </el-menu>
        </el-col>
    </el-row>
</template>


<script>
    export default {
        name: 'DdvHeader',
        props: {},
        methods: {
            handleSelect(key, keyPath) {
                console.log(key, keyPath);
            }
        }
    }
</script>
<style>
    .row-bg {
        background-color: #409EFF;
        color: white;
    }

    .el-menu--popup {
        min-width: 100px !important;
    }
</style>