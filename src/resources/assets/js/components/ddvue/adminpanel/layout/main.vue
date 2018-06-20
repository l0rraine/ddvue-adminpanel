<template>
    <el-container direction="vertical">
        <ddv-breadcrumbs v-if="showBreadcrumb" @onItemClick="handleBreadcrumbsClick" :config="breadcrumbData"></ddv-breadcrumbs>
        <slot name="content"></slot>
    </el-container>
</template>
<script>
    export default {
        name: 'DdvMain',
        props: {
            breadcrumbData: {
                type: Object
            },
            showBreadcrumb: {
                type: Boolean,
                default: true
            }
        },
        methods: {
            handleBreadcrumbsClick(url) {
                const that = this;
                that.$el.innerHTML = '';
                that.insertEl(that, url);
            }
        }
    }
</script>
