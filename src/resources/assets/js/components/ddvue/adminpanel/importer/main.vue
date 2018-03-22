<template>
    <el-dialog title="导入数据"
               :visible.sync="show"
               :close-on-click-modal="false"
               :close-on-press-escape="false"
               width="50%">
        <el-steps :active="active" finish-status="success">
            <el-step title="上传"></el-step>
            <el-step title="预览"></el-step>
        </el-steps>
        <div :style="[uploadStyle,{margin:'20px 0'}]">
            <ddv-importer-upload @beforeUpload="beforeUpload"
                                 @handleSuccess="handleSuccess"></ddv-importer-upload>
        </div>
        <div :style="[previewStyle,{margin:'20px 0'}]">
            <ddv-importer-preview></ddv-importer-preview>
        </div>
        <div style="margin: 0 auto;text-align: center;margin-top: 12px;">
            <el-button @click="previous" v-show="active === 1">上一步</el-button>
            <el-button @click="next"  v-show="active=== 0">下一步</el-button>
            <el-button type="primary" @click="finish"  v-show="active === 1">完成</el-button>
        </div>


    </el-dialog>

</template>
<script>

    export default {
        name: 'DdvImporter',
        data() {
            return {
                show: true,
                active: 0,
                excelData: []
            }
        },
        computed: {
            postUrl: function () {
                return '';
            },
            uploadStyle: function () {
                if (this.active === 0) {
                    return {display: 'block'};
                } else {
                    return {display: 'none'};
                }
            },
            previewStyle: function () {
                if (this.active === 1) {
                    return {display: 'block'};
                } else {
                    return {display: 'none'};
                }
            }

        },
        props: {
            columnModel:Array,


        },
        methods: {
            handleSuccess: function () {

            },
            beforeUpload: function () {

            },
            next() {
                if (this.active++ > 1) this.active = 1;
            },
            previous() {
                if (this.active-- < 0) this.active = 0;
            },
            finish(){

            }
        }
    }
</script>
