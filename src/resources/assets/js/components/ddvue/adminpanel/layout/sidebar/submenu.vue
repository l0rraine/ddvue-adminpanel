<template>

    <el-submenu :index="submenu.index+''" v-if="submenu.type=='submenu'">
        <template slot="title">
            <i :class="submenu.icon"></i>
            <span slot="title">{{submenu.title}}</span>
        </template>


        <template v-for="item in submenu.children" v-if="item.type=='submenu'">
            <ddv-submenu :submenu="item"></ddv-submenu>
        </template>

        <template v-for="item in submenu.children" v-if="item.type=='group'">
            <ddv-menu-group :group="item"></ddv-menu-group>
        </template>


        <el-menu-item v-if="item.type=='item'"
                      v-for="item in submenu.children" :key="item.index" :index="item.index">
            <i :class="item.icon"></i><span slot="title">{{item.title}}</span>
        </el-menu-item>

    </el-submenu>

</template>
<script>
    export default {
        name: 'DdvSubmenu',
        props: {
            submenu: Object
        }
    }
</script>