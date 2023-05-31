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
        headers: { Accept: 'application/json' },
        body: JSON.stringify(data),
        data: data
    }).then(async (response) => {

        if (response.status >=200 && response.status <300) {
            return response.json()
        }
        throw await response.json();
    })
}

export function get(url, data) {
    return request('get', url, data)
}

export function post(url, data = {}) {
    return request('post', url, data)
}
