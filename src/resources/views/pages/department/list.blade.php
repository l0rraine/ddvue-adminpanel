<ddv-page-department-list :breadcrumbData="{{ json_encode($crud->navigator) }}"
                    :showImportBtn="false"
                    tableDataUrl="{{ route('Ddvue.AdminPanel.department.indexJson') }}">

</ddv-page-department-list>

