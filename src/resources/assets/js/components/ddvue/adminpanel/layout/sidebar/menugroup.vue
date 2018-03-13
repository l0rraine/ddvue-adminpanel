<template>
    <el-menu-item-group v-if="group.type=='group'">
        <template slot="title">{{ group.title }}</template>

        <template v-for="(item,i) in group.children">
            <template v-if="item.type=='group'">
                <ddv-menu-group :group="item"></ddv-menu-group>
            </template>
            <template v-else="item.type=='item'">
                <el-menu-item :index="item.index">
                    <i :class="item.icon"></i><span slot="title">{{item.title}}</span>
                </el-menu-item>
            </template>
        </template>

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