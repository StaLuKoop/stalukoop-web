<script setup lang="ts">
import PublicLayout from '@/layouts/PublicLayout.vue'

defineOptions({
  layout: (h: any, page: any) => h(PublicLayout, { title: 'Products' }, () => page),
})
</script>

<template>
  <div class="service-content">
    <!-- Products Title -->
    <h1 class="products-title bg-rose-600">Products</h1>

    <!-- Products Section -->
    <div class="products-container">
      <div class="product-item">
        <img src="/images/RICE.png" alt="Rice Product" />
        <h3>Rice</h3>
        <p>Enjoy quality rice for your meals, perfect for every household.</p>
      </div>
      <div class="product-item">
        <img src="/images/SOAP.jpg" alt="Soap Product" />
        <h3>Soap</h3>
        <p>Provide efficient cleaning and care for your home and personal needs.</p>
      </div>
    </div>

    <!-- Footer Text -->
    <p class="footer-note">*These items are offered exclusively at our office. Visit us to purchase.</p>
  </div>
</template>

<style scoped>
.products-title {
  font-size: 2.5rem;
  color: #fff;
  text-align: center;
  font-weight: bolder;
  margin-bottom: 20px;
  padding: 50px;
}

.products-container {
  display: flex;
  justify-content: cen;
  gap: 50px;
  max-width: 1200px;
  margin: 50px auto;
  border-radius: 15px;

}

.product-item {
  flex: 1;
  text-align: center;
  padding: 20px;
  background-color: white;
  border-radius: 10px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.product-item img {
  max-width: 600px;
  height: auto;
  margin:auto;
  border-radius: 15px;
}

.product-item h3 {
  font-size: 1.8rem;
  color: #EF233C;
  margin-bottom: 2px;
  margin-top: 10px;
  font-weight: bolder;  
}

.product-item p {
  font-size: 1rem;
  color: #333;
}

.footer-note {
  text-align: center;
  font-size: 1rem;
  color: #999;
  margin-top: -12px;
  margin-bottom: 10px;
}

@media (max-width: 768px) {
  .products-title {
    font-size: 2rem;
    padding: 30px;
  }

  .products-container {
    flex-direction: column;
    gap: 20px;
  }

  .product-item {
    width: 100%;
    padding: 15px;
  }

  .product-item img {
    max-width: 150px;
  }
}
</style>
