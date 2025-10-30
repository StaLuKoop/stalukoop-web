<script setup lang="ts">
import { ref } from 'vue'
import AppLayout from '@/layouts/AppLayout.vue'
import { type BreadcrumbItem } from '@/types'
import { Head } from '@inertiajs/vue3'

defineProps<{ status: string }>()

const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Dashboard', href: '/member/dashboard' },
  { title: 'Loan Application', href: '/member/services/loan-application' },
]

// Reactive reference to control the visibility of "Other" collateral description
const showOtherCollateral = ref(false);

// Method to toggle visibility of "Other" collateral input field
const handleCollateralChange = (event: Event) => {
  const selectedValue = (event.target as HTMLSelectElement).value;
  showOtherCollateral.value = selectedValue === 'other';
}
</script>



<template>
  <Head title="Loan Application" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="form-container">
      <!-- Pending Membership Section (commented out) -->
      <!--
      <template v-if="status === 'pending'">
        <div class="pending-section">
          <h2 class="text-lg font-semibold">Membership Pending</h2>
          <p>Your membership is still pending approval. To proceed with a loan application, please complete the following requirements:</p>
          <ul class="list-inside list-disc space-y-1">
            <li>Attend the PMES (Pre-Membership Education Seminar)</li>
            <li>Fill out and submit the Membership Application Form</li>
            <li>Submit a valid government-issued ID</li>
            <li>Pay the initial membership fee</li>
          </ul>
          <p>You may fill out the membership form online: <a href="/member/requirements/membership-form" class="ml-1 text-blue-700 underline hover:text-blue-900">Complete Member Form</a></p>
          <p class="text-sm italic">For further assistance, please contact the cooperative office.</p>
        </div>
      </template>
      -->

      <!-- Loan Application Form for Approved Members -->
      <template v-if="status === 'pending'">
        <h1 class="section-title">Loan Application</h1>

        <form action="/submit-loan-application" method="POST" class="form-space">
          <!-- Personal Information Section -->
          <div class="space-y-4">
            <label class="input-label">Full Name</label><br>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
              <div>
                <input type="text" id="first-name" name="first_name" required class="input-field w-full" placeholder="First Name" />
              </div>

              <div>
                <input type="text" id="middle-name" name="middle_name" class="input-field w-full" placeholder="Middle Name" />
              </div>

              <div>
                <input type="text" id="last-name" name="last_name" required class="input-field w-full" placeholder="Last Name" />
              </div>
            </div>
          </div>

          <!-- Contact and Address -->
          <div class="space-y-4">
            <div class="flex items-center space-x-4">
              <div>
                <label for="contact-no" class="input-label">Contact No.</label>
                <input type="text" id="contact-no" name="contact_no" required class="input-field w-50" />
              </div>

              <div class="md:col-span-2">
                <label for="address" class="input-label">Address</label>
                <input type="text" id="address" name="address" required class="input-field w-200" />
              </div>

              <div class="md:col-span-1">
                <label for="residence-duration" class="input-label">Residency Duration</label>
                <input type="text" id="residence-duration" name="residence_duration" required class="input-field w-40 " />
              </div>

             <div class="md:w-2/1">
              <label for="ownership" class="input-label">Housing Status</label>
              <select name="ownership" id="ownership" required class="input-field w-full">
                <option value="own_house">Own House</option>
                <option value="living_with_relatives">Living with Relatives</option>
                <option value="renting">Renting</option>
              </select>
            </div>
            </div>
          </div>
          
          <!-- Membership, Capital, Type of Loan -->
        <div class="space-y-4">
          <div class="grid grid-cols-1 md:grid-cols-3 gap-15"> <!-- Adjusted gap to 6 -->

            <!-- Share Capital and Savings Section -->
            <div class="flex flex-col space-y-2">
              <label class="input-label">Current Investment</label>
              <div class="flex items-center space-x-4">
                <span class="w-42">Share Capital</span>
                <input type="text" class="input-field w-full" placeholder="Enter amount" />
              </div>
              <div class="flex items-center space-x-4">
                <span class="w-42">Savings</span>
                <input type="text" class="input-field w-full" placeholder="Enter amount" />
              </div>
            </div>

            <!-- Loan Type Section -->
            <div class="flex flex-col space-y-2">
              <label class="input-label">Type of Loan</label>
              <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-2">
                  <input type="radio" name="loan_type" value="productive" class="radio-input" />
                  <span class="w-42">Productive Loan</span>
                </div>
                <div class="flex items-center space-x-2">
                  <input type="radio" name="loan_type" value="providential" class="radio-input" />
                  <span class="w-42">Providential Loan</span>
                </div>
              </div>
                <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-2">
                  <input type="radio" name="loan_type" value="emergency" class="radio-input" />
                  <span class="w-42">Emergency Loan</span>
                </div>
                <div class="flex items-center space-x-3">
                  <span>Other/s</span>
                  <input type="text" name="other_loan_type" placeholder="Enter other loan type" class="input-field w-50" />
                </div>
              </div>
            </div>

            <!-- Membership Type Section -->
            <div class="flex flex-col space-y-2">
              <label class="input-label">Type of Membership:</label>
              <div class="flex items-center space-x-4">
                <input type="radio" name="ownership" value="owner" class="radio-input" />
                <span>Regular Member</span>
              </div>
              <div class="flex items-center space-x-4">
                <input type="radio" name="ownership" value="tenant" class="radio-input" />
                <span>Associate Member</span>
              </div>
            </div>          
          </div>
        </div>

        <!-- Loan Information Section -->
        <div class="space-y-4">
          <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Halagang Hihihramin -->
            <div>
              <label for="contact-no" class="input-label">Loan Amount</label>
              <input type="text" id="contact-no" name="contact_no" required class="input-field w-full" placeholder="₱" />
            </div>

            <!-- Tagal ng Pagbayad -->
            <div>
              <label for="address" class="input-label">Loan Term</label>
              <select id="loan-term" name="loan_term" required class="input-field w-full" >
                <option value="1-month">1 month</option>
                <option value="3-months">3 months</option>
                <option value="6-months">6 months</option>
                <option value="monthly">1 year</option>
              </select>
            </div>

            <!-- Paraan ng Pagbabayad -->
            <div>
              <label for="residence-duration" class="input-label">Paraan ng Pagbabayad</label>
              <select id="payment-method" name="payment_method" required class="input-field w-full">
                <option value="monthly">Monthly</option>
                <option value="weekly">Weekly</option>
                <option value="bi-weekly">15th & 30th of the Month</option>
                <option value="daily">Everyday</option>
              </select>
            </div>
          </div>
        </div>

        <!-- Collateral and Guarantor Information -->
        <div class="space-y-4">
          <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Collateral Type -->
            <div>
              <label for="contact-no" class="input-label">Collateral Type</label>
              <input type="text" id="contact-no" name="contact_no" required class="input-field w-full" placeholder="e.g., property, vehicle, appliance" />
            </div>

            


            <!-- Collateral Document Section -->
          <div class="space-y-4">
            <label for="collateral-document" class="input-label">Collateral Document</label>
            <select id="collateral-document" name="collateral_document" @change="handleCollateralChange" required class="input-field w-full">
              <option value="or-cr-franchise">OR/CR and Franchise (Vehicle)</option>
              <option value="land-title">Land Title</option>
              <option value="or-cr-only">OR/CR Only (Vehicle)</option>
              <option value="pdc">PDC (Post-Dated Check)</option>
              <option value="atm">ATM Card</option>
              <option value="other">Other (Please Specify)</option>
            </select>
          </div>

          <!-- 'Other' Collateral Description Field -->
          <div v-if="showOtherCollateral" class="space-y-4">
            <label for="other-collateral-description" class="input-label">Please specify the collateral document</label>
            <input type="text" id="other-collateral-description" name="other_collateral_description" class="input-field w-full"  />
          </div>

            <div>
              <label for="contact-no" class="input-label">Collateral Value</label>
              <input type="text" id="contact-no" name="contact_no" required class="input-field w-70" placeholder="₱" />
            </div>
            
            
          </div>
        </div>

        <!-- Guarantor Information -->
        <div class="space-y-4">
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
              <label for="contact-no" class="input-label">Guarantor Name</label>
              <input type="text" id="contact-no" name="contact_no" required class="input-field w-full" placeholder="Enter guarantor's name"/>
            </div>

            <div>
              <label for="contact-no" class="input-label">Guarantor Contact</label>
              <input type="text" id="contact-no" name="contact_no" required class="input-field w-full" placeholder="Enter guarantor's contact number" />
            </div>
          </div>
        </div>

        <div class="space-y-4">
        <div>
          <label for="savings-purpose" class="input-label">Is your savings intended for building your asset base or for the purpose of taking a loan?</label>
          <div class="flex items-center space-x-4">
            <input type="radio" name="savings_purpose" value="asset_growth" required class="radio-input" />
            <span>Yes, my savings are for asset growth</span>
          </div>
          <div class="flex items-center space-x-4">
            <input type="radio" name="savings_purpose" value="loan_purpose" required class="radio-input" />
            <span>No, my savings are only for the purpose of taking a loan</span>
          </div>
        </div>
      </div>


          <!-- Submit Section -->
          <div class="submit-container">
            <button type="submit" class="submit-button">Submit</button>
          </div>
        </form>
      </template>
    </div>
  </AppLayout>
