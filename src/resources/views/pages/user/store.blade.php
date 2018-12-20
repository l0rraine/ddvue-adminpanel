<ddv-page-user-edit
        :roleItems='{{ json_encode($roles) }}'
        :depItems='{{ json_encode($departments) }}'
        {!!    isset($edit)? ':formData="'.htmlentities(json_encode($data)).'"':''  !!}
        :depQueryUrl="{{json_encode(route('Ddvue.AdminPanel.department.query'))}}"
        title="{{ $title  }}"></ddv-page-user-edit>