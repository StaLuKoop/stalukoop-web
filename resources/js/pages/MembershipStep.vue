<script setup lang="ts">
import PublicLayout from '@/layouts/PublicLayout.vue'

defineOptions({
  layout: (h: any, page: any) => h(PublicLayout, { title: 'Membership Step' }, () => page),
})
</script>

<template>
  <!-- Membership Section Content -->
  <div class="service-content">
    <h1 class="membership-title">Membership</h1>
    <p class="membership-description">
      Joining Sta. Lucia Parish Cooperative opens doors to a variety of financial services, including loans, savings
      <br />
      programs, and more. Our membership process is simple and can be completed online. Here’s how you can <br />
      apply and start enjoying the benefits of membership.
    </p>

    <div class="membership-types">
      <div class="membership-type">
        <img src="/images/INMEM.png" alt="Initial Membership Icon" />
        <h4>Initial Membership</h4>
        <p>Ideal for first-time members. Includes a membership fee and basic requirements.</p>
      </div>
      <div class="membership-type">
        <img src="/images/REGUMEM.png" alt="Regular Membership Icon" />
        <h4>Regular Membership</h4>
        <p>Includes a membership fee and basic requirements for all our members.</p>
      </div>
      <div class="membership-type">
        <img src="/images/ASSOMEM.png" alt="Associate Membership Icon" />
        <h4>Associate Membership</h4>
        <p>
          Available for members who wish to support the cooperative without full participation in the profit-sharing
          scheme.
        </p>
      </div>
    </div>

    <h3 class="how-member-title">How to Become a Member?</h3>
    <p class="how-member-desc">Follow these easy steps to complete your membership application.</p>

    <div class="steps">
      <!-- Step 1 (Image on Left) -->
      <div class="step">
        <div class="step-image">
          <img src="/images/MEM1.png" alt="Step 1 Image" />
        </div>
        <div class="step-text">
          <p>01</p>
          <h4>Create an Account</h4>
          <p>
            Start by registering or filling out your basic personal information such as your name, email address, and
            contact number to set up your online account.
          </p>
        </div>
      </div>

      <!-- Step 2 (Image on Right) -->
      <div class="step reverse">
        <div class="step-text">
          <p>02</p>
          <h4>Submit Initial Membership Payment</h4>
          <p>
            Pay a total of ₱3,000 and upload your proof of payment through your account. This includes your share
            capital, savings deposit, membership fee, and passbook cost to be tagged as an Initial Member.
          </p>
        </div>
        <div class="step-image">
          <img src="/images/MEM2.png" alt="Step 2 Image" />
        </div>
      </div>

      <!-- Step 3 (Image on Left) -->
      <div class="step">
        <div class="step-image">
          <img src="/images/MEM3.png" alt="Step 3 Image" />
        </div>
        <div class="step-text">
          <p>03</p>
          <h4>Wait for Admin Approval</h4>
          <p>
            Our team will carefully review your payment and submission. Once verified, you will receive an official
            confirmation via email or SMS, and your status will be updated to Initial Member.
          </p>
        </div>
      </div>

      <!-- Step 4 (Image on Right) -->
      <div class="step reverse">
        <div class="step-text">
          <p>04</p>
          <h4>Upgrade to Regular Membership</h4>
          <p>
            To become a full Regular Member, submit the required documents through the system and attend the mandatory
            PMES seminar onsite at the cooperative office.
          </p>
        </div>
        <div class="step-image">
          <img src="/images/MEM4.png" alt="Step 4 Image" />
        </div>
      </div>

      <!-- Step 5 (Image on Left) -->
      <div class="step">
        <div class="step-image">
          <img src="/images/MEM5.png" alt="Step 5 Image" />
        </div>
        <div class="step-text">
          <p>05</p>
          <h4>Get Full Access to Services</h4>
          <p>
            After completing all the requirements and being approved as a Regular Member, you will receive a
            verification email, and your account will be granted full access to cooperative services, including loan
            applications.
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.steps {
  display: flex;
  margin: auto;
  flex-direction: column;
  gap: 60px;
  max-width: 1200px;
}

