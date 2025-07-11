<script setup lang="ts">
import PublicLayout from '@/layouts/PublicLayout.vue'
import { ref } from 'vue'

// Set the layout for the page
defineOptions({
  layout: (h: any, page: any) => h(PublicLayout, { title: 'Services' }, () => page),
})

// Create a reactive variable to track whether the buttons should be visible
const isButtonsVisible = ref(true)
const isContentVisible = ref(true)
const currentSection = ref('')

// Method to hide the content and buttons after clicking a button
const showContent = (section: string) => {
  currentSection.value = section
  isButtonsVisible.value = false  // Hide buttons
  isContentVisible.value = false // Hide content (title + description)
}
</script>

<template>
  <div class="services-container">
    <!-- Initially visible content (header and description) -->
    <h2 class="title" v-if="isContentVisible">Products and Services</h2>
    <p class="description" v-if="isContentVisible">
      Sta. Lucia Parish Cooperative, we strive to empower our members by offering reliable and <br> 
      accessible financial products and services. Our goal is to help you achieve financial stability, <br> 
      grow your investments, and support the well-being of our community through cooperative <br>
      efforts and shared success. 
    </p>

    <!-- Navigation Buttons (Initially visible) -->
    <div v-if="isButtonsVisible" class="services-buttons">
      <button @click="showContent('loan')" class="service-button loan">
        <div class="icon-container"><i class="fas fa-coins"></i></div>
        <p class="service-title">Loan</p>
        <p class="service-description">Offers a quick and easy way to apply for loans online, anytime.</p>
      </button>
      <button @click="showContent('membership')" class="service-button membership">
        <div class="icon-container"><i class="fas fa-user-plus"></i></div>
        <p class="service-title">Membership</p>
        <p class="service-description">Simplifies joining by allowing digital registration at your convenience.</p>
      </button>
      <button @click="showContent('payment')" class="service-button payment">
        <div class="icon-container"><i class="fas fa-credit-card"></i></div>
        <p class="service-title">Payment</p>
        <p class="service-description">Secure and convenient options to manage and complete your payments with ease.</p>
      </button>
      <button @click="showContent('office')" class="service-button office">
        <div class="icon-container"><i class="fas fa-map-marker-alt"></i></div>
        <p class="service-title">Office</p>
        <p class="service-description">Provides direct assistance and personalized services for all your needs.</p>
      </button>
      <button @click="showContent('products')" class="service-button products">
        <div class="icon-container"><i class="fas fa-box"></i></div>
        <p class="service-title">Products</p>
        <p class="service-description">Offering a variety of everyday essentials such as rice, soap, and other useful items for your daily needs.</p>
      </button>
    </div>

    <!-- Loan Section Content -->
    <div v-if="currentSection === 'loan'" class="service-content">
      <!-- Loan Service Title -->
      <h1 class="loan-title">Loan </h1>
      <p class="loan-description">
        At Sta. Lucia Parish Cooperative, we offer a variety of loan options to help you achieve your financial goals. <br>
        Whether you’re applying for your first loan or renewing an existing one, we make the process straightforward <br>
        and accessible. Our loans come with competitive interest rates, and repayment terms are designed to meet your needs.
      </p>

      <!-- Loan Features -->
      <div class="loan-features">
        <div class="loan-feature">
          <i class="fas fa-clipboard-check"></i>
          <h4>Regular Loan</h4>
          <p>This loan is for qualified members who need financial assistance. You can borrow up to 80% of your share capital.</p>
        </div>
        <div class="loan-feature">
          <i class="fas fa-percent"></i>
          <h4>Interest Rate</h4>
          <p>Competitive interest rates starting at 2.25% on decreasing balances.</p>
        </div>
        <div class="loan-feature">
          <i class="fas fa-calendar-alt"></i>
          <h4>Repayment Terms</h4>
          <p>This loan is for members who need financial assistance. You can borrow up to 50% of your share capital.</p>
        </div>
      </div>

      <!-- How It Works Section (Steps with Image and Text) -->
      <h3 class="how-it-works-title">How It Works?</h3>
      <p class="how-it-works-description">This is a process, how you can get loan for yourself.</p>

      <div class="steps">
        <!-- Step 1 (Image on Left) -->
        <div class="step">
          <div class="step-image">
            <img src="/images/LOAN1.jpg" alt="Step 1 Image" />
          </div>
          <div class="step-text">
            <p>01</p>
            <h4>Log In to Your Account</h4>
            <p>Access your online account using your registered email and password. Make sure your membership status is Regular Member.</p>
          </div>
        </div>

        <!-- Step 2 (Image on Right) -->
        <div class="step reverse">
          <div class="step-text">
            <p>02</p>
            <h4>Go to the Loan Application Page</h4>
            <p>Navigate to the Loan section in your dashboard and click Apply for a Loan to start your application.</p>
          </div>
          <div class="step-image">
            <img src="/images/LOAN2.png" alt="Step 2 Image" />
          </div>
        </div>

        <!-- Step 3 (Image on Left) -->
        <div class="step">
          <div class="step-image">
            <img src="/images/LOAN3.png" alt="Step 3 Image" />
          </div>
          <div class="step-text">
            <p>03</p>
            <h4>Fill Out the Loan Form</h4>
            <p>Select the loan type that suits your needs (e.g., Residential or Production loan). Fill out the required details including loan amount, purpose, and preferred payment terms.</p>
          </div>
        </div>

        <!-- Step 4 (Image on Right) -->
        <div class="step reverse">
          <div class="step-text">
            <p>04</p>
            <h4>Upload Supporting Documents</h4>
            <p>Attach the necessary documents such as your valid ID, income proof, co-maker details (if applicable), or any required collateral based on loan policy.</p>
          </div>
          <div class="step-image">
            <img src="/images/LOAN4.png" alt="Step 4 Image" />
          </div>
        </div>

        <!-- Step 5 (Image on Left) -->
        <div class="step">
          <div class="step-image">
            <img src="/images/LOAN5.png" alt="Step 5 Image" />
          </div>
          <div class="step-text">
            <p>05</p>
            <h4>Submit and Wait for Approval</h4>
            <p>Submit your application. Our team will review it and notify you once your loan is approved.</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Membership Section Content -->
    <div v-if="currentSection === 'membership'" class="service-content">
      <!-- Membership Service Title -->
      <h1 class="membership-title">Membership</h1>
      <p class="membership-description">
        Joining Sta. Lucia Parish Cooperative opens doors to a variety of financial services, including loans, savings <br>
        programs, and more. Our membership process is simple and can be completed online. Here’s how you can <br> 
        apply and start enjoying the benefits of membership.
      </p>

       <!-- Membership Types -->
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
          <p>Available for members who wish to support the cooperative without full participation in the profit-sharing scheme.</p>
        </div>
      </div>

      <!-- Membership Section Content -->
        <div v-if="currentSection === 'membership'" class="service-content">
          <h3 class="how-member-title">How to Become a Member?</h3>
          <p class="how-member-desc">
            Follow these easy steps to complete your membership application.
          </p>

      <div class="steps">
      <!-- Step 1 (Image on Left) -->
      <div class="step">
        <div class="step-image">
          <img src="/images/MEM1.png" alt="Step 1 Image" />
        </div>
        <div class="step-text">
          <p>01</p>
          <h4>Create an Account</h4>
          <p>Start by registering or filling out your basic personal information such as your name, email address, and contact number to set up your online account.</p>
        </div>
      </div>

    <!-- Step 2 (Image on Right) -->
    <div class="step reverse">
      <div class="step-text">
        <p>02</p>
        <h4>Submit Initial Membership Payment</h4>
        <p>Pay a total of ₱3,000 and upload your proof of payment through your account. This includes your share capital, savings deposit, membership fee, and passbook cost to be tagged as an Initial Member.</p>
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
        <p>Our team will carefully review your payment and submission. Once verified, you will receive an official confirmation via email or SMS, and your status will be updated to Initial Member.</p>
      </div>
    </div>

    <!-- Step 4 (Image on Right) -->
    <div class="step reverse">
      <div class="step-text">
        <p>04</p>
        <h4>Upgrade to Regular Membership</h4>
        <p>To become a full Regular Member, submit the required documents through the system and attend the mandatory PMES seminar onsite at the cooperative office.</p>
      </div>
      <div class="step-image">
        <img src="/images/MEM4.png" alt="Step 4 Image" />
      </div>
    </div>

    <!-- Step 5 (Image on Left) -->
    <div class="step">
      <div class="step-image">
        <img src="/images/MEMBER5.png" alt="Step 5 Image" />
      </div>
      <div class="step-text">
        <p>05</p>
        <h4>Get Full Access to Services</h4>
        <p>After completing all the requirements and being approved as a Regular Member, you will receive a verification email, and your account will be granted full access to cooperative services, including loan applications.</p>
      </div>
    </div>
  </div>
