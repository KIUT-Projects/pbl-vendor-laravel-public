<script>
import Product from "@/components/Terminal/Part/Product.vue";
import LeftSidebar from "@/components/Terminal/Part/LeftSidebar.vue";
import RightSidebar from "@/components/Terminal/Part/RightSidebar.vue";
import product from "@/api/product";
import order from "@/api/order";
import html2canvas from 'html2canvas';
import moment from 'moment';
import jsPDF from 'jspdf'
import categoryApi from '../../api/category';

export default {
    name: "Terminal",
    components: { RightSidebar, LeftSidebar, Product },
    data() {
        return {
            cart: [],
            cartDetails: {
                productsPrice: 0,
                commissionPrice: 0,
                totalPrice: 0,
            },
            customerDetails: {
                name: "",
                phone: "+998",
                comment: ""
            },
            company: {
                phone: '',
                email: '',
            },
            page: {
                header: {
                    links: [
                        { name: "Asosiy" },
                        { name: "Filiallar" },
                        { name: "Vakantlar" },
                        { name: "Yangiliklar" },
                        { name: "Biz haqimizda" },
                        { name: "Kontaktlar" },
                    ]
                }
            },
            choseProducts: [],
            // products: [],
            product_list_for_api: [],
            numberOfProducts: 0,
            AllPrice: 0,
            whichOneKindOfPeymentname: "Naqt pul",
            senttoapi: [],
            billNumber: 100052,
            bill_date: Date.now(),
            select_customer: '',
            search: "",
            categories: [],
        }
    },
    computed: {
        formattedDateTime() {
            //return moment(this.bill_date).format('dd.mm.YYYY, h:mm:ss a');
            return moment().format('LLL');
        },
        products(){
            return this.$store.state.products
        }
    },
    updated() {
    },
    created() {
    },
    mounted() {
        // this.apiGetProducts();
        this.CalculateAllSum();
        this.apiGetCategory();
        this.$store.commit('apiGetProducts')
    },

    methods: {
        whichone(name) {
            this.whichOneKindOfPeymentname = name;
        },
        Clear() {
            this.choseProducts = [];
        },
        TurnOnBill() {
            let bill = document.querySelector('#bill');
            bill.style.zIndex = "30";
        },
        TurnOffBill() {
            let bill = document.querySelector('#bill');
            bill.style.zIndex = "1";
            console.log(this.select_customer);
            this.generatePDF();
            this.ProductsWhichSentToApi();
            this.apiPutProducts()
            this.Clear();
            // this.apiGetProducts();
        },
        Backpay(){
            let bill = document.querySelector('#bill');
            bill.style.zIndex = "1";
        },
        generatePDF() {
            const element = this.$refs.pdfContent;

            // Convert HTML element to canvas
            html2canvas(element).then(canvas => {
                const pdf = new jsPDF();

                // Calculate the ratio of the PDF page to the canvas image
                const pdfWidth = pdf.internal.pageSize.getWidth();
                const pdfHeight = pdf.internal.pageSize.getHeight();
                const ratio = pdfWidth / canvas.width;

                // Add canvas image to PDF
                const imgData = canvas.toDataURL('/public/images/logo/logo');
                pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, canvas.height * ratio);

                // Save the PDF
                pdf.save('example.pdf');
            });
        },

        AddChoseProductlist(id) {
            let yesOrNo = false;
            let counter = 0;
            let i = 0;
            let product;
            this.CalculateProducts();
            this.choseProducts.forEach(element => {
                if (element.id == this.$store.state.products[id].id) {
                    yesOrNo = true;
                    counter = i;
                }
                i++;
            });

            if (yesOrNo == true) {
                this.choseProducts[counter].numberofProduct++;
            } else {
                product = this.$store.state.products[id];
                product.numberofProduct = 1;
                this.choseProducts.push(product);
            }
            this.ProductsWhichSentToApi();
            console.log(product);
        },
        ProductsWhichSentToApi() {
            this.senttoapi = [];
            this.choseProducts.forEach(element => {
                let updateProduct = {
                    id: element.id,
                    quantity: element.numberofProduct,
                }
                this.senttoapi.push(updateProduct);
            });

        },
        ReduceNumberOfProduct(id) {
            this.choseProducts.forEach(element => {
                if(element.id == id)
                element.numberofProduct <= 0 ? '' : element.numberofProduct -= 1;
            });

        },
        ImprovNumberOfProduct(id, max) {
            this.choseProducts.forEach(element => {
                if(element.id == id){ 
                element.numberofProduct < max + 1 ? element.numberofProduct += 1 : '';
                console.log(max);
                }
        });

        },
        CalculateProducts() {
            this.CalculateAllSum();
            this.numberOfProducts = 0;
            this.choseProducts.forEach(element => {
                this.numberOfProducts += element.numberofProduct;
            });
        },
        CalculateAllSum() {
            this.AllPrice = 0;
            this.choseProducts.forEach(element => {
                this.AllPrice += Number(element.price) * element.numberofProduct;
            });
        },
        /*serach() {
            if (this.serach == "") {
                console.log(0);
                this.products = this.product_list_for_api
            }
            else {
                this.products = this.product_list_for_api
                this.products = this.products.filter(e => e.name.toLowerCase().search(this.search.toLowerCase()) != -1)
                console.log(this.search.cont);
            }
            console.log(123);
        },*/
        apiPutProducts() {
            let cart_data = {
                cart: this.senttoapi,
                totalPrice: this.AllPrice,
                payment: this.whichOneKindOfPeymentname
            }
            console.log(this.senttoapi);
            order.storeOrder(cart_data).then((response) => {
                if (response.data) {
                    console.log(response.data)
                    //this.products = response.data.data.data
                } else {
                    console.log(response.data)
                }
            });
            /*axios.post('/api/store/cart_to_order/', { cart: this.senttoapi, totalPrice: this.AllPrice, payment: this.whichOneKindOfPeymentname })
                .then(function (response) {
                    console.log(response);
                })
                .catch(function (error) {
                    console.log(error);
                });*/
        },
        apiGetProducts() {
            product.getProducts({'search': this.search}).then((response) => {
                console.log(response.data)
                console.log(response)

                if (response.data.success) {
                //    this.products = response.data.data.data
                } else {
                    console.log(response.data)
                }
            })
        },

        apiGetCategory(){
            categoryApi.getCategories().then((response)=>{
                console.log(response.data.data.data);
                this.categories = response.data.data.data;

            }).catch(Error => {
                console.log("erro api category");
            })
        },

        addToCart(id) {
            console.log('product added (id: ' + id + ')')
            this.cart.push(
                this.getProductByID(id)
            )
            this.sumCart()

        },
        sumCart() {
            let productsPrice = 0;
            let commission = 15;
            this.cart.forEach(function (cartProduct, index) {
                productsPrice += parseInt(cartProduct.price)
            })

            let commissionPrice = (productsPrice / 100 * commission)
            this.cartDetails.productsPrice = productsPrice
            this.cartDetails.commissionPrice = commissionPrice
            this.cartDetails.totalPrice = productsPrice + commissionPrice

        },
        removeFromCart(id) {
            let removeCartIndex;
            this.cart.forEach(function (eid, index) {
                //console.log(eid)
                if (eid.id === id) {
                    console.log('remove: id ' + id)
                    removeCartIndex = index;
                }
            })
            this.cart.shift(removeCartIndex)
            this.sumCart()
        },
        clearFromCart() {
            this.cart = []
            this.sumCart()
        },
        getProductByID(id) {
            console.log('get product (id: ' + id + ')')
            return this.products.filter(d => d.id === id)[0];
        },
        orderNow() {
            let order = {
                cart: this.cart,
                customer: this.customerDetails,
                totalPrice: this.cartDetails.totalPrice
            }

            apiPos.sendOrder(order).then((response) => {
                if (response.data.status) {
                    console.log('order sent')
                    console.log(response.data)

                    this.cart = []

                    this.cartDetails = {
                        productsPrice: 0,
                        commissionPrice: 0,
                        totalPrice: 0,
                    }

                    this.customerDetails = {
                        name: "",
                        phone: "+998 ",
                        comment: ""
                    }

                    //$('#payment-popup').modal('hide')
                    document.getElementById('payment-popup').click();


                    //this.products = response.data.data
                } else {
                    console.log(response.data)
                }
            })

            console.log(order)
        },
        priceFormat(price, add = '') {
            return this.number_format(price, 0, '.', ' ') + '' + add;
        },
        number_format(number, decimals = 0, dec_point = '.', thousands_sep = ' ') {
            // Strip all characters but numerical ones.
            number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                s = '',
                toFixedFix = function (n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + Math.round(n * k) / k;
                };
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        }

    }
}
</script>

