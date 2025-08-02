import { createApp } from 'vue';
import Home from './Components/Home.vue';

console.log('Vue app is mounting...');
const app = createApp({});
app.component('home', Home);
app.mount('#app');
