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
                       @onImport="handleImport"
                       @onTableSelectionChange="onChange">
            <template slot="check-toggle">
                <el-dropdown>
                    <el-button type="primary">
                        分配访问权限<i class="el-icon-arrow-down el-icon--right"></i>
                    </el-button>
                    <el-dropdown-menu slot="dropdown">
                        <el-dropdown-item v-for="(r,i) in permissionItems"
                                          @click.native="assignPermission(r)"
                                          :key="i">{{ r.name }}
                        </el-dropdown-item>

                    </el-dropdown-menu>
                </el-dropdown>
            </template>
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
            <el-table-column label="能访问的权限" width="180">
                <template slot-scope="scope">
                    <el-tag v-for="(p,i) in scope.row.limits" :key="i" disable-transitions style="margin-left:5px;">{{ getPermission(p) }}
                    </el-tag>
                </template>
            </el-table-column>
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
        name: 'DdvPageMenuList',
        mixins: [BaseList],
        data() {
            return {
                tableSelections: ''
            }
        },
        props: {
            permissionItems: Array,
        },
        methods: {
            assignPermission: function (row) {
                const that = this;
                const data = {
                    role_id: row.id,
                    selections: that.tableSelections
                };
                that.$http.post(`${that.getMainUrl()}/assignPermission`, data).then(function (response) {
                    that.$message({
                        type: 'success',
                        message: '分配权限成功!'
                    });
                    that.afterFormPost();
                }).catch(function (response) {
                    console.log('提交出错，错误信息如下：\n' + response);
                });
            },
            onChange: function (val) {
                this.tableSelections = val;
            },
            getPermission(index) {
                const that = this;
                let name = '';
                for(let i=0;i<that.permissionItems.length;i++){
                    const r = that.permissionItems[i];
                    if (r.id === index) {
                        name = r.name;
                        break;
                    }
                }

                return name;

            }
        }
    }
</script>
