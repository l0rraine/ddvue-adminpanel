<template>

    <el-progress type="circle" :percentage="percentage"></el-progress>

</template>
<script>

    export default {
        name: 'DdvImporterProgress',
        data() {
            return {
                percentage: 0
            }
        },
        props: {
            isStart: {
                type: Boolean
            }
        },
        created() {
            this.do();
        },
        methods: {
            async do() {
                const that = this;
                that.loop = true;
                do {
                    that.$http.get(`${window.config.dashboard_url_prefix}/excel/progress`).then(function (response) {
                        console.log(response);
                    })
                    await that.sleep(1000);
                } while (that.loop);
            },
            sleep(d) {
                // return new Promise((resolve) => setTimeout(resolve, d))
                return new Promise((resolve, reject) => { setTimeout(() => { resolve(' enough sleep~'); }, d); })
            },
        }
    }
</script>
