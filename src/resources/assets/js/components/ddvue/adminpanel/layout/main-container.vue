<template>
    <div></div>
</template>
<script>
    export default {
        name: 'DdvMainContainer',
        props: {
            comp: String,
        },
        render(h){
            const that = this;
            const MyComponent = Vue.extend({
                template: that.comp
            });
            let children = [];
            children.push(h(MyComponent, {})) //组件1

            var func = function () {
                return {
                    template: that.comp
                }
            }
            return h('div',  children);
            //return h(func());//Vue.compile(this.comp).render(h);
        }
    }
</script>
