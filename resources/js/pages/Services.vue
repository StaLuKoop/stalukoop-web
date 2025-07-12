<script setup lang="ts">
import { ref } from 'vue'
import Loan from './Loan.vue'
import Membership from './MembershipStep.vue'
import Payment from './Payment.vue'
import Office from './Office.vue'
import Products from './Products.vue'

// Track which section to display
const currentSection = ref('')
</script>

<template>
  <div class="services-container">
    <h2 class="title">Products and Services</h2>
    <p class="description">
      Sta. Lucia Parish Cooperative, we strive to empower our members by offering reliable and accessible financial products and services.
    </p>

    <!-- Navigation Buttons -->
    <div class="services-buttons">
      <button @click="currentSection = 'loan'" class="service-button loan">
        <div class="icon-container"><i class="fas fa-coins"></i></div>
        <p class="service-title">Loan</p>
      </button>
      <button @click="currentSection = 'membership'" class="service-button membership">
        <div class="icon-container"><i class="fas fa-user-plus"></i></div>
        <p class="service-title">Membership</p>
      </button>
      <button @click="currentSection = 'payment'" class="service-button payment">
        <div class="icon-container"><i class="fas fa-credit-card"></i></div>
        <p class="service-title">Payment</p>
      </button>
      <button @click="currentSection = 'office'" class="service-button office">
        <div class="icon-container"><i class="fas fa-map-marker-alt"></i></div>
        <p class="service-title">Office</p>
      </button>
      <button @click="currentSection = 'products'" class="service-button products">
        <div class="icon-container"><i class="fas fa-box"></i></div>
        <p class="service-title">Products</p>
      </button>
    </div>

    <!-- Dynamic Component Rendering -->
    <component :is="currentSection === 'loan' ? Loan : 
                    currentSection === 'membership' ? Membership : 
                    currentSection === 'payment' ? Payment : 
                    currentSection === 'office' ? Office : 
                    currentSection === 'products' ? Products : null" />
  </div>
</template>

<style scoped>
.services-container {
  text-align: center;
  padding: 20px;
}

.title {
  font-size: 3rem;
  font-weight: bold;
  color: #EF233C;
  margin-bottom: 10px;
  margin-top: 50px;
}

.description {
  font-size: 1rem;
  color: #333;
  margin-bottom: 55px;
}

.services-buttons {
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  gap: 10px;
}

.service-button {
  background-color: #EF233C;
  color: white;
  width: 250px;
  height: 320px;
  border-radius: 10px;
  text-align: center;
  padding: 50px 30px 50px 30px;
  cursor: pointer;
  border: none;
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
  align-items: center;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  font-size: 24px;
  font-weight: bold;
  margin-bottom: 134px;
  transition: transform 0.2s ease;
}

.service-button:hover {
  transform: scale(1.05);
}

.icon-container {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-bottom: 15px;
}

.service-button i {
  font-size: 4rem;
  margin-bottom: 15px;
}

.service-title {
  font-size: 1.5rem;
  font-weight: bold;
  margin-bottom: 5px;
}

.service-description {
  font-size: 0.9rem;
  font-weight: lighter;
}

.service-content {
  margin-top: 30px;
  text-align: left;
}
</style>
