<template>
    <el-dialog title="导入数据"
               :visible.sync="show"
               :close-on-click-modal="false"
               :close-on-press-escape="false"
               @close="handleClose"
               width="50%">
        <!--<el-steps :active="active" finish-status="success">-->
        <!--<el-step title="上传"></el-step>-->
        <!--<el-step title="预览"></el-step>-->
        <!--</el-steps>-->
        <div :style="[uploadStyle,{margin:'20px 0'}]">
            <el-upload style="width:100%;"
                       class="upload"
                       drag
                       :headers="{'X-CSRF-TOKEN': csrfToken}"
                       accept=".xls,.xlsx"
                       :data="extraData"
                       :on-error="handleError"
                       :on-progress="handleProgress"
                       :on-change="handleChange"
                       :http-request="handleUpload"
                       :show-file-list="true"
                       :action='postUrl'>
                <i class="el-icon-upload"></i>
                <div class="el-upload__text">将文件拖到此处，或<em>点击上传</em>
                    <div class="el-upload__tip" slot="tip">只能上传Excel文件，且不超过10MB</div>
                </div>
            </el-upload>
        </div>
        <div :style="[previewStyle,{margin:'20px 0'}]">
            <ddv-importer-preview></ddv-importer-preview>
        </div>
        <div style="margin: 0 auto;text-align: center;margin-top: 12px;">
            <!--<el-button @click="previous" v-show="active === 1">上一步</el-button>-->
            <!--<el-button @click="next" v-show="active=== 0">下一步</el-button>-->
            <el-button type="primary" @click="finish" v-show="active === 1">完成</el-button>
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
                excelData: [],
                csrfToken: $('meta[name="csrf-token"]').attr('content'),
                fileUploadFormData: new FormData(),
            }
        },
        computed: {
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
            columnModel: {
                type: Array
            },
            postUrl: {
                type: String
            },
            extraData: {
                type: Object
            }


        },
        created() {
            console.log(this.postUrl)
        },
        methods: {
            handleSuccess: function () {

            },
            handleError(err, file, fileList) {
                console.log(err);

            },
            handleProgress(event, file, fileList) {
            },
            async handleChange(file, fileList) {
                this.fileUploadFormData.append('file', file.raw);
                const that = this;
                that.loop = true;
                do {
                    that.$http.get(`${window.config.dashboard_url_prefix}/excel/progress`).then(function (response) {
                        console.log(response);

                    })
                    await that.sleep(1000);
                } while (that.loop);
            },
            handleUpload() {
                const that = this;

                that.$http.post(that.postUrl, that.fileUploadFormData)
                    .then(function (response) {

                    })
                    .catch(function (e) {
                        that.$message(e.response.data.message);
                    });


            },
            sleep(d) {
                return new Promise((resolve) => setTimeout(resolve, d))
            },
            handleClose() {
                this.loop = false;
            },
            next() {
                if (this.active++ > 1) this.active = 1;
            },
            previous() {
                if (this.active-- < 0) this.active = 0;
            },
            finish() {

            }
        }
    }
</script>
