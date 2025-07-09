import { createApp } from 'vue'
import DashboardTabs from './Components/DashboardTabs.vue'
import NameForm from './Components/NameForm.vue'
import SearchUser from './Components/SearchUser.vue'

const app = createApp({})
app.component('dashboard-tabs', DashboardTabs)
app.component('name-form', NameForm)
app.component('search-user', SearchUser)
app.mount('#dashboardApp')