</div>


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

.loan-title {
  font-size: 45px;
  color: #EF233C;
  margin-bottom: 2px;
  font-weight: bolder;
  text-align: center;
}

.loan-description {
  font-size: 16px;
  color: #333;
  margin-bottom: 40px;
  text-align: center;
}

.loan-features {
  display: flex;
  justify-content: center;
  gap: 30px;
  margin-bottom: 50px;
}

.loan-feature {
  background-color: white;
  padding: 20px;
  border-radius: 10px;
  text-align: center;
  width: 350px;
  height: 300px;
  border: solid 2px;
}

.loan-feature h4 {
  font-size: 1.2rem;
  font-weight: bold;
  margin-top: 10px;
  margin-bottom: 10px;
  color: #EF233C;
}

.loan-feature p {
  font-size: 0.9rem;
}

.loan-feature i {
  font-size: 4rem;
  color: #EF233C;
  margin-bottom: 15px;
  margin-top: 40px;
}

.how-it-works-title {
  font-size: 2rem;
  color: #EF233C;
  text-align: center;
  font-weight: bolder;
}

.how-it-works-description {
  font-size: 15px;
  color: #333;
  margin-bottom: 40px;
  text-align: center;
  font-weight: 100;
}

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
  color: #EF233C;
}

.step p:last-child {
  font-size: 1rem;
  color: #333;
  font-weight: lighter;
}

.step-image {
  flex: 1;
  text-align: center;
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
  color: #EF233C;
  margin-bottom: 2px;
  font-weight: bolder;
  text-align: center;
}

.membership-description {
  font-size: 16px;
  color: #333;
  margin-bottom: 40px;
  text-align: center;
}

.membership-types {
  display: flex;
  justify-content: center;
  gap: 30px;
  margin-bottom: 50px;
}

.membership-type {
  background-color: white;
  padding: 20px;
  border-radius: 10px;
  text-align: center;
  width: 350px;
  height: 300px;
  border: solid 2px;
}

.membership-type h4 {
  font-size: 1.2rem;
  font-weight: bold;
  margin-top: 10px;
  margin-bottom: 10px;
  color: #EF233C;
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
  color: #EF233C;
  text-align: center;
  font-weight: bolder;
}

.how-member-desc {
  font-size: 15px;
  color: #333;
  margin-bottom: 40px;
  text-align: center;
  font-weight: 100;
}

</style>
