<template>
    <el-dialog
            :title="title"
            :visible.sync="show"
            :close-on-click-modal="false"
            :close-on-press-escape="false"
            width="30%">
        <el-form ref="userEditForm"
                 :model="model"
                 label-width="120px"
                 :rules="rules">
            <el-form-item label="用户名" prop="name" v-if="loginType!='ldapOnly'">
                <el-input v-model="model.name" :disabled="isEdit"></el-input>
            </el-form-item>

            <el-form-item label="用户名" prop="name" v-if="loginType=='ldapOnly'" v-show="false">
                <el-input v-model="model.name" disabled></el-input>
            </el-form-item>

            <el-form-item label="密码" prop="password" v-if="loginType!='ldapOnly' && !isEdit">
                <el-input v-model="model.password" type="password"></el-input>
            </el-form-item>

            <el-form-item label="密码" prop="password" v-if="loginType=='ldapOnly'" v-show="false">
                <el-input v-model="model.password" disabled></el-input>
            </el-form-item>


            <el-form-item label="重复密码" prop="password_confirmation" v-if="loginType!='ldapOnly' && !isEdit">
                <el-input v-model="model.password_confirmation" type="password"></el-input>
            </el-form-item>

            <el-form-item label="邮箱" prop="email" v-if="loginType!='nameOnly'">
                <el-input v-model="model.email" :disabled="isEdit"></el-input>
            </el-form-item>

            <el-form-item label="邮箱" prop="email" v-if="loginType=='nameOnly'" v-show="false">
                <el-input v-model="model.email" disabled></el-input>
            </el-form-item>

            <el-form-item label="单位" prop="dep_id">
                <ddv-department-select :queryUrl="depQueryUrl" @onChange="onSelectDep" :value="{'group':'','key':'id','id':model.dep_id,'value':model.department.title}"></ddv-department-select>
                <!--<el-select v-model="model.dep_id" placeholder="">-->
                <!--<ddv-crud-select-recursive-option :rootSelectable="false"-->
                <!--:items="depItems"></ddv-crud-select-recursive-option>-->
                <!--</el-select>-->
            </el-form-item>
            <el-form-item label="角色" prop="roles">
                <el-select v-model="model.roles" placeholder="" multiple>
                    <el-option v-for="(m,i) in roleItems" :label="m.name" :value="m.id" :key="i"></el-option>
                </el-select>
            </el-form-item>
        </el-form>
        <span slot="footer" class="dialog-footer">
            <el-button @click="show = false">取 消</el-button>
            <el-button type="primary" @click="onSubmit('userEditForm')">确 定</el-button>
        </span>
    </el-dialog>
</template>
<script>
    import {BaseForm} from "../mixins/base-form"

    export default {
        name: 'DdvPageUserEdit',
        mixins: [BaseForm],
        data() {
            return {
                model: {
                    id: '',
                    name: '',
                    displayname: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    dep_id: '',
                    roles: ''
                },
                rules: {
                    dep_id: [
                        {required: true, message: '必须选择单位', trigger: 'change'}
                    ]
                }
            }
        },
        created() {
            let that = this;
            let validatePass = (rule, value, callback) => {
                if (value === '') {
                    callback(new Error('请输入密码'));
                } else {
                    if (that.model.password_confirmation !== '') {
                        that.$refs['userEditForm'].validateField('password_confirmation');
                    }
                    callback();
                }
            };
            let validatePass2 = (rule, value, callback) => {
                if (value === '') {
                    callback(new Error('请再次输入密码'));
                } else if (value !== that.model.password) {
                    callback(new Error('两次输入密码不一致!'));
                } else {
                    callback();
                }
            };
            if (that.loginType !== 'nameOnly') {
                that.rules.email = [
                    {required: true, message: '必须输入邮箱', trigger: 'blur'}
                ];
            }

            if (that.loginType !== 'ldapOnly') {
                that.rules.name = [
                    {required: true, message: '必须输入用户名', trigger: 'blur'}
                ];
                that.rules.password = [
                    {required: true, validator: validatePass, trigger: 'blur'}
                ];
                that.rules.password_confirmation = [
                    {required: true, validator: validatePass2, trigger: 'blur'}
                ];
            }
        },
        props: {
            depItems: Array,
            roleItems: Array,
            depQueryUrl: String
        },
        computed: {
            loginType: function () {
                if (window.config.loginType === 'nameOnly') {
                    this.model.email = this.model.email || this.randomString(12) + '.slyt';
                }

                if (window.config.loginType === 'ldapOnly') {
                    this.model.name = this.model.name || this.randomString(12);
                    this.model.password = this.model.password || this.randomString(12);
                    this.model.password_confirmation = this.model.password;
                }
                return window.config.loginType;
            },
            form: {
                get: function () {
                    return this.model;
                },
                set: function (v) {
                    let roles = [];
                    v.roles.forEach(function (r) {
                        roles.push(r.id);
                    });
                    v.roles = roles;
                    this.model = v;

                }
            }
        },
        methods: {
            randomString: function (len) {
                len = len || 32;
                const $chars = 'ABCDEFGHJKMNPQRSTWXYZabcdefhijkmnprstwxyz2345678';
                /****默认去掉了容易混淆的字符oOLl,9gq,Vv,Uu,I1****/
                const maxPos = $chars.length;
                let pwd = '';
                for (let i = 0; i < len; i++) {
                    pwd += $chars.charAt(Math.floor(Math.random() * maxPos));
                }
                return pwd;
            },
            onSelectDep: function (item) {
                console.log(item)
                this.model.dep_id = item.id;
            }
        }
    }
</script>
