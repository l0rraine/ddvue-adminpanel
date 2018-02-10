<template>
    <el-container style="height:100%">
        <el-header>
            <ddv-header>
                <span slot="title">{{ title }}</span>
                <span slot="username">{{ auth.name }}</span></ddv-header>
        </el-header>
        <el-container style="padding:0 20px;">
            <el-container>
                <ddv-sidebar width="220px" :onSelect="handleSelect"></ddv-sidebar>
                <el-container>
                    <el-main></el-main>
                    <el-footer></el-footer>
                </el-container>
            </el-container>
        </el-container>
    </el-container>
</template>

<script>
    export default {
        name: 'DdvApp',
        computed: {
            title: () => window.config.dashboard_name,
            auth: () => window.config.auth
        },
        methods: {
            handleSelect(key, keyPath) {
                this.$http.get(keyPath[1]).then(function (response) {
                    const v = response.data;
                    new Vue({
                        el: this.target,
                        render: function (h) {
                            return h('div', {
                                attrs: {
                                    id: this.target
                                },
                                domProps: {
                                    innerHTML: v.content
                                },
                            })
                        }
                    })
                });

            },
        },
    }
</script>