<script setup lang="ts">
import PublicLayout from '@/layouts/PublicLayout.vue'
import { onMounted } from 'vue'

defineOptions({
  layout: (h: any, page: any) => h(PublicLayout, { title: 'Home' }, () => page),
})

onMounted(() => {
  if (window.history && window.history.pushState) {
    window.history.pushState(null, '', window.location.href)
    window.onpopstate = function () {
      window.location.replace('/')
    }
  }
})
</script>

<template>
  <div class="home-container">
    <!-- Header Section -->
    <header class="header">
      <div class="header-content">
        <h1 class="title">Empowering Your</h1>
        <h1 class="subtitle">Journey Forward</h1>
        <p class="one">Connection In Every Click</p>
        <p class="two">
          PERFECT FOR YOUR LIFESTYLE. BUILT <br />
          FOR THOSE WHO SEEK EASE AND <br />
          EFFICIENCY, WE BRING SOLUTIONS <br />
          CLOSER TO YOU.
        </p>
      </div>
    </header>

    <!--Services Section -->
    <section class="services">
      <h2>How May We Assist You?</h2>
      <h5>
        WE OFFER A VARIETY OF SERVICES AIMED AT PROVIDING CONVENIENCE, <br />
        EFFICIENCY, AND SUPPORT FOR YOUR FINANCIAL AND MEMBERSHIP NEEDS.
      </h5>
      <div class="services-container">
        <div class="service-card">
          <img class="service-image" src="/images/LOAN.jpg" alt="Loan" />
          <h3>Loan</h3>
          <p>Offers a quick and easy way to apply for loans online, anytime.</p>
        </div>
        <div class="service-card">
          <img class="service-image" src="/images/MEMBERSHIP.jpg" alt="Membership" />
          <h3>Membership</h3>
          <p>Simplifies joining by allowing digital registration at your convenience.</p>
        </div>
        <div class="service-card">
          <img class="service-image" src="/images/PAYMENT.jpg" alt="Payment" />
          <h3>Payment</h3>
          <p>Secure and convenient options to manage and complete your payments with ease.</p>
        </div>
        <div class="service-card">
          <img class="service-image" src="/images/OFFICE.jpg" alt="Office" />
          <h3>Office</h3>
          <p>Provides direct assistance and personalized services for all your needs.</p>
        </div>
        <div class="service-card">
          <img class="service-image" src="/images/OTHERS.jpg" alt="Products" />
          <h3>Products</h3>
          <p>
            Offering a variety of everyday essentials such as rice, soap, and other useful items for your daily needs.
          </p>
        </div>
      </div>
    </section>

    <!-- Awards Section -->
    <section class="awards">
      <h2>Awards And Recognition</h2>
      <h5>RECOGNIZING MILESTONES AND CELEBRATING SUCCESS</h5>
      <div class="awards-container">
        <img src="/images/AWARD.png" alt="Award 1" />
      </div>
    </section>
  </div>
</template>

<style scoped>
/* Header Section */
.header {
  background-image: url('/images/HOME_BG.png'); /* Background image */
  background-size: cover;
  background-position: center;
  padding: 50px 100px;
  text-align: left;
  color: #da251c;
  height: 700px;
}

.title {
  font-size: 65px;
  font-weight: bolder;
  margin-top: 80px;
}

.subtitle {
  font-size: 65px;
  font-weight: bolder;
  margin-top: -35px;
  margin-left: 20px;
}

.one {
  font-size: 28px;
  font-weight: 600;
  margin-top: 50px;
}

.two {
  font-size: 16px;
}

/* Services Section */
.services {
  background-color: white;
  padding: 50px 0;
  text-align: center;
}

.services h2 {
  font-size: 45px;
  color: #000000;
  font-weight: bolder;
}

.services h5 {
  color: #000000;
  font-weight: lighter;
  margin-bottom: 30px;
}

.services-container {
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  gap: 10px; /* Adjust the gap to bring them closer */
}

/* Service Card */
.service-card {
  width: 300px;
  height: 370px;
  background-color: #ef233c;
  border-radius: 10px;
  text-align: center;
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.4); /* Darker shadow */
  transition: box-shadow 0.3s ease; /* Smooth transition when hovering */
}

/* Hover effect */
.service-card:hover {
  box-shadow: 0 12px 24px rgba(0, 0, 0, 0.6); /* More intense shadow on hover */
}

.service-card img {
  width: 100%; /* Ensures the image takes up 100% of the container width */
  height: auto; /* Automatically adjust the height to maintain aspect ratio */
  border-radius: 10px 10px 0 0; /* Rounded top corners only */
}

.service-card h3 {
  font-size: 20px;
  color: white;
  margin-top: 30px;
  font-weight: bolder;
}

.service-card p {
  font-size: 14px;
  color: white;
  padding: 10px;
}

/* Awards Section */
.awards {
  background-color: whites;
  padding: 50px 0;
  text-align: center;
}

.awards h2 {
  font-size: 45px;
  color: #333;
  font-weight: bolder;
}

.awards h5 {
  color: #000000;
  font-weight: lighter;
  margin-bottom: -15px;
}

.awards-container {
  display: flex;
  justify-content: center; /* Centers the single image horizontally */
}

.awards-container img {
  width: 800px;
  height: 650px;
}

/* Media Queries for Responsiveness */

/* For tablets and smaller screens */
@media (max-width: 1024px) {
  .header {
    padding: 40px 50px;
    height: 600px;
  }

  .title {
    font-size: 50px;
  }

  .subtitle {
    font-size: 50px;
    margin-top: -20px;
  }

  .one {
    font-size: 24px;
  }

  .two {
    font-size: 14px;
  }

  .services h2 {
    font-size: 35px;
  }

  .services h5 {
    font-size: 16px;
    margin-bottom: 20px;
  }

  .service-card {
    width: 250px;
    height: 320px;
  }

  .service-card img {
    width: 90%; /* Adjust width on smaller screens */
    height: auto; /* Maintain aspect ratio */
  }

  .service-card h3 {
    font-size: 18px;
  }

  .service-card p {
    font-size: 12px;
  }

  .awards-container img {
    width: 700px;
    height: 550px;
  }
}

/* For mobile phones */
@media (max-width: 768px) {
  .header {
    padding: 30px 20px;
    height: 500px;
  }

  .title {
    font-size: 40px;
  }

  .subtitle {
    font-size: 40px;
  }

  .one {
    font-size: 20px;
  }

  .two {
    font-size: 12px;
  }

  .services h2 {
    font-size: 30px;
  }

  .services h5 {
    font-size: 14px;
    margin-bottom: 15px;
  }

  .services-container {
    flex-direction: column;
    align-items: center;
  }

  .service-card {
    width: 80%;
    height: 350px;
    margin-bottom: 20px;
  }

  .service-card img {
    width: 100%; /* Full width on mobile devices */
    height: auto; /* Maintain aspect ratio */
  }

  .service-card h3 {
    font-size: 16px;
  }

  .service-card p {
    font-size: 14px;
  }

  .awards-container img {
    width: 100%;
    height: 400px;
  }
}
</style>
