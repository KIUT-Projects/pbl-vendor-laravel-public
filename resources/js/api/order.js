import http from "@/function/http";

class order {

    // PAGES
    storeOrder(data = {}){
        return http.post('/order', data);
    }

}

export default new order();
