<template>
    <ddv-main :breadcrumbData="breadcrumbData">
        <ddv-crud-list :tableDataUrl="tableDataUrl"
                       :showTablePagination="false"
                       :tableIsRecursive="true"
                       slot="content"
                       :showImportBtn="showImportBtn"
                       :showAddBtn="showAddBtn"
                       :showDelBtn="showDelBtn"
                       @onAdd="handleAdd"
                       @onDelete="handleDelete"
                       @onImport="handleImport">
            <el-table-column label="标题">
                <template slot-scope="scope">
                    <ddv-datatable-recursive-title :item="scope.row">
                        {{ scope.row.title }}
                    </ddv-datatable-recursive-title>
                </template>
            </el-table-column>
            <el-table-column prop="sort_id" label="排序" width="180"></el-table-column>
            <el-table-column prop="updated_at" label="更新时间" width="180"></el-table-column>
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
    import {BaseList} from '../mixins/base-list'

    export default {
        name: 'DdvPageDepartmentList',
        mixins: [BaseList]
    }
</script>
