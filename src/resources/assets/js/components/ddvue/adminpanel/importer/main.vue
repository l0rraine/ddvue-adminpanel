<template>
    <el-dialog title="导入数据"
               :visible.sync="show"
               :close-on-click-modal="false"
               :close-on-press-escape="false"
               width="50%">
        <el-steps :active="active" finish-status="success">
            <el-step title="上传"></el-step>
            <el-step title="列对应"></el-step>
            <el-step title="预览"></el-step>
        </el-steps>
        <div :style="[uploadStyle,{margin:'20px 0'}]">
            <ddv-importer-upload @beforeUpload="beforeUpload"
                                 @handleSuccess="handleSuccess"></ddv-importer-upload>
        </div>
        <div :style="[correctorStyle,{margin:'20px 0'}]">
            <ddv-importer-correct-column :columnModel="columnModel"></ddv-importer-correct-column>
        </div>
        <div :style="[previewStyle,{margin:'20px 0'}]">
            <ddv-importer-preview></ddv-importer-preview>
        </div>

        <el-button style="margin-top: 12px;" @click="previous">上一步</el-button>
        <el-button style="margin-top: 12px;" @click="next">下一步</el-button>


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
            correctorStyle: function () {
                if (this.active === 1) {
                    return {display: 'block'};
                } else {
                    return {display: 'none'};
                }
            },
            previewStyle: function () {
                if (this.active === 2) {
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
                if (this.active++ > 2) this.active = 2;
            },
            previous() {
                if (this.active-- < 0) this.active = 0;
            }
        }
    }
</script>
