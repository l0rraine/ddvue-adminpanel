<ddv-page-menu-edit
        :menuItems="{{ json_encode($menus) }}"
        :permissionItems="{{ json_encode($permissions) }}"
        {!!    isset($edit)? ':formData="'.htmlentities(json_encode($data)).'"':''  !!}
        title="{{ $title  }}"></ddv-page-menu-edit>