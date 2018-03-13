<ddv-page-user-change-password
        postUrl="{{ route('Ddvue.AdminPanel.user.changepassword') }}"
        :formData='{{ json_encode($data) }}'></ddv-page-user-change-password>