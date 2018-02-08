<template>
    <el-container :style="layoutMainStyle">
        <el-header>
            header
        </el-header>
        <el-container>
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
        data() {
            return {
                layoutMainStyle: {
                    height: 'auto',
                },
            };
        },
        mounted() {
            this.autoSetLayoutMainHeight();
        },
        updated() {
            this.autoSetLayoutMainHeight();
        },
        methods: {
            autoSetLayoutMainHeight() {
                const layoutMainEl = document.getElementById('app');

                // 初始化 mainHeight，避免出现 mainHeight 附上 clientHeight 的值就一直保持不变
                layoutMainEl.style.height = 'auto';

                // 计算 mainHeight 新高度
                const clientHeight = document.body.clientHeight;
                console.log(clientHeight);
                const layoutMainHeight = layoutMainEl.offsetHeight;

                if (layoutMainHeight < clientHeight) {
                    layoutMainEl.style.height = `${clientHeight}px`;
                }
            },
            handleSelect(key, keyPath) {
                console.log(this);
                this.$http.get(keyPath[1]).then(function (response) {

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