<template>
    <el-aside :width="width">
        <el-row class="tac">
            <el-col>
                <el-menu :default-openeds="openeds"
                         :mode="mode"
                         @select="onSelect"
                         class="ddv-menu"
                         :style="style"
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
                style: {
                    width: '100%'
                }
            }
        },
        props: {
            target: {
                type: String,
                default: '#main'
            },
            width: {
                type: [String, Number],
                default: '300px'
            },
            mode: {
                type: String,
                default: 'vertical'
            },
            openeds: {
                type: Array,
                default: function () { return [1] }
            },
            onSelect: {
                type: Function,
                default: function(){}
            }
        },
        created() {
            this.fetchMenus();
        },
        methods: {
            fetchMenus() {
                this.menus = [
                    {
                        title: '业务模块',
                        type: 'submenu',
                        icon: 'el-icon-menu',
                        index: '1',
                        children: [
                            {
                                title: '文章管理',
                                type: 'group',
                                index: '1-1',
                                children: [
                                    {
                                        title: '分类1',
                                        index: 'xxxx',
                                        type: 'item'
                                    },
                                    {
                                        title: '分类2',
                                        index: 'yyy',
                                        type: 'item'
                                    }
                                ]
                            },
                            {
                                title: '业务模块2',
                                type: 'submenu',
                                icon: 'el-icon-menu',
                                index: '3',
                                children: [
                                    {
                                        title: '分类3',
                                        index: 'zzz',
                                        type: 'item'
                                    }
                                ]
                            }
                        ]
                    },
                    {
                        title: '管理模块',
                        type: 'submenu',
                        icon: 'el-icon-setting',
                        index: '2',
                        children: [
                            {
                                title: '用户权限',
                                type: 'group',
                                index: '2-1',
                                children: [
                                    {
                                        title: '用户管理',
                                        index: 'xxxx',
                                        type: 'item'
                                    },
                                    {
                                        title: '权限管理',
                                        index: 'yyy',
                                        type: 'item'
                                    }
                                ]
                            }
                        ]
                    }
                ]
            }

        }
    }
</script>

<style>
    .ddv-menu {
        display: inline-block;
        min-height: 400px;
    }
</style>