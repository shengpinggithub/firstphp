<template>
<h1>Store Name to Database Api</h1>
<h2>1. php artisan serve</h2>
<h2>2. npm run build</h2>
<h2>3. npm run dev</h2>

  <div>
    <input v-model="name" placeholder="Enter your name" />
    <input v-model="address" placeholder="Enter your address" />
    <button @click="submitInputedName">Submit</button>
    <p v-if="message">{{ message }}</p>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'

const name = ref('')
const address = ref('')
const message = ref('')

const submitInputedName = async () => {
  try {
    const response = await axios.post('/input', { name: name.value, 
        address: address.value
     })
    message.value = `Hello, ${response.data.name}!`
    name.value = ''
    address.value = ''
  } catch (error) {
    message.value = 'Something went wrong.'
  }
}
</script>


