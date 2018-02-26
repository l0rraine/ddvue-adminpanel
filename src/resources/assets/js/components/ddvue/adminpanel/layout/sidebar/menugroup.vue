<template>
    <el-menu-item-group v-if="group.type=='group'">
        <template slot="title">{{ group.title }}</template>

        <template v-for="(item,i) in group.children" v-if="item.type=='group'">
            <ddv-menu-group :group="item"></ddv-menu-group>
        </template>


        <el-menu-item v-for="item in group.children" :key="item.index" :index="item.index"
                      v-if="item.type=='item'">
            <i :class="item.icon"></i><span slot="title">{{item.title}}</span>
        </el-menu-item>

    </el-menu-item-group>
</template>


<script>
    export default {
        name: 'DdvMenuGroup',
        props: {
            group: {
                type: Object
            }
        }
    }
</script>