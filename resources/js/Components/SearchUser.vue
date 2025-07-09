<!-- SearchUser.vue -->
<template>
  <div>
    <h2>Search by ID</h2>
    <input v-model="userId" type="number" placeholder="Enter User ID" />
    <button @click="fetchUser">Search</button>
  </div>
  <div>
    <h2>Search by Address</h2>
    <input v-model="userAddress" type="string" placeholder="Enter User Address" />
    <button @click="fetchUserByAddress">Search</button>
  </div>
  
    <!-- 🔥 Unified Output Block -->
  <div v-if="error" style="color: red">{{ error }}</div>
  <div v-if="user">
    <p><strong>Name:</strong> {{ user.name }}</p>
    <p><strong>Address:</strong> {{ user.address || 'N/A' }}</p>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'

const userId = ref('')
const userAddress = ref('')
const user = ref(null)
const error = ref('')

const fetchUser = async () => {
  error.value = ''
  user.value = null
  console.log(`Searching for user ID: ${userId.value}`)
  try {
    const response = await axios.get(`/search-user/id/${userId.value}`)
    user.value = response.data
  } catch (err) {
    error.value = 'User not found'
  }
}

const fetchUserByAddress = async () => {
  error.value = ''
  user.value = null
  console.log(`Searching for user address: ${userAddress.value}`)
  try {
    const response = await axios.get(`/search-user/address/${userAddress.value}`)
    user.value = response.data
  } catch (err) {
    error.value = 'User not found'
  }
}
</script>