</template>

<style scoped>
/* Custom Tailwind CSS styles for the Loan Application form */

/* Form container */
.form-container {
  padding: 1.5rem;
  margin: 0 auto;
  max-width: 95%;
  overflow-x: hidden; /* Prevents horizontal scrolling */
}

/* Section Titles */
.section-title {
  font-size: 2rem;
  font-weight: 600;
  margin-bottom: 1rem;
  margin-top: 0.5rem;
  text-align: center;
}

/* Section Labels */
.section-label {
  font-size: 1rem;
  font-weight: 500;
  color: #4a5568;
}

/* Adjust the label and input alignment */
.form-container .input-label {
  display: inline-block;
  margin-bottom: 10px;
  margin-top: 10px;
  font-size: 16px;
  font-weight: bold;
}

/* Input Fields */
.input-field {
  padding: 5px;
  border: 1px solid #cbd5e0;
  border-radius: 0.375rem;
  font-size: 1rem;
  transition: all 0.2s ease-in-out;
  margin-bottom: 15px;
  height: 40px;
}

.input-field:focus {
  border-color: #4c51bf;
  outline: none;
  box-shadow: 0 0 0 2px rgba(75, 85, 99, 0.3);
}

/* Radio Button Inputs */
.radio-input {
  height: 1rem;
  width: 1rem;
  color: #4c51bf;
}

/* Checkbox Inputs */
.checkbox-input {
  height: 1rem;
  width: 1rem;
  color: #4c51bf;
}

/* Submit Button */
.submit-button {
  padding: 0.75rem 2rem;
  background-color: #DA251C;
  border: none;
  color: white;
  border-radius: 0.375rem;
  cursor: pointer;
  transition: all 0.3s ease-in-out;
}

.submit-button:hover {
  background-color: lightcoral;
}

.submit-button:focus {
  outline: none;
  box-shadow: 0 0 0 2px rgba(75, 85, 99, 0.3);
}

/* Submit Button Alignment */
.submit-container {
  display: flex;
  justify-content: flex-end;
  margin-top: 0.5rem;
}
</style>
