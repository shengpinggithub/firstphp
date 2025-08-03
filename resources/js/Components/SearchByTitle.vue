<template>
  <div>
    <input v-model="titleQuery" type="text" placeholder="Enter Title" />
    <button @click="searchByTitle">Search</button>

    <div v-if="error" style="color: red; margin-top: 1rem;">{{ error }}</div>

    <div
      v-for="user in users"
      :key="user.id"
      class="user-box"
    >
      <span class="user-name">{{ user.name }}</span>

      <div class="tool-icon-wrapper">
        <span class="tool-icon" @click="toggleTooltip(user.id)">⚙️</span>

        <div
          v-if="isTooltipVisible(user.id)"
          class="tooltip"
          @mouseenter="setTooltipHovered(user.id, true)"
          @mouseleave="closeTooltipWithDelay(user.id)"
        >
          <!-- <a @click.prevent="openEditModal(user)">✏️ Edit</a>
          <a @click.prevent="deleteUser(user)">🗑️ Delete</a> -->
            <div class="tooltip-actions">
                <a @click.prevent="openEditModal(user)" class="tooltip-link">✏️ Edit</a>
                <a @click.prevent="deleteUser(user)" class="tooltip-link">🗑️ Delete</a>
            </div>
        </div>
      </div>
    </div>

    <!-- Edit Modal -->
    <div v-if="showModal" class="modal-overlay">
      <div class="modal-content">
        <h3>Edit User</h3>
        <div class="form-group"><label>Name: </label><input v-model="form.name" /></div>
        <div class="form-group"><label>Address: </label><input v-model="form.address" /></div>
        <div class="form-group"><label>Email: </label><input v-model="form.email" /></div>
        <div class="form-group"><label>Title: </label><input v-model="form.title" /></div>
        <div class="form-group"><label>Wage: </label><input v-model="form.wage" type="number" /></div>

        <div class="button-group">
          <button @click="saveUser">Save</button>
          <button @click="closeModal">Cancel</button>
        </div>
      </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div v-if="showDeleteConfirm" class="modal-overlay">
      <div class="modal-content">
        <h3>Are you sure you want to delete {{ selectedUser?.name }}?</h3>
        <p>This action cannot be undone.</p>
        <button @click="confirmDelete">Yes, delete</button>
        <button @click="cancelDelete">Cancel</button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'

const titleQuery = ref('')
const users = ref([])
const error = ref('')

const selectedUser = ref(null)
const showModal = ref(false)
const showDeleteConfirm = ref(false)

const form = ref({ name: '', address: '', email: '', title: '', wage: 0 })

const searchByTitle = async () => {
  error.value = ''
  users.value = []
  try {
    const res = await axios.get('/search-user/title', {
      params: { title: titleQuery.value }
    })
    users.value = res.data.users
  } catch (err) {
    error.value = 'Search failed.'
  }
}

const openEditModal = (user) => {
  selectedUser.value = user
  Object.assign(form.value, user)
  showModal.value = true
}

const closeModal = () => {
  showModal.value = false
}

const saveUser = async () => {
  try {
    await axios.put(`/user/${selectedUser.value.id}`, form.value)
    const index = users.value.findIndex(u => u.id === selectedUser.value.id)
    if (index !== -1) users.value[index] = { ...form.value }
    showModal.value = false
  } catch (err) {
    error.value = 'Update failed'
  }
}

const deleteUser = (user) => {
  selectedUser.value = user
  showDeleteConfirm.value = true
}

const confirmDelete = async () => {
  try {
    await axios.delete(`/user/${selectedUser.value.id}`)
    users.value = users.value.filter(u => u.id !== selectedUser.value.id)
    showDeleteConfirm.value = false
  } catch (err) {
    error.value = 'Delete failed'
    showDeleteConfirm.value = false
  }
}

const cancelDelete = () => {
  showDeleteConfirm.value = false
}

// ✅ Tooltip logic (hover-safe and scoped per user)
const activeTooltipId = ref(null)
const tooltipHoverMap = ref({})

const toggleTooltip = (userId) => {
  activeTooltipId.value = activeTooltipId.value === userId ? null : userId
}

const setTooltipHovered = (userId, hovered) => {
  tooltipHoverMap.value[userId] = hovered
}

const closeTooltipWithDelay = (userId) => {
  setTimeout(() => {
    if (!tooltipHoverMap.value[userId] && activeTooltipId.value === userId) {
      activeTooltipId.value = null
    }
    tooltipHoverMap.value[userId] = false
  }, 200)
}

const isTooltipVisible = (userId) => {
  return activeTooltipId.value === userId || tooltipHoverMap.value[userId]
}
</script>

<style scoped>
.tool-icon {
  font-size: 32px;
  cursor: pointer;
}

.button-group {
  display: flex;
  justify-content: flex-end;
  gap: 12px;
  margin-top: 24px;
}

.form-group {
  display: flex;
  align-items: center;
  margin-bottom: 16px;
}

label {
  width: 120px;
  text-align: right;
  margin-right: 16px;
  font-weight: bold;
}

input {
  width: 400px;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

.user-box {
  display: flex;
  justify-content: space-between;
  align-items: center;
  border: 1px solid #ccc;
  padding: 1rem;
  margin-top: 1rem;
  border-radius: 4px;
  position: relative;
}

.tool-icon-wrapper {
  position: relative;
}

.tooltip {
  pointer-events: auto;
  position: absolute;
  /* top: calc(100% + 6px); */
  left: 50%;
  /* transform: translateX(-50%); */
  background: white;
  color: black;
  padding: 6px 12px;
  border-radius: 4px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.15);
  /* z-index: 1000; */
  width: 70px;
}

/* .tooltip {
  pointer-events: auto;
  position: absolute;
  right: 50;
  top: 100%;
  background: white;
  border: 5px solid #ccc;
  padding: 8px;
  display: none;
  width: 80px;
} */

.tooltip a {
  text-decoration: none;
  color: #222;
}

.tooltip a:hover {
  color: #000;
}

.tooltip-actions {
  display: flex;
  flex-direction: column;
  gap: 6px;
}

.tooltip-link {
  color: #222;
  font-weight: 500;
  text-decoration: none;
  cursor: pointer;
}

.tooltip-link:hover {
  color: #000;
}

.modal-overlay {
  position: fixed;
  top: 0; left: 0;
  width: 100%; height: 100%;
  background: rgba(0,0,0,0.5);
  display: flex; justify-content: center; align-items: center;
}

.modal-content {
  background: white;
  padding: 2rem;
  border-radius: 8px;
  width: 400px;
}
</style>
