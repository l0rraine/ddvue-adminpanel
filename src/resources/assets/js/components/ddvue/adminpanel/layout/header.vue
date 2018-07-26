<template>

    <b-navbar toggleable="md" type="dark" variant="info">

        <b-navbar-toggle target="nav_collapse"></b-navbar-toggle>

        <b-navbar-brand href="#" @click="gotoWelcome">{{ title }}</b-navbar-brand>

        <b-collapse is-nav id="nav_collapse">

            <!-- Right aligned nav items -->
            <b-navbar-nav class="ml-auto">


                <b-nav-item-dropdown right>
                    <!-- Using button-content slot -->
                    <template slot="button-content">
                        <em><small>欢迎,</small><b> {{ username }}</b></em>
                    </template>
                    <b-dropdown-item href="#" @click="handleSelect('changePassword')">
                        <i class="fa fa-cog"></i>
                        修改密码
                    </b-dropdown-item>
                    <b-dropdown-item href="#" @click="handleSelect('logout')">
                        <i class="fa fa-power-off"></i>
                        退出
                    </b-dropdown-item>
                </b-nav-item-dropdown>
            </b-navbar-nav>

        </b-collapse>
    </b-navbar>


    <!--<div class="navbar-container" id="navbar-container">-->
        <!--<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">-->
            <!--<span class="sr-only">Toggle sidebar</span>-->

            <!--<span class="icon-bar"></span>-->

            <!--<span class="icon-bar"></span>-->

            <!--<span class="icon-bar"></span>-->
        <!--</button>-->

        <!--<div class="navbar-header pull-left">-->
            <!--<span class="navbar-brand">-->
                <!--<a @click="gotoWelcome" href="javascript:;" style="text-decoration: none;color:white;">{{ title }}</a>-->
            <!--</span>-->

        <!--</div>-->

        <!--<div class="navbar-buttons navbar-header pull-right" role="navigation">-->
            <!--<ul class="nav">-->

                <!--<li class="dropdown-modal">-->
                    <!--<a data-toggle="dropdown" href="#" class="dropdown-toggle">-->
                        <!--<span>-->
									<!--<small>欢迎,</small><b> {{ username }}</b>-->
								<!--</span>-->

                        <!--<i class="fa fa-caret-down"></i>-->
                    <!--</a>-->

                    <!--<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">-->
                        <!--<li>-->
                            <!--<a href="#" @click="handleSelect('changePassword')">-->
                                <!--<i class="fa fa-cog"></i>-->
                                <!--修改密码-->
                            <!--</a>-->
                        <!--</li>-->

                        <!--<li class="divider"></li>-->

                        <!--<li>-->
                            <!--<a href="#" @click="handleSelect('logout')">-->
                                <!--<i class="fa fa-power-off"></i>-->
                                <!--退出-->
                            <!--</a>-->
                        <!--</li>-->
                    <!--</ul>-->
                <!--</li>-->
            <!--</ul>-->
        <!--</div>-->
    <!--</div>&lt;!&ndash; /.navbar-container &ndash;&gt;-->
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
            },
            changePwdUrl:function(){
                return `${window.config.dashboard_url_prefix}/changepassword`;
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
                } else if (action === 'changePassword') {
                    let that = this;
                    that.insertEl(that, that.changePwdUrl);
                }

            },
            gotoWelcome() {
                const link = `${window.config.dashboard_url_prefix}/welcome`;
                this.reloadMain(link);
            }
        }
    }
</script>
<style scoped>
    .bg-info{
        background-color: rgb(64, 158, 255) !important;
    }
    /*a {*/
        /*color: white;*/
    /*}*/

    /*a:hover, a:focus {*/
        /*color: black;*/
    /*}*/

    /*.navbar-brand {*/
        /*color: white;*/
    /*}*/

</style>