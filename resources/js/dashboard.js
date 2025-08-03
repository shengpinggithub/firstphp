import { createApp } from 'vue'
import DashboardTabs from './Components/DashboardTabs.vue'
import Home from './Components/Home.vue'
import SearchUser from './Components/SearchUser.vue'
import SearchById from './Components/SearchById.vue'
import SearchByEmail from './Components/SearchByEmail.vue'
import EditUserModal from './Components/EditUserModal.vue'

const app = createApp({})
app.component('dashboard-tabs', DashboardTabs)
app.component('home', Home)
app.component('search-user', SearchUser)
app.component('edit-user-modal', EditUserModal)
app.component('search-by-id', SearchById)
app.component('search-by-email', SearchByEmail)
app.mount('#dashboardApp')
