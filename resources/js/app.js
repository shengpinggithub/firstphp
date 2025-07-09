import { createApp } from 'vue';
import NameForm from './Components/NameForm.vue';

console.log('Vue app is mounting...');
const app = createApp({});
app.component('name-form', NameForm);
app.mount('#app');
