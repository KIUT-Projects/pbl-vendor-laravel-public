import http from "@/function/http";

class product {

    // PAGES
    getProducts(data = {}){
        return http.post('/product/all', data);
    }

    searchProducts(data = {}){
        return http.post('/product/search', data);
    }

    getProduct(data = {}){
        return http.post('/product/{data.id}', data);
    }

}

export default new product();
