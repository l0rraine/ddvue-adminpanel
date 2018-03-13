<ddv-page-role-list :breadcrumbData="{{ json_encode($crud->navigator) }}"
                    :showImportBtn="false"
                    tableDataUrl="{{ route('Ddvue.AdminPanel.role.indexJson') }}">

</ddv-page-role-list>

