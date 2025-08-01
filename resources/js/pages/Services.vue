<script setup lang="ts">
import PublicLayout from '@/layouts/PublicLayout.vue'
import { Link } from '@inertiajs/vue3'

defineOptions({
  layout: (h: any, page: any) => h(PublicLayout, { title: 'Services' }, () => page),
})
</script>

<template>
  <div class="services-container">
    <!-- Initially visible content (header and description) -->
    <h2 class="title">Products and Services</h2>
    <p class="description">
      Sta. Lucia Parish Cooperative, we strive to empower our members by offering reliable and <br />
      accessible financial products and services. Our goal is to help you achieve financial stability, <br />
      grow your investments, and support the well-being of our community through cooperative <br />
      efforts and shared success.
    </p>

    <!-- Navigation Buttons (Link to different pages using Inertia) -->
    <div class="services-buttons">
      <!-- Link to Loan Page -->
      <Link href="/loan" class="service-button loan">
        <div class="icon-container"><i class="fas fa-coins"></i></div>
        <p class="service-title">Loan</p>
        <p class="service-description">Offers a quick and easy way to apply for loans online, anytime.</p>
      </Link>

      <!-- Link to Membership Step Page -->
      <Link href="/membership-step" class="service-button membership-step">
        <div class="icon-container"><i class="fas fa-user-plus"></i></div>
        <p class="service-title">Membership</p>
        <p class="service-description">Follow the steps to complete your membership registration.</p>
      </Link>

      <!-- Link to Payment Page -->
      <Link href="/payment" class="service-button payment">
        <div class="icon-container"><i class="fas fa-credit-card"></i></div>
        <p class="service-title">Payment</p>
        <p class="service-description">Secure and convenient options to manage and complete your payments with ease.</p>
      </Link>

      <!-- Link to Office Page -->
      <Link href="/office" class="service-button office">
        <div class="icon-container"><i class="fas fa-map-marker-alt"></i></div>
        <p class="service-title">Office</p>
        <p class="service-description">Provides direct assistance and personalized services for all your needs.</p>
      </Link>

      <!-- Link to Products Page -->
      <Link href="/products" class="service-button products">
        <div class="icon-container"><i class="fas fa-box"></i></div>
        <p class="service-title">Products</p>
        <p class="service-description">
          Offering a variety of everyday essentials such as rice, soap, and other useful items for your daily needs.
        </p>
      </Link>
    </div>
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
  color: #ef233c;
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
  background-color: #ef233c;
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
