<script >
import ChoseProducts from './ChoseProducts.vue';

export default {
  props: {
    choseProducts: {
      typeof: Array,
    }
    ,
    Clear: {
      typeof: Function,
    },
    numberofproduct1: {
      typeof: Number,
    },
    ReduceNumberOfProduct: {
      typeof: Function,
    },
    ImprovNumberOfProduct: {
      typeof: Function,
    },
    CalculateProducts: {
      typeof: Function,
    },
    AllPrice: {
      typeof: Function,
    },
    TurnOnBill: {
      typeof: Function,
    },
    whichOneKindOfPeymentname: {
      typeof: String,
    },
    number_format: {
      typeof: Function,
    },

  },
  components: { ChoseProducts },
  methods: {
    NumberOfProductsWriter(index,number){
      this.choseProducts.forEach(element => {
        if(element.id == index){ 
        element.numberofProduct = Number(number);
        console.log(element.numberofProduct);
        }
      });
      console.log(this.choseProducts);
  
    },
    WhichOneThePayment(text) {
      this.$emit('whichone', text);
    },
    Payment() {
      this.TurnOnBill();
    },
  },
  data() {
    return {
      numberOfProducts: 0,
      whichOneKindOfPeyment: "",
      Greenbtn: true,
    }
  },
  updated() {
    this.CalculateProducts();
  },
}

</script>

