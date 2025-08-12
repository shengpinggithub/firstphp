<template>
<h1>Store Name to Database</h1>
<h2>Steps to launch the url:</h2>
<h2>1. php artisan serve</h2>
<h2>2. npm run build</h2>
<h2>3. npm run dev</h2>

<div>
  <input v-model="name" placeholder="Enter your name" />
  <input v-model="address" placeholder="Enter your address" />
  <input v-model="email" placeholder="Enter your email" />
  <input v-model="title" placeholder="Enter your title" />
  <input v-model="wage" type="number" step="0.01" placeholder="Enter your wage" />

  <button @click="submitInputedUser">Submit</button>
  <p v-if="message">{{ message }}</p>
</div>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'

const name = ref('')
const address = ref('')
const email = ref('')
const title = ref('')
const wage = ref('')
const message = ref('')

const submitInputedUser = async () => {
  try {
    const response = await axios.post('/input', {
      name: name.value,
      address: address.value,
      email: email.value,
      title: title.value,
      wage: wage.value,
    })

    message.value = `Hello, ${response.data.name}! Your title is "${response.data.title}" and wage is $${response.data.wage}.`

    // Clear inputs after submission
    name.value = ''
    address.value = ''
    email.value = ''
    title.value = ''
    wage.value = ''
  } catch (error) {
    message.value = 'Something went wrong.'
  }
}
</script>



