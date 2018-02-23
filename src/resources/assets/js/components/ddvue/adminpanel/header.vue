<template>
    <el-row type="flex" class="row-bg" justify="space-between">
        <el-col :xs="22" :sm="18" :md="10" :lg="12" :xl="12">
            <h3 style="padding:0 20px;">
                {{ title }}
            </h3>
        </el-col>
        <el-col :span="1">
            <el-menu mode="horizontal" @select="handleSelect" menu-trigger="click" class="pull-right"
                     >
                <el-submenu index="1">
                    <template slot="title">
                        {{ username }}
                    </template>
                    <el-menu-item index="logout" @select="handleSelect">退出</el-menu-item>
                </el-submenu>
            </el-menu>
        </el-col>
    </el-row>
</template>


<script>
    export default {
        name: 'DdvHeader',
        props: {
            title: String,
            username: String
        },
        computed: {
          logoutUrl: function(){
              let t = window.config.login_type=='ldap'?'ldap':'name'
              return `${window.config.dashboard_url_prefix}/${t}logout`;
          }
        },
        methods: {
            handleSelect(key, keyPath) {
                if(keyPath[1]==='logout'){
                    let that = this;
                    that.$http.post(that.logoutUrl).then(function (response) {
                        window.location.replace(window.location.href)
                    }).catch(error => {
                        console.log(that.status);
                    });
                }

            }
        }
    }
</script>
<style scoped>
    /*.row-bg {*/
        /*background-color: #409EFF;*/
        /*color: white;*/
    /*}*/

    .el-menu--popup {
        min-width: 100px !important;
    }
    .el-menu--horizontal {
        background-color:transparent !important;
    }
</style>