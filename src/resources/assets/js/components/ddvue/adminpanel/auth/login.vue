<template>
    <el-tabs v-model="activeName">
        <el-tab-pane label="中石化邮箱" name="1" v-if="showLdap">
            <el-form ref="ldapLoginForm" :model="form" label-width="80px">
                <el-form-item label="邮箱" prop="email">
                    <el-input v-model="form.email">
                        <template slot="append">@sinopec.com</template>
                    </el-input>
                </el-form-item>
                <el-form-item label="密码" prop="password">
                    <el-input v-model="form.password" type="password">
                    </el-input>
                </el-form-item>
                <el-row>
                    <el-col :span="24">
                        <div class="grid-content bg-purple-dark"></div>
                    </el-col>
                </el-row>
                <p class="help is-danger" v-show="status" v-text="status"></p>
                <el-row>
                    <el-col :span="19" :offset="5">
                        <el-checkbox v-model="form.remember" style="margin:0 20px;">自动登录</el-checkbox>
                        <el-button type="primary" style="width:50%" @click="doLogin('ldap','ldapLoginForm')">确认
                        </el-button>
                    </el-col>
                </el-row>

            </el-form>
        </el-tab-pane>
        <el-tab-pane label="用户名密码" name="2" v-if="showUsername">
            <el-form ref="nameLoginForm" :model="form" label-width="80px">
                <el-form-item label="用户名" prop="name">
                    <el-input v-model="form.name">
                    </el-input>
                </el-form-item>
                <el-form-item label="密码" prop="password">
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
                        <el-button type="primary" style="width:50%" @click="doLogin('name','nameLoginForm')">确认
                        </el-button>
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
            activeName: {
                get () {
                    return this.showLdap  ? "1" : "2";
                },
                set () { }

            },
            showLdap: function () {
                return this.type === 'ldap' || this.type === 'mix';
            },
            showUsername: function () {
                return this.type === 'db' || this.type === 'mix';
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
            doLogin(type, formName) {

                let that = this,
                    url  = that.urlPrefix;
                if (type === 'ldap') {
                    url = `${url}/ldaplogin`;
                } else {
                    url = `${url}/namelogin`;
                }

                that.$http.post(url, that.form).then(function (response) {
                    window.location.reload(true);
                }).catch(response => {
                    const errors = response.response.data.errors;
                    console.log(errors);
                    const form = that.$refs[formName];
                    form.fields.forEach(function (field) {
                        Object.keys(errors).forEach(function (e) {
                            if (field.prop === e) {
                                field.validateState = 'error';
                                field.validateMessage = errors[e].join('<br>');
                            }
                        });
                    });
                });
            }
        }
    }
</script>
