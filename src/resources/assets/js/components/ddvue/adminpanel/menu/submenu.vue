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



        <!--<el-submenu v-for="(m,i) in item.children" :index="i+''" v-if="item.type=='submenu'" :key="i+''">-->
        <!--<template slot="title"><i :class="m.icon"></i><span slot="title">{{m.title}}</span>-->
        <!--</template>-->
        <!--&lt;!&ndash;<template v-for="(c,i) in m.children" v-if="c.type=='group'">&ndash;&gt;-->
        <!--&lt;!&ndash;<el-menu-item-group>&ndash;&gt;-->
        <!--&lt;!&ndash;<template slot="title">{{ c.title }}</template>&ndash;&gt;-->
        <!--&lt;!&ndash;<template v-for="(c,i) in items.children" v-if="c.type=='submenu'">&ndash;&gt;-->
        <!--&lt;!&ndash;<ddv-menuitem :items="c"></ddv-menuitem>&ndash;&gt;-->
        <!--&lt;!&ndash;</template>&ndash;&gt;-->
        <!--&lt;!&ndash;</el-menu-item-group>&ndash;&gt;-->
        <!--&lt;!&ndash;</template>&ndash;&gt;-->

        <!--<el-menu-item v-for="item in m.children" :key="m.index" :index="m.index"-->
        <!--v-if="item.type=='item'">-->
        <!--<i :class="item.icon"></i><span slot="title">{{item.title}}</span>-->
        <!--</el-menu-item>-->

        <!--<template v-for="(c,i) in m.children" v-if="m.type=='submenu'">-->
        <!--<ddv-menuitem :item="c"></ddv-menuitem>-->
        <!--</template>-->

    </el-submenu>

</template>
<script>
    export default {
        name: 'DdvSubmenu',
        props: {
            submenu: {
                type: Object
            }
        }
    }
</script>