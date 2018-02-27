<template>
    <el-dialog
            :title="title"
            :visible.sync="show"
            :close-on-click-modal="false"
            :close-on-press-escape="false"
            width="30%">
        <el-form ref="menuEditForm"
                 :model="form"
                 label-width="120px"
                 :rules="rules">
            <el-form-item label="标题" prop="title">
                <el-input v-model="form.title"></el-input>
            </el-form-item>

            <el-form-item label="路径名" prop="index">
                <el-input v-model="form.index"></el-input>
            </el-form-item>
            <el-form-item label="类型" prop="type">
                <el-select v-model="form.type" placeholder="">
                    <el-option label="子菜单" value="submenu"></el-option>
                    <el-option label="组" value="group"></el-option>
                    <el-option label="项" value="item"></el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="排序" prop="sort_id">
                <el-input v-model="form.sort_id"></el-input>
            </el-form-item>
            <el-form-item label="父节点" required prop="parent_id">
                <el-select v-model="form.parent_id"
                           placeholder="请选择">
                    <ddv-crud-select-recursive-option :rootSelectable="true"
                                                      :items="menuItems"></ddv-crud-select-recursive-option>
                </el-select>
            </el-form-item>
            <el-form-item label="可访问角色" prop="owners">
                <el-select v-model="form.owners"
                           placeholder="请选择"
                           multiple>
                    <ddv-crud-select-recursive-option :items="ownerItems"></ddv-crud-select-recursive-option>
                </el-select>
            </el-form-item>
        </el-form>
        <span slot="footer" class="dialog-footer">
            <el-button @click="show = false">取 消</el-button>
            <el-button type="primary" @click="onSubmit('menuEditForm')">确 定</el-button>
        </span>
    </el-dialog>
</template>
<script>
    export default {
        name: 'DdvPageMenuEdit',
        data() {
            return {
                form: {
                    title: '',
                    icon: '',
                    index: '',
                    type: '',
                    sort_id: 99,
                    parent_id: '',
                    owners: ''
                },
                show: true,
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
            title: {
                type: String,
                default: '新增'
            }
        },
        methods: {
            onSubmit(formName) {
                const that = this;
                that.$refs[formName].validate((valid) => {
                    if (valid) {
                        that.$http.post(this.getMainUrl() + '/add', that.form).then(function (response) {
                            console.log(response);
                        });
                        return false;
                    }
                });

            },
        }
    }
</script>
