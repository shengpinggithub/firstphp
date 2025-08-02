<template>
  <div>
    <input v-model="userId" type="text" placeholder="Enter User ID" />
    <button @click="fetchUserById">Search</button>

    <div v-if="error" style="color: red; margin-top: 1rem;">{{ error }}</div>

    <div v-if="user" class="user-box">
      <span class="user-name">{{ user.name }}</span>
      <div class="tool-icon-wrapper">
        <span class="tool-icon">⚙️</span>
        <div class="tooltip">
          <div style="display: flex; flex-direction: column; align-items: flex-start; gap: 0.5rem;">
            <a href="#" @click.prevent="openEditModal" style="display: flex; align-items: center; gap: 0.5rem; color: #007bff;">
              <i class="fas fa-edit"></i>
              Edit
            </a>
            <a href="#" @click.prevent="deleteUser" style="display: flex; align-items: center; gap: 0.5rem; color: #dc3545;">
              <i class="fas fa-trash"></i>
              Delete
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- Edit Modal -->
    <div v-if="showModal" class="modal-overlay">
      <div class="modal-content">
        <h3>Edit User</h3>
        <input v-model="form.name" placeholder="Name" />
        <input v-model="form.address" placeholder="Address" />
        <input v-model="form.email" placeholder="Email" />
        <input v-model="form.title" placeholder="Title" />
        <input v-model="form.wage" type="number" placeholder="Wage" />

        <button @click="saveUser">Save</button>
        <button @click="closeModal">Cancel</button>
      </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div v-if="showDeleteConfirm" class="modal-overlay">
      <div class="modal-content">
        <h3>Are you sure you want to delete this user?</h3>
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

const showDeleteConfirm = ref(false)
const userId = ref('')
const user = ref(null)
const error = ref('')
const showModal = ref(false)
const form = ref({
  name: '',
  address: '',
  email: '',
  title: '',
  wage: 0
})

const fetchUserById = async () => {
  error.value = ''
  user.value = null
  try {
    const res = await axios.get(`/search-user/id/${userId.value}`)
    user.value = res.data
    Object.assign(form.value, res.data)
  } catch (err) {
    error.value = err.response?.status === 404 ? 'User not found' : 'Unexpected error occurred'
  }
}

const openEditModal = () => {
  showModal.value = true
  Object.assign(form.value, user.value)
}

const closeModal = () => {
  showModal.value = false
}

const saveUser = async () => {
  try {
    await axios.put(`/user/${user.value.id}`, form.value)
    user.value = { ...form.value }
    showModal.value = false
  } catch (err) {
    error.value = 'Update failed'
  }
}

const confirmDelete = async () => {
  try {
    await axios.delete(`/user/${user.value.id}`)
    user.value = null
    showDeleteConfirm.value = false
  } catch (err) {
    error.value = 'Delete failed'
    showDeleteConfirm.value = false
  }
}

const cancelDelete = () => {
  showDeleteConfirm.value = false
}

const deleteUser = () => {
  showDeleteConfirm.value = true
}
</script>

<style scoped>
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

.tool-icon {
  cursor: pointer;
}

.tooltip {
  position: absolute;
  right: 0;
  top: 100%;
  background: white;
  border: 1px solid #ccc;
  padding: 0.5rem;
  display: none;
}

.tool-icon-wrapper:hover .tooltip {
  display: block;
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
}
</style>