.step {
  display: flex;
  gap: 80px;
  justify-content: center;
  align-items: center;
}

.step-text {
  flex: 1;
  text-align: left;
}

.step p {
  font-size: 3rem;
  font-weight: bolder;
  color: lightgray;
}

.step h4 {
  font-size: 1.5rem;
  font-weight: bolder;
  margin-bottom: 5px;
  margin-top: -45px;
  margin-left: 20px;
  color: #ef233c;
}

.step p:last-child {
  font-size: 1rem;
  color: #333;
  font-weight: lighter;
}

.step-image {
  flex: 1;
  text-align: center;
  margin-bottom: 20px;
}

.step-image img {
  max-width: 300px;
  height: 250px;
  margin: auto;
}

.reverse .step-text {
  text-align: left;
}

.reverse .step-image {
  text-align: left;
}

/* Membership Section Styles */
.membership-title {
  font-size: 45px;
  color: #ef233c;
  margin-bottom: 2px;
  font-weight: bolder;
  text-align: center;
  margin-top: 50px;
}

.membership-description {
  font-size: 16px;
  color: black;
  margin-bottom: 40px;
  text-align: center;
}

.membership-types {
  display: flex;
  justify-content: center;
  gap: 30px;
  margin-bottom: 50px;
  flex-wrap: wrap; /* Adjust to wrap on smaller screens */
}

.membership-type {
  background-color: white;
  padding: 20px;
  border-radius: 10px;
  text-align: center;
  width: 350px;
  height: 300px;
  border: solid 2px;
  margin-bottom: 20px; /* Add space between items */
}

.membership-type h4 {
  font-size: 1.2rem;
  font-weight: bold;
  margin-top: 10px;
  margin-bottom: 10px;
  color: #ef233c;
}

.membership-type p {
  font-size: 0.9rem;
}

.membership-type img {
  width: 110px;
  height: 100px;
  margin-bottom: 15px;
  margin-top: 25px;
  display: block;
  margin-left: auto;
  margin-right: auto;
}

.how-member-title {
  font-size: 2rem;
  color: #ef233c;
  text-align: center;
  font-weight: bolder;
}

.how-member-desc {
  font-size: 15px;
  color: black;
  margin-bottom: 40px;
  text-align: center;
  font-weight: 100;
}

/* Media Queries for Responsiveness */

/* For tablets and smaller screens */
@media (max-width: 1024px) {
  .membership-title {
    font-size: 2.5rem;
  }

  .membership-description {
    font-size: 1rem;
  }

  .steps {
    gap: 40px;
  }

  .step {
    gap: 50px;
  }

  .step p {
    font-size: 2.5rem;
  }

  .step h4 {
    font-size: 1.3rem;
  }

  .membership-types {
    gap: 20px;
  }

  .membership-type {
    width: 300px;
    height: 270px;
  }

  .membership-type img {
    width: 100px;
    height: 90px;
  }

  .how-member-title {
    font-size: 1.8rem;
  }

  .how-member-desc {
    font-size: 14px;
  }
}

/* For mobile phones */
@media (max-width: 768px) {
  .membership-title {
    font-size: 2rem;
  }

  .membership-description {
    font-size: 0.9rem;
  }

  .steps {
    gap: 20px;
  }

  .step {
    flex-direction: column;
    gap: 20px;
  }

  .step p {
    font-size: 2rem;
  }

  .step h4 {
    font-size: 1.2rem;
  }

  .step-image img {
    max-width: 220px;
    height: 200px;
  }

  .membership-types {
    flex-direction: column;
    align-items: center;
    gap: 20px;
  }

  .membership-type {
    width: 80%;
    height: auto;
    margin-bottom: 15px;
  }

  .membership-type img {
    width: 100px;
    height: 90px;
  }

  .how-member-title {
    font-size: 1.5rem;
  }

  .how-member-desc {
    font-size: 13px;
  }
}
</style>
