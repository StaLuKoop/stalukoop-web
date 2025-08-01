<script setup lang="ts">
import PublicLayout from '@/layouts/PublicLayout.vue'
import { router } from '@inertiajs/vue3'
import { reactive } from 'vue'
import Swal from 'sweetalert2'

defineOptions({
  layout: (h: any, page: any) => h(PublicLayout, { title: 'Contact' }, () => page),
})

const form = reactive({
  first_name: '',
  last_name: '',
  email: '',
  phone: '',
  inquiry: '',
  message: '',
})

function submit() {
  router.post('/inquiries', form, {
    onSuccess: () => {
      Swal.fire({
        icon: 'success',
        title: 'Message Sent',
        text: 'Thank you for reaching out. We will get back to you shortly.',
        confirmButtonColor: '#ef233c',
      })

      // Reset form
      form.first_name = ''
      form.last_name = ''
      form.email = ''
      form.phone = ''
      form.inquiry = ''
      form.message = ''
    },
    onError: () => {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Something went wrong. Please try again later.',
        confirmButtonColor: '#ef233c',
      })
    },
  })
}
</script>

<template>
  <div class="service-content">
    <!-- Contact Title -->
    <h1 class="contact-title bg-rose-600">Contact Us</h1>

    <!-- Contact Form and Info Section -->
    <div class="contact-container">
      <!-- Contact Info Section -->
      <div class="contact-info">
        <p class="contact-heading">Let’s talk with us</p>
        <p class="contact-description">Your journey starts with a simple connection</p>

        <div class="contact-details">
          <div class="address">
            <i class="fas fa-map-marker-alt"></i>
            <span>403 Amang Rodriguez Avenue, Manggahan, Pasig City</span>
          </div>
          <div class="phone">
            <i class="fas fa-phone"></i>
            <span>09122887929</span>
          </div>
          <div class="email">
            <i class="fas fa-envelope"></i>
            <span>staluciacoop@gmail.com</span>
          </div>
        </div>
      </div>

      <!-- Contact Form Section -->
      <div class="contact-form">
        <form @submit.prevent="submit">
          <div class="form-row">
            <input v-model="form.first_name" type="text" placeholder="First Name" required />
            <input v-model="form.last_name" type="text" placeholder="Last Name" required />
          </div>
          <input v-model="form.email" type="email" placeholder="Email Address" required />
          <input v-model="form.phone" type="tel" placeholder="Phone Number" required />
          <input v-model="form.inquiry" type="text" placeholder="Inquiry" required />
          <textarea v-model="form.message" placeholder="Your message..." required></textarea>
          <button type="submit" class="submit-btn">Send Message</button>
        </form>
      </div>
    </div>
  </div>
</template>

<style scoped>
.contact-title {
  font-size: 2.5rem;
  color: #fff;
  text-align: center;
  font-weight: bolder;
  margin-bottom: 20px;
  padding: 30px;
}

.contact-container {
  display: flex;
  justify-content: center;
  gap: 20px;
  padding: 20px;
  margin: 30px auto;
  max-width: 1200px; /* Adjusted max-width for better responsiveness */
}

.contact-info {
  flex: 1;
  background-color: #fff;
  padding: 20px;
  border-radius: 10px;
  margin-top: 40px;
}
.contact-form {
  flex: 1;
  background-color: #fff;
  padding: 30px;
  border-radius: 10px;
  border: 1px solid black;
  margin-top: 33px;
}

.contact-heading {
  font-size: 1.8rem;
  color: #ef233c;
  font-weight: bold;
  margin-bottom: 10px;
}

.contact-description {
  font-size: 1.2rem;
  margin-bottom: 20px;
}

.contact-details {
  font-size: 1rem;
  color: black;
}

.contact-details .address,
.contact-details .phone,
.contact-details .email {
  display: flex;
  align-items: center;
  margin-bottom: 10px;
}

.contact-details i {
  margin-right: 10px;
  color: #ef233c;
}

.contact-form input,
.contact-form textarea {
  width: 100%;
  padding: 12px;
  margin-bottom: 15px;
  border: 1px solid black;
  border-radius: 5px;
  font-size: 1rem;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Adding a subtle shadow */
}

.contact-form .form-row {
  display: flex;
  gap: 20px;
}

.contact-form input[type='text'] {
  flex: 1; /* Ensures both input fields take equal space */
}

.contact-form textarea {
  resize: vertical;
  height: 120px;
}

.submit-btn {
  padding: 12px 25px;
  background-color: #ef233c;
  color: #fff;
  font-size: 1.1rem;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  display: block; /* Make the button a block element */
  margin: 5px auto; /* Center the button with equal margins on top and bottom */
}

.submit-btn:hover {
  background-color: #d71f31;
}

@media (max-width: 768px) {
  .contact-title {
    font-size: 2rem;
    padding: 20px;
  }

  .contact-container {
    flex-direction: column;
    gap: 10px;
    padding: 10px;
  }

  .contact-form input,
  .contact-form textarea {
    padding: 10px;
    font-size: 0.9rem;
  }

  .submit-btn {
    padding: 10px 20px;
  }
}
</style>
