<admin-dummy-list :breadcrumbData="{{ json_encode($crud->navigator) }}"
                  :showImportBtn="false"
                  :showAddBtn="true"
                  :showDelBtn="true"
                  :showTablePagination="true"
                  :tableIsRecursive="false"
                  tableDataUrl="{{ route('Admin.dummy.indexJson') }}">
</admin-dummy-list>

