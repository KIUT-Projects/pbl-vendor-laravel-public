<script >
import CategoriesBox from './SupportComponents/CategoriesBox.vue';

export default{
    props: {
        categories: Array,
    },
    components: { CategoriesBox },

}

</script>

<template>
    <div class="flex flex-row w-auto flex-shrink-0 pl-4 pr-2 py-4" style="width: 9%;">
        <div class="flex flex-col items-center py-4 flex-shrink-0 w-20 bg-cyan-500 rounded-3xl" style="background: linear-gradient(72.47deg, #7367f0 22.16%, rgba(115, 103, 240, 0.7) 76.47%); width: 98%;">
            <a class="flex items-center justify-center h-12 w-12 bg-cyan-50 text-cyan-700 rounded-full" href="/admin">
                <img :src="'/assets/faicon/apple-touch-icon.png'" style="border-radius: 10px;">
            </a>

            <ul class="flex flex-col space-y-2 mt-12 ul-list">
                <li v-for="(item, index) in this.categories" :key="index" style="display: block;"><CategoriesBox :category="item"/></li>
                <!-- <li>
                    <a class="flex items-center" href="#">
                      <span class="flex items-center justify-center h-12 w-12 rounded-2xl bg-cyan-300 shadow-lg text-white" style="background-color: #fff;
    color: #7367f0;">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                          <path
                              d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"
                              stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="2"></path>
                        </svg>
                      </span>
                    </a>
                </li>

                <li>
                    <a class="flex items-center" href="#">
              <span class="flex items-center justify-center text-cyan-100 hover:bg-cyan-400 h-12 w-12 rounded-2xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                  <path
                      d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"
                      stroke-linecap="round" stroke-linejoin="round"
                      stroke-width="2"></path>
                  <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2"></path>
                </svg>
              </span>
                    </a>
                </li> -->
            </ul>
<!--            <a class="mt-auto flex items-center justify-center text-cyan-200 hover:text-cyan-100 h-10 w-10 focus:outline-none"
               href="https://github.com/emsifa/tailwind-pos"
               target="_blank">
                <svg class="h-8 w-8" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path clip-rule="evenodd"
                          d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                          fill-rule="evenodd"></path>
                </svg>
            </a>-->
        </div>
        

    </div>

</template>

<style scoped>
.ul-list{
    overflow: auto; 
    width: 100%;

}

li{
    width: 90%;
    margin: auto;
}

</style>
