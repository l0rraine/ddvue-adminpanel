<ddv-page-user-edit
        {!!    isset($edit)? ':formData="'.htmlentities(json_encode($data)).'"':''  !!}
        title="{{ $title  }}"></ddv-page-user-edit>