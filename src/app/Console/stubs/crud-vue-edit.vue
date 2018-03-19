<template>
    <el-dialog
            :title="title"
            :visible.sync="show"
            :close-on-click-modal="false"
            :close-on-press-escape="false"
            width="30%">
        <el-form ref="dummy_form_name"
                 :model="model"
                 label-width="120px"
                 :rules="rules">

            <!-- 在这里添加 <el-form-item> -->

        </el-form>
        <span slot="footer" class="dialog-footer">
            <el-button @click="show = false">取 消</el-button>
            <el-button type="primary" @click="onSubmit('dummy_form_name')">确 定</el-button>
        </span>
    </el-dialog>
</template>
<script>
    import {BaseForm} from "../../ddvue/adminpanel/mixins/base-form"

    export default {
        name: 'dummy_name',
        mixins: [BaseForm],
        data() {
            return {
                model: {
                },
                rules: {
                }
            }
        },
        computed: {
        },
        props: {
        },
        methods: {}
    }
</script>
