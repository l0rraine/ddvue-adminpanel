export const BaseForm = {
    data() {
        return {
            show: true
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
            return this.model.id ? true : false;
        }
    },

    props: {
        title: {
            type: String,
            default: '新增'
        },
        formData: Object,
        postUrl: String
    },
    created() {
        if (this.formData !== undefined) {
            this.model = this.formData;
        }
    },
    methods: {
        onSubmit(formName) {
            const that = this;
            let p = '/add';
            if (that.model.id) p = '/edit';
            that.$refs[formName].validate((valid) => {
                if (valid) {
                    that.$http.post(that.getMainUrl() + p, that.form)
                        .then(function (response) {
                            that.show = false;
                            that.reloadMain();
                        })
                        .catch(function (e) {
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

                        });
                    return false;
                }
            });

        }
    }
}