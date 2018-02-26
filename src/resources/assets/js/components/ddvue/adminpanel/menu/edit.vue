<template>
    <el-dialog
            title="新增"
            :visible.sync="show"
            width="30%">
        <el-form ref="form" :model="form" label-width="80px">
            <el-form-item label="标题">
                <el-input v-model="form.title"></el-input>
            </el-form-item>
            <el-form-item label="路径名">
                <el-input v-model="form.index"></el-input>
            </el-form-item>
            <el-form-item label="类型">
                <el-select v-model="form.type" placeholder="">
                    <el-option label="submenu" value="submenu"></el-option>
                    <el-option label="group" value="group"></el-option>
                    <el-option label="item" value="item"></el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="排序">
                <el-input v-model="form.sort_id"></el-input>
            </el-form-item>
            <el-form-item label="父节点">
                <el-select v-model="form.parent_id" placeholder="">
                </el-select>
            </el-form-item>
        </el-form>
        <span slot="footer" class="dialog-footer">
            <el-button @click="show = false">取 消</el-button>
            <el-button type="primary" @click="show = false">确 定</el-button>
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
                    index: '',
                    type: '',
                    sort_id: '',
                    parent_id: '',
                },
                show: true
            }
        },
        props: {
        },
        methods: {
            onSubmit(index, data) {

            }
        }
    }
</script>
