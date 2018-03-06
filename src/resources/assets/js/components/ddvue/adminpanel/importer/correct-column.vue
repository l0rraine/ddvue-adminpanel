<template>
    <el-form :model="model" :inline="true">
        <el-form-item label="起始行" prop="start">
            <el-input v-model="model.start" style="width:50px;"></el-input>
        </el-form-item>
        <el-form-item label="结束行" prop="end">
            <el-input v-model="model.end" style="width:50px;"></el-input>
        </el-form-item>
        <el-form-item label="模型" prop="model" style="float:right;">
            <el-select v-model="model.model" placeholder="">
                <el-option label="子菜单" value="0"></el-option>
                <el-option label="组" value="1"></el-option>
                <el-option label="项" value="2"></el-option>
            </el-select>
        </el-form-item>
        <el-table>

        </el-table>
    </el-form>
</template>
<script>

    export default {
        name: 'DdvImporterCorrectColumn',
        data() {
            return {
                model: {
                    start: 0,
                    end: 0,
                    model: ''
                }
            }
        },
        props: {
            columnModel: Array,
            end: Number
        }
    }
</script>