<script setup lang="ts">
import PublicLayout from '@/layouts/PublicLayout.vue'

defineOptions({
  layout: (h: any, page: any) => h(PublicLayout, { title: 'Office' }, () => page),
})
</script>

<template>
  <div class="service-content">
    <!-- Office Title -->
    <h1 class="office-title bg-rose-600">Office</h1>

    <!-- Office Information Section -->
    <div class="office-container">
      <!-- Map Section -->
      <div class="office-map">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4811.077281553321!2d121.08939927591906!3d14.60322157701091!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b80f946eb567%3A0x4fa0ed64cec2c94!2s403%20Eulogio%20Amang%20Rodriguez%20Ave%2C%20Pasig%2C%201611%20Metro%20Manila!5e1!3m2!1sen!2sph!4v1752317638593!5m2!1sen!2sph"
          width="100%"
          height="500"
          frameborder="0"
          style="border: 0"
          allowfullscreen
        ></iframe>
      </div>

      <!-- Contact Details Section -->
      <div class="office-details">
        <h2 class="office-name">STA.LUCIA PARISH COOP MAIN OFFICE</h2>
        <div class="office-info">
          <p><strong>Address:</strong> 403 Amang Rodriguez Avenue, Manggahan, Pasig City</p>
          <p><strong>Phone:</strong> 8700000</p>
          <p><strong>Email:</strong> sta.lucia@gmail.com</p>
          <p>
            <strong>Facebook:</strong>
            <a href="https://www.facebook.com/SLPCC1995/" target="_blank">www.facebook.com/SLPCC1995/</a>
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.office-title {
  font-size: 2.5rem;
  color: #fff;
  text-align: center;
  font-weight: bolder;
  margin-bottom: 20px;
  padding: 50px;
}

.office-container {
  display: flex;
  justify-content: space-between;
  gap: 20px;
  max-width: 1500px;
  margin: 38.3px auto;
  padding: 20px;
}

.office-map {
  flex: 1;
  width: 50%;
}

.office-details {
  flex: 1;
  width: 45%;
  background-color: #fff;
  padding: 30px;
  border-radius: 10px;
  box-shadow: 0 4px 6px rgba(0, 0.5, 0.1, 0.1);
}

.office-name {
  font-size: 1.8rem;
  color: #ef233c;
  margin-bottom: 20px;
  font-weight: bolder;
  text-align: center;
}

.office-info {
  font-size: 1.2rem;
  color: #333;
}

.office-info p {
  margin-bottom: 10px;
}

.office-info a {
  color: #ef233c;
  text-decoration: none;
  font-weight: bold;
}

.office-info a:hover {
  text-decoration: underline;
}

/* For screens smaller than 1024px (tablets) */
@media (max-width: 1024px) {
  .office-title {
    font-size: 2.2rem; /* Adjust title size */
    padding: 40px;
  }

  .office-container {
    flex-direction: column; /* Stack map and contact details on top of each other */
    padding: 15px;
    gap: 15px; /* Adjust gap between map and contact details */
  }

  .office-map {
    width: 100%; /* Ensure map takes full width */
    height: 250px; /* Adjust map height */
  }

  .office-details {
    width: 100%; /* Ensure details take full width */
    padding: 20px;
  }

  .office-name {
    font-size: 1.6rem; /* Adjust size of the office name */
  }

  .office-info {
    font-size: 1rem; /* Slightly reduce font size for smaller screens */
  }

  .office-info p {
    font-size: 1rem;
  }

  .office-info a {
    font-size: 1rem; /* Adjust font size of the link */
  }
}

/* For mobile screens (less than 768px) */
@media (max-width: 768px) {
  .office-title {
    font-size: 2rem; /* Adjust title size */
    padding: 30px;
  }

  .office-container {
    flex-direction: column; /* Stack map and details vertically */
    gap: 20px; /* Adjust gap between map and details */
    padding: 10px;
  }

  .office-map {
    width: 100%; /* Ensure map takes full width */
    height: 200px; /* Adjust map height */
  }

  .office-details {
    width: 100%; /* Full width for the details */
    padding: 15px;
  }

  .office-name {
    font-size: 1.4rem; /* Adjust font size of the office name */
  }

  .office-info {
    font-size: 1rem; /* Adjust font size for readability */
  }

  .office-info p {
    margin-bottom: 8px;
  }

  .office-info a {
    font-size: 1rem; /* Adjust font size for smaller screens */
  }
}
</style>
