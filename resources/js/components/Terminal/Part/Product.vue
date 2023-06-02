<script>
export default {

    props:{
        AddChoseProductlist: Function,
        name: String,
        key1: Number,
        image: String,
        price: Float32Array,
        quantity: Number,
        barcode: Number,
        number_format: Function,
    }
}
</script>

<template>
    <div role="button" @click="AddChoseProductlist(key1)"
        class="select-none cursor-pointer transition-shadow overflow-hidden rounded-2xl bg-white shadow hover:shadow-lg"
        :title="name" :key="key1">
        <p class="mt-2 ml-2">{{ quantity }} ta - <code>({{ barcode }})</code></p>
        <img :src="image ?? '/theme/terminal/beef-burger.png'" :alt="name">
        <div class="flex pb-3 px-3 text-sm -mt-3" style="flex-direction: column;">
            <p class="flex-grow truncate mr-1">{{ name }}</p>
            <p class="nowrap font-semibold">{{ number_format(price) }} UZS</p>
        </div>
    </div>
</template>



<style scoped></style>
