<ddv-page-menu-edit
        :menuItems="{{ json_encode($menus) }}"
        :ownerItems="{{ json_encode($roles) }}"
        {!!    isset($edit)? ':formData="'.htmlentities(json_encode($data)).'"':''  !!}
        title="{{ $title  }}"></ddv-page-menu-edit>