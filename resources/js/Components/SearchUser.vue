<template>
  <div>
    <div class="subtab-headers">
      <div 
        class="subtab" 
        :class="{ active: activeSubtab === 'id' }" 
        @click="activeSubtab = 'id'"
      >
        By ID
      </div>
      <div 
        class="subtab" 
        :class="{ active: activeSubtab === 'email' }" 
        @click="activeSubtab = 'email'"
      >
        By Email
      </div>
    </div>

    <div class="subtab-content">
      <search-by-id v-if="activeSubtab === 'id'" />
      <search-by-email v-if="activeSubtab === 'email'" />
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import SearchById from './SearchById.vue'
import SearchByEmail from './SearchByEmail.vue'

const activeSubtab = ref('id')
</script>

<style scoped>
.subtab-headers {
  display: flex;
  border-bottom: 1px solid #ccc;
  margin-bottom: 1rem;
}

.subtab {
  flex: 1;
  text-align: center;
  padding: 10px;
  cursor: pointer;
  font-weight: bold;
  color: #666;
  border-bottom: 2px solid transparent;
  transition: all 0.3s ease;
}

.subtab.active {
  color: #000;
  border-bottom-color: #007bff;
}

.subtab-content {
  background: #f2f2f2;
  padding: 1rem;
  border-radius: 6px;
}
</style>
