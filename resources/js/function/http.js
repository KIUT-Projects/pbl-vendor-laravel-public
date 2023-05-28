import axios from "axios";

export default axios.create({
    //baseURL: process.env.MIX_BASE_API_URL,
    baseURL: '/api/v1',
    headers: {
        Accept: 'application/json',
        Authorization: `Bearer ${import.meta.env.VITE_API_TOKEN}`,
    }
});

export function request(method, url, data = {}) {
    return fetch(url, {
        method,
        headers: {
            Accept: 'application/json',
            //Authorization: `Bearer 2|K8xuWt5UtljFodkDNi93Gpk85mREWU43pTepatit`,
            //'Content-Type': 'application/json',
            // + process.env.MIX_API_TOKEN,
            //'X-CSRF-TOKEN': document.head.querySelector('meta[name=csrf-token]').content
        },
        ...(method === 'get' ? {}: {body: JSON.stringify(data)})
    }).then(async (response) => {

        if (response.status >=200 && response.status <300) {
            return response.json()
        }
        throw await response.json();
    })
}

export function get(url, data = {}) {
    console.log(import.meta.env.VITE_APP_AVITE_API_TOKENPI_KEY);
    return request('get', url, data)
}

export function post(url, data = {}) {
    return request('post', url, data)
}
