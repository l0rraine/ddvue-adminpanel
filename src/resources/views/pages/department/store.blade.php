<ddv-page-department-edit
        :departmentItems="{{ json_encode($departments) }}"
        {!!    isset($edit)? ':formData="'.htmlentities(json_encode($data)).'"':''  !!}
        title="{{ $title  }}"></ddv-page-department-edit>