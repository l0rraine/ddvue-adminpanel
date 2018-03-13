<ddv-page-role-edit
        :permissionItems="{{ json_encode($permissions) }}"
        :guardItems="{{ json_encode($guards) }}"
        {!!    isset($edit)? ':formData="'.htmlentities(json_encode($data)).'"':''  !!}
        title="{{ $title  }}"></ddv-page-role-edit>