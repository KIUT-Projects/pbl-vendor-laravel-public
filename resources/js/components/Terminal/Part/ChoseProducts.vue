<script>
export default {
  props:{
        name: String,
        id: Number,
        image: String,
        price: Float32Array,
        quantity: Number,
        barcode: Number,
        number_format: Function,
        numberofProduct: Number,
        ReduceNumberOfProduct: Function,
        ImprovNumberOfProduct: Function,
        CalculateProducts: Function,
        NumberOfProductsWriter: Function,
  },
  data() {
    return {
        numberofProduct1: 0,
    }
  },
  methods: {
    NumberOfProductsWrierinMainArry(){
       this.NumberOfProductsWriter(this.id,this.numberofProduct1);
        this.CalculateProducts();
    }
  },
  mounted() {
    this.numberofProduct1 = this.numberofProduct;
  },
  updated(){
    this.numberofProduct1 = this.numberofProduct;
  }
}
</script>

<template>
    <div :key="id" class="select-none mb-3 bg-blue-gray-50 rounded-lg w-full text-blue-gray-700 py-2 px-2 flex justify-center">
        <img :src="image" alt="" class="rounded-lg h-10 w-10 bg-white shadow mr-2">
        <div class="flex-grow">
            <h5 class="text-sm" >{{ name }}</h5>
            <p class="text-xs block">{{ number_format(price) }}</p>
        </div>
        <div class="py-2">
            <div class="w-28 grid grid-cols-3 gap-1 ml-2">
                <button @click="this.ReduceNumberOfProduct(id)"
                    class="rounded-lg text-center py-1 text-white bg-blue-gray-600 hover:bg-blue-gray-700 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-3 inline-block" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                    </svg>
                </button>
                <input @input="this.NumberOfProductsWrierinMainArry" v-model="numberofProduct1" type="text"
                    class="bg-white rounded-lg text-center shadow focus:outline-none focus:shadow-lg text-sm"
                    style="padding:0;">
                <button @click="this.ImprovNumberOfProduct(id, quantity)"
                    class="rounded-lg text-center py-1 text-white bg-blue-gray-600 hover:bg-blue-gray-700 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-3 inline-block" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                        </path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</template>




<style></style>