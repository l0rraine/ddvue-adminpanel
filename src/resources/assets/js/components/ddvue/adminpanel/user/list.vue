<template>
    <ddv-main :breadcrumbData="breadcrumbData">
        <ddv-crud-list :tableDataUrl="tableDataUrl"
                       :showTablepagination="true"
                       :tableIsRecursive="false"
                       slot="content"
                       :showImportBtn="showImportBtn"
                       :showAddBtn="showAddBtn"
                       :showDelBtn="showDelBtn"
                       @onAdd="handleAdd"
                       @onDelete="handleDelete"
                       @onImport="handleImport">
            <el-table-column prop="name" label="姓名" width="180"></el-table-column>
            <el-table-column prop="email" label="邮箱" width="300"></el-table-column>
            <el-table-column label="单位" width="180"></el-table-column>
            <el-table-column  label="权限"></el-table-column>
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
        name: 'DdvPageUserList',
        mixins: [BaseList]
    }
</script>
