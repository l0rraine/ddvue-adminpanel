<ddv-page-user-list :breadcrumbData="{{ json_encode($crud->navigator) }}"
                    :showImportBtn="false"
                    tableDataUrl="{{ route('Ddvue.AdminPanel.user.indexJson') }}">

</ddv-page-user-list>

