<template>
    <ddv-main :breadcrumbData="breadcrumbData">
        <ddv-crud-list :tableDataUrl="tableDataUrl"
                       :showTablepagination="true"
                       :tableIsRecursive="false"
                       slot="content"
                       :showImportBtn="false"
                       :showAddBtn="showAddBtn"
                       :showDelBtn="showDelBtn"
                       @onAdd="handleAdd"
                       @onDelete="handleDelete"
                       @onImport="handleImport">
            <el-table-column prop="name" label="用户名" width="100" v-if="loginType!='ldapOnly'"></el-table-column>
            <el-table-column prop="displayname" label="姓名" width="100" v-if="loginType!='nameOnly'"></el-table-column>
            <el-table-column prop="email" label="邮箱" width="200" v-if="loginType!='nameOnly'"></el-table-column>
            <el-table-column prop="department.title" label="单位" width="200"></el-table-column>
            <el-table-column label="角色">
                <template slot-scope="scope">
                    <el-tag v-for="(p,i) in scope.row.roles" :key="i" style="margin-left:5px;">{{ p.name }}</el-tag>
                </template>
            </el-table-column>
            <el-table-column prop="updated_at" label="更新时间" width="180"></el-table-column>
            <el-table-column label="操作" :width="actionWidth">
                <template slot-scope="scope">
                    <el-button type="primary"
                               size="mini"
                               @click="handleEdit(scope.$index, scope.row)">编辑
                    </el-button>
                    <el-button type="primary"
                               v-if="loginType!=='ldapOnly'"
                               size="mini"
                               @click="changePasswd(scope.$index, scope.row)">修改密码
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
        mixins: [BaseList],
        computed: {
            loginType: function () {
                return window.config.loginType;
            },
            actionWidth: function(){
                return this.loginType !== 'ldapOnly' ? 180 : 80;
            }
        },
        methods: {
            changePasswd: function (index, row) {
                let that = this;
                const changePwdUrl = `${that.getMainUrl()}/changepassword/${row.id}`;
                that.insertEl(that, changePwdUrl);
            }
        }
    }
</script>
