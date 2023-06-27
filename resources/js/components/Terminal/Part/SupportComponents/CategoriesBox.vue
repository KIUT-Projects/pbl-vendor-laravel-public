<template>
    <div class="container" @click="HoldonBox">
        <div class="head"><img :src="category.image" alt=""></div>
        <div class="body"><p>{{ category.name}}</p></div>
    </div>
</template>


    <script>
export default {
    props:{
        category: Object,
        name: String,
    },
    methods:{
        HoldonBox(){
            this.$store.commit('apiGetProductsByCategoryId');
        }
    }
}
</script>



<style>
.container{
    width: 100%;
    height: 100%;
    background: #ffffffdd;
    display: flex;
    flex-direction: column;
}

p{
    font-size: 10px;
    text-align: center;
}


    
</style>