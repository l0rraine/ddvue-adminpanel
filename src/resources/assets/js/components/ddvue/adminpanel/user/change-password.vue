<template>
    <el-dialog
            title="修改密码"
            :visible.sync="show"
            :close-on-click-modal="false"
            :close-on-press-escape="false"
            width="30%">
        <el-form ref="changePasswordForm"
                 :model="model"
                 label-width="120px"
                 :rules="rules">
            <el-form-item label="密码" prop="password">
                <el-input v-model="model.password" type="password"></el-input>
            </el-form-item>

            <el-form-item label="重复密码" prop="password_confirmation">
                <el-input v-model="model.password_confirmation" type="password"></el-input>
            </el-form-item>

        </el-form>
        <span slot="footer" class="dialog-footer">
            <el-button @click="show = false">取 消</el-button>
            <el-button type="primary" @click="onSubmit('changePasswordForm')">确 定</el-button>
        </span>
    </el-dialog>
</template>
<script>
    import {BaseForm} from "../mixins/base-form"

    export default {
        name: 'DdvPageUserChangePassword',
        mixins: [BaseForm],
        data() {
            const that = this;
            let validatePass = (rule, value, callback) => {
                if (value === '') {
                    callback(new Error('请输入密码'));
                } else {
                    if (that.model.password_confirmation !== '') {
                        that.$refs.changePasswordForm.validateField('password_confirmation');
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
            return {
                model: {
                    id: '',
                    password: '',
                    password_confirmation: '',
                },
                rules:{
                    password:[
                        {required: true, validator: validatePass, trigger: 'blur'}
                    ],
                    password_confirmation:[
                        {required: true, validator: validatePass2, trigger: 'blur'}
                    ]
                }
            }
        },
        methods: {
            doPostCallback:function(that){
                that.$bus.emit('afterCrudFormPost');
                that.show = false;
                that.$message({
                    type: 'success',
                    message: '修改密码成功!'
                });

            }
        },

    }
</script>
