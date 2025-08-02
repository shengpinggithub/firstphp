<template>
  <div>
    <input v-model="title" placeholder="Search by Title" />
    <button @click="searchByTitle">Search</button>

    <div v-if="error" class="error">{{ error }}</div>

    <div v-for="user in users" :key="user.id" class="user-entry">
      <span>{{ user.name }} - {{ user.title }}</span>
      <button @click="openEdit(user)">✏️</button>
      <button @click="confirmDelete(user)">🗑️</button>
    </div>

    <!-- Edit Modal -->
    <div v-if="editing" class="modal">
      <h3>Edit User</h3>
      <input v-model="form.name" placeholder="Name" />
      <input v-model="form.email" placeholder="Email" />
      <input v-model="form.title" placeholder="Title" />
      <input v-model="form.wage" placeholder="Wage" type="number" />
      <button @click="updateUser">Save</button>
      <button @click="editing = false">Cancel</button>
      <div v-if="modalError" class="error">{{ modalError }}</div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'

const title = ref('')
const users = ref([])
const error = ref('')
const editing = ref(false)
const modalError = ref('')
const selected = ref(null)
const form = ref({ name: '', email: '', title: '', wage: 0 })

const searchByTitle = async () => {
  error.value = ''
  users.value = []
  try {
    const res = await axios.get(`/search-user/title/${title.value}`)
    users.value = res.data
  } catch (err) {
    error.value = err.response?.data?.error || 'Search failed'
  }
}

const openEdit = (user) => {
  selected.value = user
  Object.assign(form.value, user)
  editing.value = true
}

const updateUser = async () => {
  try {
    await axios.put(`/user/${selected.value.id}`, form.value)
    Object.assign(selected.value, form.value)
    editing.value = false
  } catch {
    modalError.value = 'Update failed'
  }
}

const confirmDelete = async (user) => {
  try {
    await axios.delete(`/user/${user.id}`)
    users.value = users.value.filter(u => u.id !== user.id)
  } catch {
    error.value = 'Delete failed'
  }
}
</script>

<style scoped>
.user-entry {
  margin: 0.5rem 0;
  display: flex;
  align-items: center;
  gap: 0.5rem;
}
.modal {
  background: #f4f4f4;
  padding: 1rem;
  border: 1px solid #ccc;
}
.error {
  color: red;
  margin-top: 0.5rem;
}
</style>
