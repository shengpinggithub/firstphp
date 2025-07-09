<template>
<p style="text-align: center; font-size: 36px;">Great Beautiful Api</p>
  <div class="tabs">
    <div class="tab-headers">
      <div 
        class="tab" 
        :class="{ active: activeTab === 'greet' }" 
        @click="activeTab = 'greet'"
      >
        Greet
      </div>
      <div 
        class="tab" 
        :class="{ active: activeTab === 'search' }" 
        @click="activeTab = 'search'"
      >
        Search
      </div>
    </div>

    <div class="tab-content">
      <name-form v-if="activeTab === 'greet'" />
      <search-user v-if="activeTab === 'search'" />
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import NameForm from './NameForm.vue'
import SearchUser from './SearchUser.vue'

const activeTab = ref('greet')
</script>

<style scoped>
.tabs {
  max-width: 600px;
  margin: 0 auto;
  font-family: sans-serif;
}

.tab-headers {
  display: flex;
  border-bottom: 2px solid #ccc;
}

.tab {
  flex: 1;
  text-align: center;
  padding: 12px;
  cursor: pointer;
  font-weight: bold;
  color: #666;
  border-bottom: 2px solid transparent;
  transition: all 0.3s ease;
}

.tab:hover {
  background-color: #f4f4f4;
}

.tab.active {
  color: #000;
  border-bottom-color: #007bff;
}

.tab-content {
  padding: 20px;
  background: #f9f9f9;
  border-radius: 6px;
  margin-top: 1rem;
}
</style>
