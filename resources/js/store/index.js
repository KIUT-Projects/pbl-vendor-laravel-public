import { createStore } from 'vuex'
import product from '../api/product'

const store = createStore({
    state() {
        return {
            products: [],
            search: "",
        }
    },
    mutations: {
        apiGetProducts(state) {
            console.log("stor is worked");
            product.getProducts({'search': this.search}).then((response) => {
                console.log(response.data)
                console.log(response)

                if (response.data.success) {
                   state.products = response.data.data.data
                } else {
                    console.log(response.data)
                }
            }).catch((Error)=>{
                console.log(Error);
            })
        },
        apiGetProductsByCategoryId(state,id_category){
            product.getProductsByCategoryid().then((response) => {
                console.log(response);
            }).catch((Error) => console.log(Error));

            
        }
    },
    actions:{
      
    }
})

export default store