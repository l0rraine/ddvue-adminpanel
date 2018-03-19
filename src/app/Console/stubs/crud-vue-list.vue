<template>
    <ddv-main :breadcrumbData="breadcrumbData">
        <ddv-crud-list :tableDataUrl="tableDataUrl"
                       :showTablePagination="showTablePagination"
                       :tableIsRecursive="tableIsRecursive"
                       slot="content"
                       :showImportBtn="showImportBtn"
                       :showAddBtn="showAddBtn"
                       :showDelBtn="showDelBtn"
                       @onAdd="handleAdd"
                       @onDelete="handleDelete"
                       @onImport="handleImport">
            <!--<template slot="check-toggle">在这里添加选择才会显示的按钮</template>-->

            <!--<template slot="fix-slot">在这里添加固定显示的按钮</template>-->

            <!-- 在这里添加 <el-table-column> -->

            <el-table-column label="更新时间" prop="updated_at" width="180"></el-table-column>
            <el-table-column label="操作" width="100">
                <template slot-scope="scope">
                    <el-button type="primary"
                               size="mini"
                               @click="handleEdit(scope.$index, scope.row)">编辑
                    </el-button>

                    <!-- 在这里添加列按钮 -->

                </template>
            </el-table-column>
        </ddv-crud-list>
    </ddv-main>

</template>
<script>
    import {BaseList} from '../../ddvue/adminpanel/mixins/base-list'

    export default {
        name: 'dummy',
        mixins: [BaseList]
    }
</script>
