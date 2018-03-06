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
            <el-form-item label="姓名" prop="name">
                <el-input v-model="model.name" :disabled="isEdit"></el-input>
            </el-form-item>

            <el-form-item label="邮箱" prop="email" >
                <el-input v-model="model.email" :disabled="isEdit"></el-input>
            </el-form-item>
            <el-form-item label="密码" prop="password" type="password">
                <el-input v-model="model.password"></el-input>
            </el-form-item>
            <el-form-item label="单位" prop="dep_id">
                <el-select v-model="model.dep_id" placeholder="">
                    <el-option label="子菜单" value="submenu"></el-option>
                    <el-option label="组" value="group"></el-option>
                    <el-option label="项" value="item"></el-option>
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
                    title: '',
                    icon: '',
                    index: '',
                    type: '',
                    sort_id: 99,
                    parent_id: '',
                    owners: ''
                },
                rules: {
                    title: [
                        {required: true, message: '请输入菜单名称', trigger: 'blur'}
                    ],
                    type: [
                        {required: true, message: '必须选择菜单类型', trigger: 'change'}
                    ],
                    parent_id: [
                        {required: true, message: '必须选择父节点', trigger: 'change'}
                    ]
                }
            }
        },
        props: {
            menuItems: Array,
            ownerItems: Array,
        },
        methods: {}
    }
</script>
