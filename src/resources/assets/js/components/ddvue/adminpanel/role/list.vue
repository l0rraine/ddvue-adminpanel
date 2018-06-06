<template>
    <ddv-main :breadcrumbData="breadcrumbData">
        <ddv-crud-list :tableDataUrl="tableDataUrl"
                       :showTablePagination="true"
                       :tableIsRecursive="false"
                       slot="content"
                       :showImportBtn="showImportBtn"
                       :showAddBtn="showAddBtn"
                       :showDelBtn="showDelBtn"
                       @onAdd="handleAdd"
                       @onDelete="handleDelete"
                       @onImport="handleImport">
            <el-table-column prop="name" label="名称" width="180"></el-table-column>
            <el-table-column prop="guard_name" label="GuardName" width="180"></el-table-column>
            <el-table-column label="权限">
                <template slot-scope="scope">
                    <el-tag v-for="(p,i) in scope.row.permissions" :key="i" disable-transitions style="margin-left:5px;">{{ p.name }}</el-tag>
                </template>
            </el-table-column>
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
        name: 'DdvPageRoleList',
        mixins: [BaseList]
    }
</script>
