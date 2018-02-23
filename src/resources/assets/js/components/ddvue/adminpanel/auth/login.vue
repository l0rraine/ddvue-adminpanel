<template>
    <el-tabs v-model="activeName">
        <el-tab-pane label="中石化邮箱" name="1" v-if="showLdap">
            <el-form ref="form" :model="form" label-width="80px">
                <el-form-item label="邮箱">
                    <el-input v-model="form.email">
                        <template slot="append">@sinopec.com</template>
                    </el-input>
                </el-form-item>
                <el-form-item label="密码">
                    <el-input v-model="form.password" type="password">
                    </el-input>
                </el-form-item>
                <el-row>
                    <el-col :span="24">
                        <div class="grid-content bg-purple-dark"></div>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="19" :offset="5">
                        <el-checkbox v-model="form.remember" style="margin:0 20px;">自动登录</el-checkbox>
                        <el-button type="primary" style="width:50%" @click="doLdapLogin">确认</el-button>
                    </el-col>
                    <p class="help is-danger" v-show="status" v-text="status"></p>
                </el-row>

            </el-form>
        </el-tab-pane>
        <el-tab-pane label="用户名密码" name="2" v-if="showUsername">
            <el-form ref="form" :model="form" label-width="80px">
                <el-form-item label="用户名">
                    <el-input v-model="form.name">
                    </el-input>
                </el-form-item>
                <el-form-item label="密码">
                    <el-input v-model="form.password" type="password">
                    </el-input>
                </el-form-item>
                <el-row>
                    <el-col :span="24">
                        <div class="grid-content bg-purple-dark"></div>
                    </el-col>
                </el-row>

                <el-row>
                    <el-col :span="19" :offset="5">
                        <el-checkbox v-model="form.remember" style="margin:0 20px;">自动登录</el-checkbox>
                        <el-button type="primary" style="width:50%" @click="doNameLogin">确认</el-button>
                    </el-col>
                    <p class="help is-danger" v-show="status" v-text="status"></p>

                </el-row>
            </el-form>
        </el-tab-pane>
    </el-tabs>
</template>
<script>
    export default {
        name: 'DdvLogin',
        computed: {
            activeName: function () {
                if (this.type === 'ldap' || this.type === 'mix') {
                    return "1";
                } else {
                    return "2";
                }
            },
            showLdap: function () {
                if (this.type === 'ldap' || this.type === 'mix') {
                    return true;
                } else {
                    return false;
                }
            },
            showUsername: function () {
                if (this.type === 'db' || this.type === 'mix') {
                    return true;
                } else {
                    return false;
                }
            },
            urlPrefix: function () {
                return window.config.dashboard_url_prefix;
            }
        },
        data() {
            return {
                form: {
                    email: '',
                    password: '',
                    name: '',
                    remember: true
                },
                status: false
            }
        },
        props: {
            type: String,
        },
        methods: {
            doLdapLogin() {

                let that = this;
                that.$http.post(`${that.urlPrefix}/ldaplogin`, this.form).then(function (response) {
                    window.config.login_type='ldap';
                    window.location.replace(window.location.href);
                }).catch(error => {
                    that.status = error;
                    console.log(that.status);
                });
            },
            doNameLogin() {
                let that = this;
                that.$http.post(`${that.urlPrefix}/namelogin`, this.form).then(function (response) {
                    window.config.login_type='name';
                    window.location.replace(window.location.href)
                }).catch(error => {
                    that.status = error.response.data.message;
                    console.log(that.status);
                });
            }
        }
    }
</script>
