import http from "@/function/http";

class product {

    // PAGES
    getProducts(data = {}){
        if(data.query){
            return http.post('/product/search', data);
        }
        return http.post('api/product/all', data);
    }

    searchProducts(data = {}){
        return http.post('/product/search', data);
    }

    getProduct(data = {}){
        return http.post('/product/{data.id}', data);
    }

}

export default new product();
