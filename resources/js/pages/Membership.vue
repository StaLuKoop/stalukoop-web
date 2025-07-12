<script setup lang="ts">
import PublicLayout from '@/layouts/PublicLayout.vue'

defineOptions({
  layout: (h: any, page: any) => h(PublicLayout, { title: 'Membership' }, () => page),
})
</script>

<template>
  <div class="service-content">
    <!-- Membership Title -->
    <h1 class="membership-title bg-rose-600">Membership Classification</h1>

    <!-- Membership Content Section -->
    <div class="membership-container">
      <!-- Image Section -->
      <div class="membership-image">
        <img src="/images/MEM.png" alt="Membership Image" />
      </div>

      <!-- Membership Boxes Section -->
      <div class="membership-boxes">
        <div class="membership-card">
          <h3>Initial Membership</h3>
          <ul>
            <li>• Share Capital - 2000</li>
            <li>• Savings Deposit - 650</li>
            <li>• Membership Fee - 300</li>
            <li>• Passbook - 50</li>
            <li>Total: 3000 Php</li>
          </ul>
        </div>

        <div class="membership-card">
          <h3>Regular Membership</h3>
          <ul>
            <li>• Share Capital - 5000</li>
            <li>• Certificate of PMES Completion</li>
            <li>• Photocopy of Valid Government-issued ID</li>
            <li>• Tax Identification Number</li>
            <li>• One Photocopy of Proof of Billing</li>
            <li>• Recent 2x2 ID Picture</li>
            <li>• Regular Membership Application Form</li>
          </ul>
        </div>

        <div class="membership-card">
          <h3>Associate Membership</h3>
          <ul>
            <li>• Same Requirements as Initial Membership</li>
          </ul>
        </div>

        <div class="membership-card">
          <h3>Member Characteristics</h3>
          <ul>
            <li>• 18 to 65 years old</li>
            <li>• Filipino Citizen</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.membership-title {
  font-size: 2.5rem;
  color: #fff;
  text-align: center;
  font-weight: bolder;
  margin-bottom: 20px;
  padding: 50px;
}

.membership-container {
  display: flex;
  gap: 100px;
  justify-content: center;
  padding: 20px;
  margin: 50px auto 56px;
  max-width: 1200px;
}

.membership-image {
  flex: 1;
  padding: 20px;
  display: flex;
  justify-content: center;
  align-items: center;
}

.membership-image img {
  max-width: 800px;
  height: auto;
}

.membership-boxes {
  flex: 2;
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 20px;
}

.membership-card {
  background-color: #fff;
  padding: 20px;
  border-radius: 10px;
  border: 1px solid #ddd;
  box-shadow: 2px 8px 8px rgba(0, 0, 0, 0.2);
  width: 450px;
}

.membership-card h3 {
  font-size: 1.3rem;
  color: #ef233c;
  margin-bottom: 10px;
  font-weight: bolder;
  text-align: center;
}

.membership-card ul {
  font-size: 0.9rem;
  color: #333;
}

.membership-card ul li {
  margin-bottom: 10px;
}

@media (max-width: 768px) {
  .membership-title {
    font-size: 2rem;
    padding: 20px;
  }

  .membership-container {
    flex-direction: column;
    gap: 10px;
    padding: 10px;
  }

  .membership-boxes {
    grid-template-columns: 1fr;
  }

  .membership-card {
    padding: 15px;
  }

  .membership-card h2 {
    font-size: 1.5rem;
  }

  .membership-card ul li {
    font-size: 1rem;
  }
}
</style>
