<template>
    <ddv-main :breadcrumbData="breadcrumbData">
        <ddv-crud-list :tableDataUrl="tableDataUrl"
                       :showTablepagination="false"
                       slot="content"
                       @onAdd="handleAdd">
            <el-table-column label="标题">
                <template slot-scope="scope">
                    <ddv-datatable-recursive-title :item="scope.row">
                        {{ scope.row.title }}
                    </ddv-datatable-recursive-title>
                </template>
            </el-table-column>
            <el-table-column prop="index" label="路径名" width="300"></el-table-column>
            <el-table-column prop="type" label="类型" width="180"></el-table-column>
            <el-table-column prop="sort_id" label="排序" width="180"></el-table-column>
            <el-table-column prop="owner" label="所有者" width="180"></el-table-column>
            <el-table-column label="操作" width="100">
                <template slot-scope="scope">
                    <el-button type="primary"
                               size="mini"
                               @click="handleEdit(scope.$index, scope.row)">编辑
                    </el-button>
                </template>
            </el-table-column>
        </ddv-crud-list>
    </ddv-main>

</template>
<script>
    export default {
        name: 'DdvPageMenuList',
        props: {
            breadcrumbData: Object,
            tableDataUrl: String,
        },
        methods: {
            handleEdit: function (index, value) {
                let that = this,
                    url  = `${that.getMainUrl()}/add`;
                that.insertEl(that, url);
            },
            handleAdd: function () {
                let that = this,
                    url  = `${that.getMainUrl()}/add`;
                that.insertEl(that, url);
            }
        }
    }
</script>
