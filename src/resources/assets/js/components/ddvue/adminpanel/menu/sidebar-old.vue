<template>
    <el-aside :width="width">
        <el-row class="tac">
            <el-col>
                <el-menu class=""
                         :default-openeds="openeds"
                         :mode="mode"
                         @select="handleSelect"
                >
                    <template v-for="(menu,index) in menus">
                        <el-submenu :index="index+''">
                            <template slot="title"><i :class="menu.icon"></i><span slot="title">{{menu.title}}</span>
                            </template>

                            <template v-for="(c,i) in menu.children" v-if="c.type=='group'">
                                <el-menu-item-group>
                                    <template slot="title">{{ c.title
                                        }}
                                    </template>
                                    <el-menu-item v-for="item in c.children" :key="item.index" :index="item.index"
                                                  v-if="item.type=='item'">
                                        <i :class="item.icon"></i><span slot="title">{{item.title}}</span>
                                    </el-menu-item>
                                </el-menu-item-group>
                            </template>

                            <el-menu-item v-for="item in menu.children" :key="item.index" :index="item.index"
                                          v-if="item.type=='item'">
                                <i :class="item.icon"></i><span slot="title">{{item.title}}</span>
                            </el-menu-item>
                        </el-submenu>
                    </template>
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
                menus: []
            }
        },
        props: {
            target: {
                type: String,
                default: '#main'
            },
            width: {
                type: [String, Number],
                default: '220px'
            },
            mode: {
                type: String,
                default: 'vertical'
            },
            openeds: {
                type: Array,
                default: function () { return [1] }
            }
        },
        mounted() {
            this.fetchMenus();
        },
        methods: {
            handleSelect(key, keyPath) {
                var v = this;
                this.$http.get(keyPath[1]).then(function (response) {
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

            },
            fetchMenus() {
                this.menus =  [
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