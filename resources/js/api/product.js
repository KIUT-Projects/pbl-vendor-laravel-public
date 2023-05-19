import http from "@/function/http";

class product {

    // PAGES
    getProducts(data = {}){
        if(data.query){
            return http.post('/products/search', data);
        }
        return http.post('/products', data);
    }

    searchProducts(data = {}){
        return http.post('/products/search', data);
    }

    getProduct(data = {}){
        return http.post('/product/{data.id}', data);
    }

}

export default new product();
