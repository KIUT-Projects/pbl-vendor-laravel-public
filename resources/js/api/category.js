import http from "@/function/http";

class category {

    // PAGES
    getCategories(data = {}){
        return http.get('/category', data);
    }

    getCategory(data = {}){
        return http.post('/category/{data.id}', data);
    }

}

export default new category();
