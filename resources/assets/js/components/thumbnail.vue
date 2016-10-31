<script>
    module.exports = {
        props: [
            'src',
            'width',
            'height',
            'alt',
            'mclass'
        ]
    }
</script>

<style lang="sass" scoped>
    .post-thumb {
        position: relative;
        overflow: hidden;
    }
        .post-thumb img {
            position: absolute;
            left: 50%;
            top: 50%;
            height: 100%;
            width: auto;
            -webkit-transform: translate(-50%,-50%);
            -ms-transform: translate(-50%,-50%);
            transform: translate(-50%,-50%);
    }
</style>


<template>
    <div>
    <div v-bind:class="'post-thumb '+mclass" :style="'width:'+width+'; height:'+height">
        <img :src="src" :alt="alt">
    </div>
    </div>
</template>