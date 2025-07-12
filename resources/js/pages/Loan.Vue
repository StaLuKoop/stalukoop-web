<script setup lang="ts">
import PublicLayout from '@/layouts/PublicLayout.vue'

defineOptions({
  layout: (h: any, page: any) => h(PublicLayout, { title: 'Contact' }, () => page),
})
</script>
<template>
  <div class="loan-page">
    <!-- Loan Section Content -->
    <div class="service-content">
      <h1 class="loan-title">Loan</h1>
      <p class="loan-description">
        At Sta. Lucia Parish Cooperative, we offer a variety of loan options to help you achieve your financial goals. <br>
        Whether you’re applying for your first loan or renewing an existing one, we make the process straightforward <br>
        and accessible. Our loans come with competitive interest rates, and repayment terms are designed to meet your needs.
      </p>

      <!-- Loan Features Section -->
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

      <!-- How It Works Section -->
      <h3 class="how-it-works-title">How It Works?</h3>
      <p class="how-it-works-description">This is the process of how you can get a loan for yourself.</p>

      <div class="steps">
        <!-- Step 1 -->
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

        <!-- Step 2 -->
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

        <!-- Step 3 -->
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

        <!-- Step 4 -->
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

        <!-- Step 5 -->
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
  </div>
</template>

<style scoped>
.loan-page {
  text-align: center;
  padding: 20px;
}

.loan-title {
  font-size: 45px;
  color: #EF233C;
  margin-bottom: 20px;
  font-weight: bold;
  margin-top: 40px;
}

.loan-description {
  font-size: 16px;
  color: black;
  margin-bottom: 40px;
  text-align: center;
}

.loan-features {
  display: flex;
  justify-content: center;
  gap: 30px;
  margin-bottom: 50px;
  flex-wrap: wrap;
}

.loan-feature {
  background-color: white;
  padding: 20px;
  border-radius: 10px;
  text-align: center;
  width: 350px;
  height: 300px;
  border: solid 2px;
  margin: 10px 0;
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
  font-size: 5rem;
  color: #EF233C;
  margin-bottom: 15px;
  margin-top: 40px;
}

.how-it-works-title {
  font-size: 2rem;
  color: #EF233C;
  text-align: center;
  font-weight: bold;
}

.how-it-works-description {
  font-size: 15px;
  color: black;
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
  flex-wrap: wrap;
}

.step-text {
  flex: 1;
  text-align: left;
}

.step p {
  font-size: 3rem;
  font-weight: bold;
  color: lightgray;
}

.step h4 {
  font-size: 1.5rem;
  font-weight: bold;
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
  margin-bottom: 10px;
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

/* Media Queries for Responsiveness */

/* For tablets and smaller screens */
@media (max-width: 1024px) {
  .loan-title {
    font-size: 2.5rem;
  }

  .loan-description {
    font-size: 1rem;
  }

  .loan-features {
    gap: 20px;
  }

  .loan-feature {
    width: 280px;
    height: 250px;
  }

  .loan-feature i {
    font-size: 4rem;
  }

  .how-it-works-title {
    font-size: 1.8rem;
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

  .step-image img {
    max-width: 250px;
    height: 220px;
  }
}

/* For mobile phones */
@media (max-width: 768px) {
  .loan-title {
    font-size: 2rem;
  }

  .loan-description {
    font-size: 0.9rem;
  }

  .loan-features {
    flex-direction: column;
    align-items: center;
  }

  .loan-feature {
    width: 90%;
    margin-bottom: 20px;
  }

  .loan-feature i {
    font-size: 3rem;
  }

  .how-it-works-title {
    font-size: 1.5rem;
  }

  .steps {
    gap: 20px;
  }

  .step {
    gap: 20px;
    flex-direction: column;
  }

  .step p {
    font-size: 2rem;
  }

  .step h4 {
    font-size: 1.2rem;
  }

  .step-image img {
    max-width: 200px;
    height: 180px;
  }
}

</style>
