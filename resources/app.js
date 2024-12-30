require('/js/bootstrap');

import { createApp } from 'vue';
import Welcome from '@/views/Welcome.vue';

createApp({
    components: {
        Welcome,
    }
}).mount('#app');