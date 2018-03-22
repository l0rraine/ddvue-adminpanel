<template>
    <el-upload style="width:100%;"
            class="upload"
            drag
            action="https://jsonplaceholder.typicode.com/posts/"
            multiple>
        <i class="el-icon-upload"></i>
        <div class="el-upload__text">将文件拖到此处，或<em>点击上传</em>
            <div class="el-upload__tip" slot="tip">只能上传Excel文件，且不超过10MB</div>
        </div>
    </el-upload>

</template>
<script>
    export default {
        name: 'DdvImporterUpload',
        data() {
            return {
                show: true,
                active: 0
            }
        },
        computed: {
            postUrl: function () {
                return '';
            },


        },

        methods: {
            handleSuccess: function () {
                this.$emit('handleSuccess');
            },
            beforeUpload: function () {
                this.$emit('beforeUpload');
            }
        }
    }
</script>
<style>
    input[type=file] {
        display: none !important;
    }

    .upload {
        margin: 0 auto;
    }

    .el-upload {
        width: 100%;
    }

    .el-upload-dragger {
        margin: 0 auto;
        border: 0px;
    }
</style>