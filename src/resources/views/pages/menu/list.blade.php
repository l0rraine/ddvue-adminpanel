<ddv-page-menu-list :breadcrumbData="{{ json_encode($crud->navigator) }}"
                    :showImportBtn="false"
                    :roleItems="{{ json_encode($roles) }}"
                    tableDataUrl="{{ route('Ddvue.AdminPanel.menu.indexJson') }}">

</ddv-page-menu-list>

