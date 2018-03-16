<template>
    <div>
        <span class="left pull-left">{{ leftData }}</span>
        <span class="right pull-right">{{ rightData }}</span>
    </div>
</template>
<script>
    export default {
        name:'DdvPartialsDropDownTwoColumns',
        props:{
            leftData:String,
            rightData:String
        }
    }
</script>