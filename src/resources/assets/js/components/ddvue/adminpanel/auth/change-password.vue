<template>
    <ddv-page-user-change-password :formData="formData"
                                   @afterPost="postCallBack"
                                   :postUrl="url"></ddv-page-user-change-password>
</template>
<script>
    export default {
        name: 'DdvChangePassword',
        data() {
            return {
                url: `${window.config.dashboard_url_prefix}/user/changepassword`
            }
        },
        props: {
            formData: Object
        },
        methods: {
            postCallBack: function () {
                const that = this;
                const logoutUrl = `${window.config.dashboard_url_prefix}/logout`;

                setTimeout(function () {
                    that.$http.post(logoutUrl).then(function (response) {
                        window.location.reload(true);
                    }).catch(error => {
                        console.log(that.status);
                    });
                }, 500);


            }
        }
    }
</script>
