<template>
    <el-dialog
            :title="title"
            :visible.sync="show"
            :close-on-click-modal="false"
            :close-on-press-escape="false"
            width="30%">
        <el-form ref="permissionEditForm"
                 :model="model"
                 label-width="120px"
                 :rules="rules">
            <el-form-item label="名称" prop="name">
                <el-input v-model="model.name"></el-input>
            </el-form-item>

            <el-form-item label="Guard" prop="guard_name">
                <el-select v-model="model.guard_name" placeholder="">
                    <el-option v-for="(g,i) in guardItems" :label="g" :value="g" :key="i"></el-option>
                </el-select>
            </el-form-item>

        </el-form>
        <span slot="footer" class="dialog-footer">
            <el-button @click="show = false">取 消</el-button>
            <el-button type="primary" @click="onSubmit('permissionEditForm')">确 定</el-button>
        </span>
    </el-dialog>
</template>
<script>
    import {BaseForm} from "../mixins/base-form"

    export default {
        name: 'DdvPagePermissionEdit',
        mixins: [BaseForm],
        data() {
            return {
                model: {
                    id: '',
                    name: '',
                    guard_name: '',
                },
                rules: {
                    name: [
                        {required: true, message: '请输入权限名称', trigger: 'blur'}
                    ],
                    guard_name: [
                        {required: true, message: '必须选择Guard', trigger: 'change'}
                    ]
                }
            }
        },
        props: {
            guardItems: Array,
        },
        methods: {}
    }
</script>
