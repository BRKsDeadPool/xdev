<script>
    export default{
        data(){
            return{
                msg:'hello vue'
            }
        },
        components:{
        
        },
        methods: {
        
        },
        mounted() {
            console.log(this.$route);
        }
    }
</script>

<style lang="sass">

</style>


<template>
    <div>
        <div>this is the message {{ msg }}</div>
    </div>
</template>