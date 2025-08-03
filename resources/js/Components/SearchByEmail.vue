<template>
  <div>
    <h2>Search by Email</h2>
    <input v-model="userEmail" type="text" placeholder="Enter Email" />
    <button @click="fetchUserByEmail">Search</button>

    <div v-if="error" style="color: red">{{ error }}</div>
    <div v-if="user">
      <p><strong>Name:</strong> {{ user.name }}</p>
      <p><strong>Address:</strong> {{ user.address || 'N/A' }}</p>
      <p><strong>Email:</strong> {{ user.email || 'N/A' }}</p>
      <p><strong>Title:</strong> {{ user.title || 'N/A' }}</p>
      <p><strong>Wage:</strong> {{ user.wage !== null ? '$' + user.wage : 'N/A' }}</p>   
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'

const userEmail = ref('')
const user = ref(null)
const error = ref('')

const fetchUserByEmail = async () => {
  error.value = ''
  user.value = null

  if (!userEmail.value) {
    error.value = 'Please enter a valid email'
    return
  }

  try {
    const response = await axios.get(`/search-user/email/${userEmail.value}`)
    user.value = response.data
  } catch (err) {
    error.value = 'User not found'
  }
}
</script>
