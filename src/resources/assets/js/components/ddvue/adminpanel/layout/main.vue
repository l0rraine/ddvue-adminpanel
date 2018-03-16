<template>
    <el-container direction="vertical">
        <ddv-breadcrumbs @onItemClick="handleBreadcrumbsClick" :config="breadcrumbData"></ddv-breadcrumbs>
        <slot name="content"></slot>
    </el-container>
</template>
<script>
    export default {
        name: 'DdvMain',
        props: {
            breadcrumbData: Object,
        },
        methods: {
            handleBreadcrumbsClick(url) {
                const that = this;
                that.$el.innerHTML = '';
                that.insertEl(that,url);
            }
        }
    }
</script>
