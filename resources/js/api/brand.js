import http from "@/function/http";

class brand {

    // PAGES
    getBrands(data = {}){
        return http.post('/brand/all', data);
    }

    getBrand(data = {}){
        return http.post('/brand/id/{data.id}', data);
    }

}

export default new brand();
