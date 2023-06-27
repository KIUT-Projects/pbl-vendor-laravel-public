import httpReq from "@/function/http";

class product {

    // PAGES
    getProducts(data = {}){
        console.log(httpReq + "- htttpreq")
        console.log(JSON.stringify(data))
        return httpReq.get('/product', data);
    }

    searchProducts(data = {}){
        return httpReq.post('/product/search', data);
    }

    getProduct(data = {}){
        return httpReq.post('/product/{data.id}', data);
    }

    getProductsByCategoryid(){
        return httpReq.get('/category/1?1')
    }

}

export default new product();
