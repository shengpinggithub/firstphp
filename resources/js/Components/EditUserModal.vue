<template>
  <div v-if="visible" class="modal-overlay">
    <div class="modal-content">
      <h3>Edit User</h3>

      <input v-model="form.name" placeholder="Name" />
      <input v-model="form.address" placeholder="Address" />
      <input v-model="form.email" placeholder="Email" />
      <input v-model="form.title" placeholder="Title" />
      <input v-model="form.wage" type="number" placeholder="Wage" />

      <div v-if="error" class="error-message">{{ error }}</div>

      <button @click="saveUser">Save</button>
      <button @click="close">Cancel</button>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'

const visible = ref(false)
const error = ref('')
const userId = ref(null)

const form = ref({
  name: '',
  address: '',
  email: '',
  title: '',
  wage: 0
})

const fetchUser = async (id) => {
  error.value = ''
  userId.value = id
  try {
    const res = await axios.get(`/user/${id}`)
    Object.assign(form.value, res.data)
    visible.value = true
  } catch (err) {
    error.value = 'Failed to load user'
    visible.value = false
  }
}

const saveUser = async () => {
  error.value = ''
  try {
    await axios.put(`/user/${userId.value}`, form.value)
    visible.value = false
  } catch (err) {
    error.value = 'Update failed'
  }
}

const close = () => {
  visible.value = false
}

defineExpose({ fetchUser })
</script>

<style scoped>
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
  width: 90%;
  max-width: 500px;
}

.error-message {
  margin-top: 1rem;
  color: red;
}
</style>
