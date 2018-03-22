export const BaseList = {
    props: {
        showImportBtn: {
            type: Boolean,
            default: true
        },
        showAddBtn: {
            type: Boolean,
            default: true
        },
        showDelBtn: {
            type: Boolean,
            default: true
        },
        showTablePagination: {
            type: Boolean,
            default: true
        },
        tableIsRecursive: {
            type: Boolean,
            default: false
        },
        breadcrumbData: Object,
        tableDataUrl: String,
    },
    mounted() {
        this.$eventHub.$on('afterCrudFormPost', this.afterFormPost);
    },
    methods: {
        dateFormatter(row, column, cellValue) {
            return cellValue.substr(0, 10);
        },
        handleEdit: function (index, row) {
            let that = this,
                url  = `${that.getMainUrl()}/edit/${row.id}`;
            that.insertEl(that, url);
        },
        handleAdd: function () {
            let that = this,
                url  = `${that.getMainUrl()}/add`;
            that.insertEl(that, url);
        },
        handleDelete: function (selections) {
            const that = this,
                  url  = `${that.getMainUrl()}/del`;
            that.$confirm(`此操作将永久删除这 ${selections.length} 条记录, 是否继续?`, '提示', {
                confirmButtonText: '确定',
                cancelButtonText: '取消',
                type: 'warning'
            }).then(() => {
                let ids = [];
                selections.forEach(function (selection) {
                    ids.push(selection.id);
                });
                that.$http.post(url, ids).then(function (response) {
                    that.$message({
                        type: 'success',
                        message: '删除成功!'
                    });
                    that.$eventHub.$emit('crudListTableDataLoad');
                })
            });
        },
        handleImport: function () {
            const url = this.getUrlPrefix() + '/excel';
            this.insertEl(this, url);

        },
        afterFormPost() {
            this.$eventHub.$off('afterCrudFormPost');
            this.$eventHub.$emit('crudListTableDataLoad');
            this.$eventHub.$on('afterCrudFormPost', this.afterFormPost);
        }
    }
}