<script setup lang="ts">
import PublicLayout from '@/layouts/PublicLayout.vue'

defineOptions({
  layout: (h: any, page: any) => h(PublicLayout, { title: 'Contact' }, () => page),
})
</script>

<template>
<div class="service-content">
  
  <h1 class="payment-title bg-rose-600">Payment Services</h1>
  
  <div class="payment-methods">
    <div class="payment-method">
      <img src="/images/BANK.png" alt="Bank Transfer" class="payment-icon"/>
      <h4>Bank Transfer</h4>
      <p>Transfer your payment directly to our bank account. Ensure you upload the proof of payment in your account for verification.</p>
    </div>
    <div class="payment-method">
      <img src="/images/GCASH.png" alt="GCash" class="payment-icon"/>
      <h4>Online Payment</h4>
      <p>Pay using our secure online platform. Simply log in to your account and choose the payment method that works best for you.</p>
    </div>
    <div class="payment-method">
      <img src="/images/OVER.png" alt="Over-the-Counter" class="payment-icon"/>
      <h4>Over-the-Counter Payment</h4>
      <p>You can also pay at our office or accredited payment centers. Visit our office for more information.</p>
    </div>
  </div>
</div>

</template>

<style scoped>
.payment-title {
  font-size: 2.5rem;
  color: #fff;
  text-align: center;
  font-weight: bolder;
  margin-bottom: 20px;
  padding: 50px;
}

.payment-description {
  font-size: 1.2rem;
  color: #333;
  text-align: center;
  margin-bottom: 40px;
}

.payment-methods {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 30px;
  margin: 117px auto 100px auto;
  max-width: 1900px;
  flex-wrap: wrap;
  height: auto;
}

.payment-method {
  background-color: #fff;
  width: 500px;
  padding: 20px;
  border-radius: 10px;
  text-align: center;
  box-shadow: 0 6px 9px rgba(0, 0, 0, 0.2);
  transition: transform 0.3s ease-in-out;
  height: 400px;
}

.payment-method:hover {
  transform: scale(1.05);
}

.payment-method h4 {
  font-size: 1.5rem;
  color: #EF233C;
  margin-top: 10px;
  font-weight: bolder;
}

.payment-method p {
  font-size: 0.9rem;
  color: #333;
  margin-top: 10px;
}



.payment-method img {
  width: 200px; 
  height: 200px; 
  margin: 20px auto;
}

/* Media Queries for Responsiveness */

/* For tablets and smaller screens */
@media (max-width: 1024px) {
  .payment-title {
    font-size: 2.2rem;
  }

  .payment-description {
    font-size: 1.1rem;
  }

  .payment-methods {
    gap: 20px;
    margin: 40px auto;
  }

  .payment-method {
    width: 300px;
    height: 350px;
    padding: 15px;
  }

  .payment-method h4 {
    font-size: 1.2rem;
  }

  .payment-method p {
    font-size: 0.9rem;
  }

  .payment-icon {
    width: 90px;
    height: 90px;
  }

  .payment-method img {
    width: 180px;
    height: 180px;
  }
}

/* For mobile phones */
@media (max-width: 768px) {
  .payment-title {
    font-size: 1.8rem;
  }

  .payment-description {
    font-size: 1rem;
  }

  .payment-methods {
    gap: 15px;
    margin: 30px auto;
  }

  .payment-method {
    width: 90%;
    height: auto;
    padding: 10px;
  }

  .payment-method h4 {
    font-size: 1rem;
  }

  .payment-method p {
    font-size: 0.8rem;
  }

  .payment-icon {
    width: 80px;
    height: 80px;
  }

  .payment-method img {
    width: 150px;
    height: 150px;
  }
}

</style>
