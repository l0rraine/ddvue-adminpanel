<template>
    <div class="navbar-container" id="navbar-container">
        <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
            <span class="sr-only">Toggle sidebar</span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>
        </button>

        <div class="navbar-header pull-left">
            <span class="navbar-brand">
                {{ title }}
            </span>

        </div>

        <div class="navbar-buttons navbar-header pull-right" role="navigation">
            <ul class="nav">

                <li class="dropdown-modal">
                    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                        <span>
									<small>欢迎,</small><b> {{ username }}</b>
								</span>

                        <i class="fa fa-caret-down"></i>
                    </a>

                    <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                        <li>
                            <a href="#">
                                <i class="fa fa-cog"></i>
                                设置
                            </a>
                        </li>

                        <li class="divider"></li>

                        <li>
                            <a href="#" @click="handleSelect('logout')">
                                <i class="fa fa-power-off"></i>
                                退出
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div><!-- /.navbar-container -->
    <!--<el-row type="flex" justify="space-between" style="height:100%;" >-->
    <!--<el-col :span="20" style="color:white">-->
    <!--<h3 style="padding:0 20px;">-->
    <!--{{ title }}-->
    <!--</h3>-->
    <!--</el-col>-->
    <!--<el-col :span="2">-->
    <!--<el-menu mode="horizontal" @select="handleSelect">-->
    <!--<el-submenu index="1">-->
    <!--<template slot="title">-->
    <!--{{ username }}-->
    <!--</template>-->
    <!--<el-menu-item index="logout" @select="handleSelect">退出</el-menu-item>-->
    <!--</el-submenu>-->
    <!--</el-menu>-->
    <!--</el-col>-->
    <!--</el-row>-->
</template>


<script>
    export default {
        name: 'DdvHeader',
        props: {
            title: String,
            username: String
        },
        computed: {
            logoutUrl: function () {
                return `${window.config.dashboard_url_prefix}/logout`;
            }
        },
        methods: {
            handleSelect(action) {
                if (action === 'logout') {
                    let that = this;
                    that.$http.post(that.logoutUrl).then(function (response) {
                        window.location.reload(true);
                    }).catch(error => {
                        console.log(that.status);
                    });
                }

            }
        }
    }
</script>
<style scoped>
    a {
        color: white;
    }

    a:hover, a:focus {
        color: black;
    }

    .navbar-brand {
        color: white;
    }

</style>