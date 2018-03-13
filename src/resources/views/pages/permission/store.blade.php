<ddv-page-permission-edit
        :guardItems="{{ json_encode($guards) }}"
        {!!    isset($edit)? ':formData="'.htmlentities(json_encode($data)).'"':''  !!}
        title="{{ $title  }}"></ddv-page-permission-edit>