<template>
  <div class="w-5/12 flex flex-col bg-blue-gray-50 h-full bg-white pr-4 pl-2 py-4">
    <div class="bg-white rounded-3xl flex flex-col h-full shadow">
      <!-- empty cart  -->
      <div style="display: none;" x-show="cart.length === 0"
        class="flex-1 w-full p-4 opacity-25 select-none flex flex-col flex-wrap content-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 inline-block" fill="none" viewBox="0 0 24 24"
          stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
          </path>
        </svg>
        <p>
          CART EMPTY
        </p>
      </div>
      <!-- cart items -->

      <div x-show="cart.length > 0" class="flex-1 flex flex-col overflow-auto">
        <div class="h-16 text-center flex justify-center">
          <div class="pl-8 text-left text-lg py-4 relative">
            <!-- cart icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 inline-block" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
              </path>
            </svg>
            <div x-show="getItemsCount() > 0"
              class="text-center absolute bg-cyan-500 text-white w-5 h-5 text-xs p-0 leading-5 rounded-full -right-2 top-3"
              x-text="getItemsCount()">{{ numberofproduct1 == 0 ? 0 : numberofproduct1 }}</div>
          </div>
          <div class="flex-grow px-8 text-right text-lg py-4 relative">
            <!-- trash button -->
            <button @click="Clear()" class="text-blue-gray-300 hover:text-pink-500 focus:outline-none">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                </path>
              </svg>
            </button>
          </div>
        </div>

        <div class="flex-1 w-full px-4 overflow-auto">
          <template x-for="item in cart">
            <div
              class="select-none mb-3 bg-blue-gray-50 rounded-lg w-full text-blue-gray-700 py-2 px-2 flex justify-center">
              <img alt="" class="rounded-lg h-10 w-10 bg-white shadow mr-2">
              <div class="flex-grow">
                <h5 class="text-sm"></h5>
                <p class="text-xs block"></p>
              </div>
              <div class="py-1">
                <div class="w-28 grid grid-cols-3 gap-2 ml-2">
                  <button
                    class="rounded-lg text-center py-1 text-white bg-blue-gray-600 hover:bg-blue-gray-700 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-3 inline-block" fill="none" viewBox="0 0 24 24"
                      stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                    </svg>
                  </button>
                  <input type="text"
                    class="bg-white rounded-lg text-center shadow focus:outline-none focus:shadow-lg text-sm"
                    style="padding:0;">
                  <button
                    class="rounded-lg text-center py-1 text-white bg-blue-gray-600 hover:bg-blue-gray-700 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-3 inline-block" fill="none" viewBox="0 0 24 24"
                      stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                  </button>
                </div>
              </div>
            </div>
          </template>

          <ChoseProducts v-for="(item, index) in choseProducts" :NumberOfProductsWriter="NumberOfProductsWriter" :CalculateProducts="CalculateProducts" :numberofProduct="item.numberofProduct" :number_format="number_format" :id="item.id" :name="item.name" :quantity="item.current_stock" :price="item.price" :AddChoseProductlist="AddChoseProductlist" :image="item.image" :barcode="item.barcode" :ReduceNumberOfProduct="ReduceNumberOfProduct" :ImprovNumberOfProduct="ImprovNumberOfProduct"/>

          <!-- <div v-for="(item, index) in choseProducts"
            class="select-none mb-3 bg-blue-gray-50 rounded-lg w-full text-blue-gray-700 py-2 px-2 flex justify-center">
            <img :src="item.image" alt="" class="rounded-lg h-10 w-10 bg-white shadow mr-2">
            <div class="flex-grow">
              <h5 class="text-sm" x-text="item.name">{{ item.name }}</h5>
              <p class="text-xs block" x-text="priceFormat(item.price)">{{ number_format(item.price) }}</p>
            </div>
            <div class="py-2">
              <div class="w-28 grid grid-cols-3 gap-1 ml-2">
                <button @click="this.ReduceNumberOfProduct(index)"
                  class="rounded-lg text-center py-1 text-white bg-blue-gray-600 hover:bg-blue-gray-700 focus:outline-none">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-3 inline-block" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                  </svg>
                </button>
                <input @input="this.CalculateProducts" v-model="item.numberofProduct" type="text"
                  class="bg-white rounded-lg text-center shadow focus:outline-none focus:shadow-lg text-sm"
                  style="padding:0;">
                <button @click="this.ImprovNumberOfProduct(index, item.current_stock)"
                  class="rounded-lg text-center py-1 text-white bg-blue-gray-600 hover:bg-blue-gray-700 focus:outline-none">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-3 inline-block" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                    </path>
                  </svg>
                </button>
              </div>
            </div>
          </div> -->

        </div>
      </div>
      <!-- end of cart items  -->

      <!-- payment info -->
      <div class="select-none h-auto w-full text-center pt-3 pb-4 px-4">
        <div class="flex mb-3 text-lg font-semibold text-blue-gray-700">
          <div>Umumiy</div>
          <div class="text-right w-full">{{ number_format(this.AllPrice) }} UZS</div>
        </div>
        <div class="mb-3 text-blue-gray-700 px-3 pt-2 pb-3 rounded-lg bg-blue-gray-50">
          <div class="flex text-lg font-semibold">
            <div class="flex-grow text-left">To'lov turi</div>
            <div class="flex text-right">
              <div class="mr-2">{{ whichOneKindOfPeymentname }}</div>
            </div>
          </div>
          <hr class="my-2">
          <div class="grid grid-cols-3 gap-2 mt-2">
            <template></template>

            <button @click="WhichOneThePayment('click')"
              class="bg-white rounded-lg shadow hover:shadow-lg focus:outline-none inline-block px-2 py-1 text-sm">+<span>Click</span></button>

            <button @click="WhichOneThePayment('payme')"
              class="bg-white rounded-lg shadow hover:shadow-lg focus:outline-none inline-block px-2 py-1 text-sm">+<span>Payme</span></button>

            <button @click="WhichOneThePayment('uzum')"
              class="bg-white rounded-lg shadow hover:shadow-lg focus:outline-none inline-block px-2 py-1 text-sm">+<span>Uzum</span></button>

            <button @click="WhichOneThePayment('paynet')"
              class="bg-white rounded-lg shadow hover:shadow-lg focus:outline-none inline-block px-2 py-1 text-sm">+<span>Paynet</span></button>

            <button @click="WhichOneThePayment('Oson')"
              class="bg-white rounded-lg shadow hover:shadow-lg focus:outline-none inline-block px-2 py-1 text-sm">+<span>Oson</span></button>

            <button @click="WhichOneThePayment('naqt pul')"
            class="bg-white rounded-lg shadow hover:shadow-lg focus:outline-none inline-block px-2 py-1 text-sm">+<span>Naqt
              pul</span></button>
        </div>
      </div>
      <div class="flex mb-3 text-lg font-semibold bg-cyan-50 text-blue-gray-700 rounded-lg py-2 px-3"
        style="display: none;">
        <div class="text-cyan-800">O'zgartirish</div>
        <div class="text-right flex-grow text-cyan-600" x-text="priceFormat(change)">Rp. 0</div>
      </div>
      <div class="flex mb-3 text-lg font-semibold bg-pink-100 text-blue-gray-700 rounded-lg py-2 px-3"
        style="display: none;">
        <div class="text-right flex-grow text-pink-600" x-text="priceFormat(change)">Rp. 0</div>
      </div>
      <div class="flex justify-center mb-3 text-lg font-semibold bg-cyan-50 text-cyan-700 rounded-lg py-2 px-3"
        style="display: none;">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block" fill="none" viewBox="0 0 24 24"
          stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5">
          </path>
        </svg>
      </div>
      <button @click="Payment" :class="{butonGreen: choseProducts.length !=0}"
        class="text-white rounded-2xl text-lg w-full py-3 focus:outline-none bg-blue-gray-200"
        :disabled="choseProducts.length==0">
        To`lov
      </button>
    </div>
    <!-- end of payment info -->
  </div>

</div></template>

<style scoped>.butonGreen {
  background: #22ff00;
}</style>
