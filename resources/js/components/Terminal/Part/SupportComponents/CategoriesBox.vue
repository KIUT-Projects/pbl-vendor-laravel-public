<template>
    <div class="container">
        <div class="head"><img :src="category.image" alt=""></div>
        <div class="body"><p>{{ category.name}}</p></div>
    </div>
</template>


    <script>
export default {
    props:{
        category: Object,
        name: String,
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