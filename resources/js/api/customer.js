import http from "@/function/http";

class customer {

    // PAGES
    getCustomers(data = {}){
        return http.post('/customer/all', data);
    }

    getCustomer(data = {}){
        return http.post('/customer/{data.id}', data);
    }

}

export default new customer();
