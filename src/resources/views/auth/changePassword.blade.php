<ddv-change-password
        postUrl="{{ route('Ddvue.AdminPanel.user.changepassword') }}"
        :formData='{{ json_encode($data) }}'></ddv-change-password>