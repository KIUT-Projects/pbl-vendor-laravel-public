import './bootstrap';

/*import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();*/

import {createApp} from 'vue'
import App from './App.vue'
import router from './router'

import './style.css'

createApp(App)
    .use(router)
    .mount('#app')
