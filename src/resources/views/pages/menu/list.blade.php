<ddv-page-menu-list :breadcrumbData="{{ json_encode($crud->navigator) }}"
                    :showImportBtn="false"
                    :permissionItems="{{ json_encode($permissions) }}"
                    tableDataUrl="{{ route('Ddvue.AdminPanel.menu.indexJson') }}">

</ddv-page-menu-list>

