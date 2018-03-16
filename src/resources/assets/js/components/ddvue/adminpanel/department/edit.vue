<template>
    <el-dialog
            :title="title"
            :visible.sync="show"
            :close-on-click-modal="false"
            :close-on-press-escape="false"
            width="30%">
        <el-form ref="departmentEditForm"
                 :model="model"
                 label-width="120px"
                 :rules="rules">
            <el-form-item label="单位名称" prop="title">
                <el-input v-model="model.title"></el-input>
            </el-form-item>

            <el-form-item label="排序" prop="sort_id">
                <el-input v-model="model.sort_id"></el-input>
            </el-form-item>


            <el-form-item label="父节点" prop="parent_id">
                <el-select v-model="model.parent_id"
                           placeholder="请选择">
                    <ddv-crud-select-recursive-option :rootSelectable="true"
                                                      :items="departmentItems"></ddv-crud-select-recursive-option>
                </el-select>
            </el-form-item>

        </el-form>
        <span slot="footer" class="dialog-footer">
            <el-button @click="show = false">取 消</el-button>
            <el-button type="primary" @click="onSubmit('departmentEditForm')">确 定</el-button>
        </span>
    </el-dialog>
</template>
<script>
    import {BaseForm} from "../mixins/base-form"

    export default {
        name: 'DdvPageDepartmentEdit',
        mixins: [BaseForm],
        data() {
            return {
                model: {
                    id: '',
                    title: '',
                    sort_id: 99,
                    parent_id: '',
                },
                rules: {
                    title: [
                        {required: true, message: '请输入菜单名称', trigger: 'blur'}
                    ],
                    parent_id: [
                        {required: true, message: '必须选择父节点', trigger: 'change'}
                    ]
                }
            }
        },
        props: {
            departmentItems: Array,
        },
        methods: {}
    }
</script>
