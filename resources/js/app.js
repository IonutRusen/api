import('./bootstrap');
import { createApp } from 'vue';
import Welcome from './components/Welcome.vue';

createApp({
    components: {
        Welcome,
    },
    template: '<Welcome />' // Use the Welcome component in the root template
}).mount('#app');