import http from "@/function/http";

class product {

    // PAGES
    getProducts(data = {}){
        console.log('eeeee ishlaaaa')
        console.log(data)
        console.log('data keldimi')
        return http.get('/product', data);
    }

    searchProducts(data = {}){
        return http.post('/product/search', data);
    }

    getProduct(data = {}){
        return http.post('/product/{data.id}', data);
    }

}

export default new product();
