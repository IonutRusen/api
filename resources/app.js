require('/js/bootstrap');

import { createApp } from 'vue';
import Welcome from './js/components/Welcome.vue';

createApp({
    components: {
        Welcome,
    }
}).mount('#app');