<template>
    <div class="contener_main">
        <div class="bill" id="bill" ref="pdfContent" @click="Backpay">
            <div class="bill_item">
                <div class="logo">
                    <img src="../../../../public/images/logo/logo.png" alt="">
                </div>
                <div class="bill_information">
                    <p>#{{ billNumber }}</p>
                    <!-- <select class="selectForcustomers" v-model="select_customer"><option value="customer">Customer</option> <option value="customer2">cusremer2</option></select> -->
                    <p>{{ formattedDateTime }}</p>
                </div>
                <div class="product_list">
                    <table>
                        <thead>
                            <tr>
                                <th>Nomi</th>
                                <th>Soni</th>
                                <th>Narxi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in choseProducts" :key="index">
                                <td>{{ item.name }}</td>
                                <td> {{ item.numberofProduct }}</td>
                                <td>{{ number_format(item.price) }}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <div class="payment_information">
                    <div>
                        Umumiy sum: {{ number_format(AllPrice) }}
                    </div>
                    <div>
                        Tolov turi: {{ whichOneKindOfPeymentname }}
                    </div>
                </div>
                <div class="button_for_pay">
                    <button @click="TurnOffBill" style="width: 100%;">To` lov</button>
                </div>
            </div>
        </div>
        <div class="products hide-print flex flex-row h-screen antialiased text-blue-gray-800">
            <!-- left sidebar -->
            <LeftSidebar :categories="categories"></LeftSidebar>
            <!-- page content -->
            <div class="flex-grow flex">
                <!-- store menu -->
                <div class="flex flex-col bg-blue-gray-50 h-full w-full py-4">
                    <div class="flex px-2 flex-row relative">
                        <div class="absolute right-5 top-3 px-2 py-2 rounded-full bg-cyan-500 text-white"
                            style="background-color: #7f75f0;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text"
                            class="bg-white rounded-3xl shadow text-lg full w-full h-16 py-4 pl-16 transition-shadow focus:shadow-2xl focus:outline-none"
                            placeholder="Qidiruv ..." @input="apiGetProducts" v-model="this.search">
                    </div>
                    <div class="h-full overflow-hidden mt-4">
                        <div class="h-full overflow-y-auto px-2">
                            <div class="select-none bg-blue-gray-100 rounded-3xl flex flex-wrap content-center justify-center h-full opacity-25"
                                x-show="products.length === 0" style="display: none;">
                                <div class="w-full text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 inline-block" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4">
                                        </path>
                                    </svg>
                                    <p class="text-xl">
                                        YOU DON'T HAVE
                                        <br>
                                        ANY PRODUCTS TO SHOW
                                    </p>
                                </div>
                            </div>
                            <div class="select-none bg-blue-gray-100 rounded-3xl flex flex-wrap content-center justify-center h-full opacity-25"
                                x-show="filteredProducts().length === 0 &amp;&amp; keyword.length &gt; 0"
                                style="display: none;">
                                <div class="w-full text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 inline-block" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                    <p class="text-xl">
                                        EMPTY SEARCH RESULT
                                    </p>
                                </div>
                            </div>
                            <div class="grid grid-cols-4 gap-4 pb-3">

                                <!-- <div role="button" @click="AddChoseProductlist(index)"
                                    class="select-none cursor-pointer transition-shadow overflow-hidden rounded-2xl bg-white shadow hover:shadow-lg"
                                    :title="product.name" v-if="products" v-for="(product, index) in products" :key="index"
                                    :product="product">
                                    <p class="mt-2 ml-2">{{ product.current_stock }} ta - <code>({{ product.barcode }})</code></p>
                                    <img :src="product.image ?? '/theme/terminal/beef-burger.png'"
                                        :alt="product.name">
                                    <div class="flex pb-3 px-3 text-sm -mt-3" style="flex-direction: column;">
                                        <p class="flex-grow truncate mr-1">{{ product.name }}</p>
                                        <p class="nowrap font-semibold">{{ number_format(product.price) }} UZS</p>
                                    </div>
                                </div> -->

                                <Product v-for="(item, index) in products" :number_format="number_format" :key1="index" :name="item.name" :quantity="item.current_stock" :price="item.price" :AddChoseProductlist="AddChoseProductlist" :image="item.image" :barcode="item.barcode"/>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- end of store menu -->

                <!-- right sidebar -->
                <RightSidebar :number_format="number_format" :whichOneKindOfPeymentname="whichOneKindOfPeymentname"
                    @whichone="whichone" :TurnOnBill="TurnOnBill" :AllPrice="AllPrice"
                    :CalculateProducts="CalculateProducts" :ImprovNumberOfProduct="ImprovNumberOfProduct"
                    :ReduceNumberOfProduct="ReduceNumberOfProduct" :numberofproduct1="numberOfProducts" :Clear="Clear"
                    :choseProducts="choseProducts"></RightSidebar>
                <!-- end of right sidebar -->
            </div>

        </div>

    </div>
</template>

<style scoped>
.contener_main {
    position: relative;

}

.bill {
    width: 100%;
    height: 100vh;
    position: absolute;
    background: #ffffff88;
    z-index: 1;
    display: flex;
    justify-content: center;
    align-items: center;
}

.bill_item {
    width: 30%;
    height: 80%;
    background: #fff;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    border-radius: 20px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    font-size: 1.2rem;
}

.bill_item .logo {
    max-width: 300px;
    width: 90%;
    margin: auto;
}

.bill_item .product_list {
    width: 90%;
    height: 50%;
    margin: auto;
    overflow: auto;
}

.bill_item .product_list table {
    width: 100%;
    height: 100%;
}

.bill_item .button_for_pay {
    width: 90%;
    height: 10%;
    margin: auto;
    margin-bottom: 10px;
    margin-top: 10px;

}

.bill_item .button_for_pay button {
    border-radius: 25px;
    background-color: #14e922;
    color: #fff;
    font-size: 2rem;
    font-weight: bold;
    padding: 0.6rem 1rem;
    margin: 2rem 0 0 0;
}

.bill_item .payment_information {
    width: 90%;
    height: 5%;
    margin: auto;

    display: flex;
    flex-direction: column;

    align-items: flex-end;
    font-size: 1.4rem;
    font-weight: 500;
    color: #250091;
}

.products {
    position: absolute;
    width: 100%;
    height: 100vh;
    z-index: 20;

}

.bill_information {
    width: 90%;
    height: 2%;
    margin: auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.selectForcustomers {
    width: 100px;
    height: 20px;
}
</style>
