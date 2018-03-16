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
            return !!this.model.id;
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
            this.form = this.formData;
        }
    },
    methods: {
        onSubmit(formName) {
            const that = this;
            let p = '/add';
            if (that.model.id) p = '/edit';
            const url = that.postUrl || that.getMainUrl() + p;
            that.$refs[formName].validate((valid) => {
                if (valid) {
                    that.$http.post(url, that.form)
                        .then(function (response) {
                            that.doPostCallback(that);
                        })
                        .catch(function (e) {
                            if (e.response) {
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
                            } else {
                                console.log('component error:' + e);
                            }


                        });
                    return false;
                }
            });

        },
        doPostCallback(that) {
            that.show = false;
            // that.reloadMain();
            that.$eventHub.$emit('afterCrudFormPost', that.form, that.isEdit);
        }
    }
}