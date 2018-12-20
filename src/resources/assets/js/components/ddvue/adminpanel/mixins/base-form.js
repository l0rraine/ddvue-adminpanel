export const BaseForm = {
    data() {
        return {
            show: true,
            csrfToken: $('meta[name="csrf-token"]').attr('content'),
        }
    },
    computed: {
        form: {
            get: function () {
                return this.model;
            },
            set: function (val) {
                this.model = val;
            }
        },
        isEdit: function () {
            return !!this.model.id;
        }
    },

    props: {
        title: {
            type: String,
            default: '新增'
        },
        formData: {
            type: Object
        },
        postUrl: {
            type: String,
            default: ''
        }
    },
    created() {
        if (this.formData !== undefined) {
            this.form = this.formData;
        }
    },
    methods: {
        onSubmit(formName, url = '') {
            const that = this;
            let p = '/add';
            if (that.model.id) p = '/edit';
            url = url || that.postUrl || that.getMainUrl() + p;
            that.$refs[formName].validate((valid) => {
                if (valid) {
                    that.$http.post(url, that.form)
                        .then(function (response) {
                            that.$message({
                                type: 'success',
                                duration: 4000,
                                message: response.data.message || (that.model.id ? '修改' : '添加') + '成功'
                            });
                            that.doPostCallback(that);
                        })
                        .catch(function (e) {
                            if(e.response.status==419){
                                that.$message({
                                    type: 'info',
                                    duration: 4000,
                                    message: '身份验证超时'
                                });
                                window.location.reload(true);

                            }
                            if (e.response.data.errors) {
                                const errors = e.response.data.errors;
                                const form = that.$refs[formName];
                                form.fields.forEach(function (field) {
                                    Object.keys(errors).forEach(function (e) {
                                        if (field.prop === e) {
                                            field.validateState = 'error';
                                            field.validateMessage = errors[e].join('<br>');
                                        }
                                    });
                                });
                            }
                            if (e.response.data.exception) {
                                that.$message({
                                    type: 'error',
                                    duration: 4000,
                                    message: e.response.data.message
                                });
                            }
                            if(e.response.exception){
                                console.log(e)
                            }


                        });
                    return false;
                }
            });

        },
        doPostCallback(that) {
            that.show = false;
            // that.reloadMain();
            that.$eventHub.$emit('afterCrudFormPost');
        }
    }
}