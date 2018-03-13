<ddv-page-permission-list :breadcrumbData="{{ json_encode($crud->navigator) }}"
                    :showImportBtn="false"
                    tableDataUrl="{{ route('Ddvue.AdminPanel.permission.indexJson') }}">

</ddv-page-permission-list>

