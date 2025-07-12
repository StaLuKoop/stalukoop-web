<script setup lang="ts">
<<<<<<< HEAD
<<<<<<< HEAD
import PublicLayout from '@/layouts/PublicLayout.vue';
import { Link } from '@inertiajs/vue3'; // Import Inertia's Link component

defineOptions({
  layout: (h: any, page: any) => h(PublicLayout, { title: 'Services' }, () => page),
});
=======
import { ref } from 'vue'
import Loan from './Loan.vue'
import Membership from './MembershipStep.vue'
import Payment from './Payment.vue'
import Office from './Office.vue'
import Products from './Products.vue'

// Track which section to display
const currentSection = ref('')
>>>>>>> c7462b62887ce6a05f6da5290825947d40019237
=======
import { ref } from 'vue'
import Loan from './Loan.vue'
import Membership from './MembershipStep.vue'
import Payment from './Payment.vue'
import Office from './Office.vue'
import Products from './Products.vue'

// Track which section to display
const currentSection = ref('')
>>>>>>> c7462b62887ce6a05f6da5290825947d40019237
</script>

<template>
  <div class="services-container">
<<<<<<< HEAD
<<<<<<< HEAD
    <!-- Initially visible content (header and description) -->
    <h2 class="title">Products and Services</h2>
    <p class="description">
      Sta. Lucia Parish Cooperative, we strive to empower our members by offering reliable and <br>
      accessible financial products and services. Our goal is to help you achieve financial stability, <br>
      grow your investments, and support the well-being of our community through cooperative <br>
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
        <p class="service-description">Offering a variety of everyday essentials such as rice, soap, and other useful items for your daily needs.</p>
      </Link>
    </div>
=======
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
=======
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
>>>>>>> c7462b62887ce6a05f6da5290825947d40019237
      </button>
    </div>

    <!-- Dynamic Component Rendering -->
    <component :is="currentSection === 'loan' ? Loan : 
                    currentSection === 'membership' ? Membership : 
                    currentSection === 'payment' ? Payment : 
                    currentSection === 'office' ? Office : 
                    currentSection === 'products' ? Products : null" />
<<<<<<< HEAD
>>>>>>> c7462b62887ce6a05f6da5290825947d40019237
=======
>>>>>>> c7462b62887ce6a05f6da5290825947d40019237
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
<<<<<<< HEAD
<<<<<<< HEAD

/* Media Queries for Responsiveness */

/* For tablets and smaller screens */
@media (max-width: 1024px) {
  .title {
    font-size: 2.5rem;
  }

  .description {
    font-size: 0.9rem;
  }

  .service-button {
    width: 200px;
    height: 270px;
    padding: 30px;
    margin-bottom: 20px;
  }

  .service-button i {
    font-size: 3rem;
  }

  .service-title {
    font-size: 1.3rem;
  }

  .service-description {
    font-size: 0.85rem;
  }
}

/* For mobile phones */
@media (max-width: 768px) {
  .title {
    font-size: 2rem;
    margin-top: 20px;
  }

  .description {
    font-size: 0.8rem;
    margin-bottom: 40px;
  }

  .service-button {
    width: 90%;
    height: auto;
    padding: 20px;
  }

  .service-button i {
    font-size: 2.5rem;
  }

  .service-title {
    font-size: 1.2rem;
  }

  .service-description {
    font-size: 0.8rem;
  }

  .services-buttons {
    flex-direction: column;
    align-items: center;
  }
}

=======
>>>>>>> c7462b62887ce6a05f6da5290825947d40019237
=======
>>>>>>> c7462b62887ce6a05f6da5290825947d40019237
</style>
