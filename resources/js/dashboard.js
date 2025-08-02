import { createApp } from 'vue'
import DashboardTabs from './Components/DashboardTabs.vue'
import Home from './Components/Home.vue'
import SearchUser from './Components/SearchUser.vue'

const app = createApp({})
app.component('dashboard-tabs', DashboardTabs)
app.component('home', Home)
app.component('search-user', SearchUser)
app.mount('#dashboardApp')
