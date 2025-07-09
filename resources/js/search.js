import { createApp } from 'vue'
import SearchUser from './Components/SearchUser.vue'


const app = createApp({})
app.component('search-user', SearchUser)
app.mount('#searchApp')
