<script setup lang="ts">
import { ref, watch, onMounted } from 'vue';
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

// Track the selected employment type
const employmentType = ref<string>('');

// Track the income options for each employment type
const permanentJobIncome = ref('');
const businessIncome = ref('');
const pensionerIncome = ref('');
const contractualIncome = ref('');
const selfEmployedIncome = ref('');
const governmentIncome = ref('');
const housewifeUnemployedIncome = ref('no-income');

// Define the type of the sections object
interface EmploymentSections {
  permanentJob: boolean;
  business: boolean;
  pensioner: boolean;
  contractual: boolean;
  selfEmployed: boolean;
  government: boolean;
  housewifeUnemployed: boolean;
}

// Initialize employmentSections as a ref with the correct type
const employmentSections = ref<EmploymentSections>({
  permanentJob: false,
  business: false,
  pensioner: false,
  contractual: false,
  selfEmployed: false,
  government: false,
  housewifeUnemployed: false,
});

// Watch employmentType changes to update the display of relevant sections
watch(employmentType, (value) => {
  // Reset all sections to hidden
  for (let key in employmentSections.value) {
    employmentSections.value[key as keyof EmploymentSections] = false;
  }

  // Show relevant section based on selected employment type
  switch (value) {
    case 'permanent-job':
      employmentSections.value.permanentJob = true;
      break;
    case 'business':
      employmentSections.value.business = true;
      break;
    case 'pensioner':
    case 'retired':
      employmentSections.value.pensioner = true;
      break;
    case 'contractual-minimum':
    case 'contractual-piece-rate':
      employmentSections.value.contractual = true;
      break;
    case 'self-employed':
      employmentSections.value.selfEmployed = true;
      break;
    case 'government':
      employmentSections.value.government = true;
      break;
    case 'housewife':
    case 'unemployed':
      employmentSections.value.housewifeUnemployed = true;
      break;
  }
});

// Track the phone number input
const phone = ref('');

// Method to sanitize the mobile number
const sanitizePhone = (event: Event) => {
  const input = event.target as HTMLInputElement;
  let value = input.value;

  // Only allow numbers and "+"
  value = value.replace(/[^0-9+]/g, ''); // Remove any non-numeric and non "+" characters

  // Ensure the value starts with "+63"
  if (value.startsWith('+63')) {
    input.value = value; // If it starts with +63, keep it
  } else {
    input.value = '+63'; // Otherwise, default to +63
  }


  if (input.value.length > 13) {
    input.value = input.value.slice(0, 13);
  }

  // Update the model with the sanitized value
  phone.value = input.value;
};

onMounted(() => {
  const collateralYes = document.getElementById('collateral-yes') as HTMLInputElement | null;
  const collateralNo = document.getElementById('collateral-no') as HTMLInputElement | null;

  const collateralInfo = document.getElementById('collateral-info') as HTMLElement | null;
  const guarantorInfo = document.getElementById('guarantor-info') as HTMLElement | null;

  const collateralDocument = document.getElementById('collateral-document') as HTMLSelectElement | null;
  const otherCollateral = document.getElementById('other-collateral') as HTMLElement | null;

  const uploadCollateral = document.getElementById('upload-collateral-document') as HTMLElement | null;
  const uploadInput = document.getElementById('collateral-document-upload') as HTMLInputElement | null;

  const guarantorTableBody = document.getElementById('guarantorTableBody') as HTMLTableSectionElement | null;
  const addRowButton = document.getElementById('add-row-button') as HTMLButtonElement | null;

  // Helpers
  const show = (el?: HTMLElement | null) => { if (el) el.style.display = 'block'; };
  const hide = (el?: HTMLElement | null) => { if (el) el.style.display = 'none'; };

  const requireUpload = (required: boolean) => {
    if (!uploadInput) return;
    if (required) uploadInput.setAttribute('required', '');
    else uploadInput.removeAttribute('required');
    if (!required) uploadInput.value = ''; // clear when turning off
  };

  // --- Radio change handlers ---
  collateralYes?.addEventListener('change', () => {
    show(collateralInfo);
    hide(guarantorInfo);
    show(uploadCollateral);
    requireUpload(true);
  });

  collateralNo?.addEventListener('change', () => {
    hide(collateralInfo);
    show(guarantorInfo);
    hide(uploadCollateral);
    requireUpload(false);
    // Optional: also hide "Other" field when switching to No
    hide(otherCollateral);
  });

  // --- Collateral "Other" select toggle ---
  collateralDocument?.addEventListener('change', (e) => {
    const target = e.target as HTMLSelectElement;
    if (target.value === 'other') show(otherCollateral);
    else hide(otherCollateral);
  });

  // --- Add guarantor row ---
  addRowButton?.addEventListener('click', () => {
    if (!guarantorTableBody) return;
    const row = document.createElement('tr');
    row.innerHTML = `
      <td class="border px-4 py-2">
        <input type="text" name="guarantor_name[]" class="w-full border border-gray-300 rounded p-2" placeholder="Enter name" required />
      </td>
      <td class="border px-4 py-2">
        <input type="text" name="guarantor_contact[]" class="w-full border border-gray-300 rounded p-2" placeholder="Enter contact" required />
      </td>
      <td class="border px-4 py-2 text-center">
        <button type="button" class="btn-remove-guarantor text-red-500 hover:text-red-700" aria-label="Remove guarantor row">
          <i class="fas fa-trash"></i>
        </button>
      </td>
    `;
    guarantorTableBody.appendChild(row);
  });

  // --- Remove guarantor row (event delegation, works for all future rows) ---
  guarantorTableBody?.addEventListener('click', (e) => {
    const target = e.target as HTMLElement;
    const removeBtn = target.closest('.btn-remove-guarantor') as HTMLButtonElement | null;
    if (removeBtn) {
      const tr = removeBtn.closest('tr');
      tr?.remove();
    }
  });

  // --- Initial state on load (handles pre-checked radios & existing values) ---
  const init = () => {
    // Radios
    if (collateralYes?.checked) {
      show(collateralInfo); hide(guarantorInfo); show(uploadCollateral); requireUpload(true);
    } else if (collateralNo?.checked) {
      hide(collateralInfo); show(guarantorInfo); hide(uploadCollateral); requireUpload(false);
    } else {
      // Default hidden until user chooses
      hide(collateralInfo); hide(uploadCollateral); requireUpload(false);
    }
    // "Other" select
    if (collateralDocument?.value === 'other') show(otherCollateral);
    else hide(otherCollateral);
  };
  init();
});



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
          <h1 class="text-2xl font-semibold mb-[5px]">Personal Information</h1>
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
                  <div class="md:col-span-2">
                <label for="contact-no" class="input-label">Mobile Number</label>
                <input 
                  type="tel" 
                  id="mobile"
                  name="contact_no"
                  placeholder="+63XXXXXXXXX"
                  class="input-field w-50"
                  v-model="phone"
                  @input="sanitizePhone"
                  required
                />
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

    <div class="space-y-4">
    <div class="grid grid-cols-2 gap-2 mb-2">
        <div class="flex flex-col mb-[-5px]">
            <label for="employerName" class="input-label">Employer/Business Name</label>
            <input id="employerName" type="text" placeholder="Name" class="input-field input-bordered" />
        </div>

        <div class="flex flex-col mb-[-5px]">
            <label for="employerAddress" class="input-label">Employer / Business Address</label>
            <input id="employerAddress" type="text" placeholder="Address" class="input-field input-bordered" />
        </div>

        <!-- Type of Employment -->
        <div class="flex flex-col mb-[-5px]">
            <label for="employmentType" class="input-label">Type of Employment</label>
            <select id="employment-type" name="employment-type" v-model="employmentType" required class="input-field input-bordered">
              <option value="">Select Employment Type</option>
              <option value="permanent-job">Permanent Job</option>
              <option value="business">Business</option> 
              <option value="contractual-minimum">Contractual (Minimum 3 years)</option>
              <option value="contractual-piece-rate">Contractual, Piece Rate, On Call Basis</option>
              <option value="housewife">Housewife</option> 
              <option value="self-employed">Self-Employed</option>
              <option value="government">Government</option>
              <option value="unemployed">Unemployed</option> 
              <option value="retired">Retired</option> 
          </select>
        </div>

        <!-- Permanent Job -->
        <div v-show="employmentType === 'permanent-job'" class="flex flex-col">
            <label for="permanent-job-income" class="input-label">Years of Experience & Net Income</label>
            <select id="permanent-job-income" name="permanent-job-income" required class="input-field input-bordered">
                <option value="more-than-15-years-16k-20k">More than 15 years with net income of at least ₱16,000 to ₱20,000</option>
                <option value="less-than-10-years-11k-15k">Less than 10 years with net income of at least ₱11,000 to ₱15,000</option>
                <option value="less-than-5-years-6k-10k">Less than 5 years with net income of at least ₱6,000 to ₱10,000</option>
                <option value="less-than-5-years-5k-below">Less than 5 years with net income of at least ₱5,000 and below</option>
            </select>
        </div>

        <!-- Business -->
        <div v-show="employmentType === 'business'" class="flex flex-col">
            <label for="business-income" class="input-label">Monthly Net Income</label>
            <select id="business-income" name="business-income" required class="input-field input-bordered">
                <option value="16k-20k">Monthly net income of at least ₱16,000 to ₱20,000</option>
                <option value="11k-15k">Monthly net income of at least ₱11,000 to 15,000</option>
                <option value="10k">Monthly net income of at least ₱10,000</option>
                <option value="5k-below">Monthly net income of ₱5,000 and below</option>
            </select>
        </div>

        <!-- Pensioner / Retired (Same Options) -->
        <div v-show="employmentType === 'pensioner' || employmentType === 'retired'" class="flex flex-col">
            <label for="pensioner-retired-income" class="input-label">Pension</label>
            <select id="pensioner-retired-income" name="pensioner-retired-income" required class="input-field input-bordered">
                <option value="above-20k">Above ₱20,000</option>
                <option value="15k-19k">₱15,000 to 19,000</option>
                <option value="6k-14k">₱6,000 to ₱14,000</option>
                <option value="3k-5k-below">₱3,000 to ₱5,000 and below</option>
                <option value="2k-below">₱2,000 and below</option>
            </select>
        </div>

        <!-- Contractual -->
        <div v-show="employmentType === 'contractual-minimum' || employmentType === 'contractual-piece-rate'"class="flex flex-col">
            <label for="contractual-income" class="input-label">Income Level</label>
            <select id="contractual-income" name="contractual-income" required class="input-field input-bordered">
                <option value="minimum-pay">Minimum pay</option>
                <option value="below-minimum">Below minimum</option>
            </select>
        </div>

        <!-- Self-Employed -->
        <div v-show="employmentType === 'self-employed'" class="flex flex-col">
            <label for="self-employed-income" class="input-label">Monthly Net Income</label>
            <select id="self-employed-income" name="self-employed-income" required class="input-field input-bordered">
                <option value="16k-20k">Monthly net income of at least ₱16,000 to ₱20,000</option>
                <option value="11k-15k">Monthly net income of at least ₱11,000 to ₱15,000</option>
                <option value="10k">Monthly net income of at least ₱10,000</option>
                <option value="5k-below">Monthly net income of ₱5,000 and below</option>
            </select>
        </div>

        <!-- Government -->
        <div v-show="employmentType === 'government'"class="flex flex-col">
            <label for="government-income" class="input-label">Monthly Salary Range</label>
            <select id="government-income" name="government-income" required class="input-field input-bordered">
                <option value="20k-above">Above ₱20,000</option>
                <option value="15k-19k">₱15,000 to ₱19,000</option>
                <option value="10k-14k">₱10,000 to ₱14,000</option>
                <option value="below-10k">Below ₱10,000</option>
            </select>
        </div>

        <!-- Unemployed / Housewife (Same Options) -->
        <div v-show="employmentType === 'housewife' || employmentType === 'unemployed'" class="flex flex-col">
            <label for="housewife-unemployed-income" class="input-label">Income Status</label>
            <select id="housewife-unemployed-income" name="housewife-unemployed-income" required class="input-field input-bordered">
                <option value="no-income">No income</option>
            </select>
        </div>

        
    </div>
  </div>
          <h1 class="text-2xl font-semibold mb-[5px] mt-10">Loan Information</h1>
          <!-- Membership, Capital, Type of Loan -->
          <div class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-5"> <!-- 4 columns on medium screens and above -->
              
              <!-- Share Capital and Savings Section -->
              <div class="flex flex-col">
                <label class="input-label">Share Capital</label>
                <input type="text" class="input-field w-full" placeholder="Enter amount" />
              </div>

              <div class="flex flex-col">
                <label class="input-label">Savings</label>
                <input type="text" class="input-field w-full" placeholder="Enter amount" />
              </div>

              <!-- Loan Type Section -->
              <div class="flex flex-col">
                <label class="input-label">Type of Loan</label>
                <select class="input-field w-full">
                  <option value="regular">Regular Loan</option>
                </select>
              </div>

              <!-- Membership Type Section -->
              <div class="flex flex-col">
                <label class="input-label">Type of Membership:</label>
                <select name="ownership" class="input-field w-full">
                  <option value="owner">Regular Member</option>
                  <option value="tenant">Associate Member</option>
                </select>
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
                <option value="monthly">2 years</option>
                <option value="monthly">3 years</option>
              </select>
            </div>

            <!-- Paraan ng Pagbabayad -->
            <div>
              <label for="residence-duration" class="input-label">Method of Payment</label>
              <select id="payment-method" name="payment_method" required class="input-field w-full">
                <option value="monthly">Monthly</option>
                <option value="weekly">Weekly</option>
                <option value="bi-weekly">15th & 30th of the Month</option>
                <option value="daily">Everyday</option>
              </select>
            </div>
          </div>
        </div>
  
        <h1 class="text-2xl font-semibold mb-[1px] mt-6 ">Loan Security</h1>
        <div class="flex flex-col space-y-2">
          <label for="collateral-question" class="input-label">Will you be providing collateral for this loan?</label>
          
          <!-- Collateral Option -->
          <div class="flex items-center space-x-4">
            <input type="radio" name="collateral_type" value="collateral" required class="radio-input" id="collateral-yes" />
            <span>Yes, I will provide collateral</span>
          </div>
          
          <!-- Non-Collateral Option -->
          <div class="flex items-center space-x-4">
            <input type="radio" name="collateral_type" value="non_collateral" required class="radio-input" id="collateral-no" />
            <span>No, I will not provide collateral</span>
          </div>
        </div>

        <!-- Collateral Information (only visible if 'Yes' is selected) -->
        <div id="collateral-info" class="space-y-4" style="display: none;">
          <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Collateral Type -->
            <div>
              <label for="collateral-type" class="input-label">Collateral Type</label>
              <input type="text" id="collateral-type" name="collateral_type" required class="input-field w-full" placeholder="e.g., property, vehicle, appliance" />
            </div>

            <!-- Collateral Document Section -->
            <div class="space-y-4">
              <label for="collateral-document" class="input-label">Collateral Document</label>
              <select id="collateral-document" name="collateral_document" required class="input-field w-full">
                <option value="or-cr-franchise">OR/CR and Franchise (Vehicle)</option>
                <option value="land-title">Land Title</option>
                <option value="or-cr-only">OR/CR Only (Vehicle)</option>
                <option value="pdc">PDC (Post-Dated Check)</option>
                <option value="atm">ATM Card</option>
                <option value="other">Other (Please Specify)</option>
              </select>
            </div>

            <!-- 'Other' Collateral Description Field -->
            <div id="other-collateral" class="space-y-4" style="display: none;">
              <label for="other-collateral-description" class="input-label">Please specify the collateral document</label>
              <input type="text" id="other-collateral-description" name="other_collateral_description" class="w-full border border-gray-300 rounded p-2" />
            </div>

            <!-- Collateral Value -->
            <div>
              <label for="collateral-value" class="input-label">Collateral Value</label>
              <input type="text" id="collateral-value" name="collateral_value" required class="w-full border border-gray-300 rounded p-2 w-70" placeholder="₱" />
            </div>
          </div>

          <!-- Document Upload Section (Visible only if 'Yes' is selected) -->
          <div id="upload-collateral-document" class="space-y-4" style="display: none; ">
            <label for="collateral-document-upload" class="input-label">Upload Collateral Document</label>
            <input type="file" id="collateral-document-upload" name="collateral_document_upload" class="w-full border border-gray-300 rounded p-2" />
            <span class="text-sm text-gray-500">Acceptable file formats: PDF, JPG, PNG, DOCX</span>
          </div>
        </div>

        <!-- Guarantor Information (only visible if 'No' is selected) -->
        <div id="guarantor-info" style="display: none;">
          <h2 class="text-lg font-semibold mb-2 mt-5">Guarantor Information</h2>
          <table id="guarantorTable" class="table-auto w-full border-collapse border">
            <thead>
              <tr class="bg-gray-100">
                <th class="border px-4 py-2 text-lg" required>Guarantor Name</th>
                <th class="border px-4 py-2 text-lg" required>Guarantor Contact</th>
                <th class="border px-4 py-2 w-20">
                  <button type="button" id="add-row-button" class="btn-add">+</button>
                </th>
              </tr>
            </thead>
            <tbody id="guarantorTableBody">
              <tr>
                <td class="border px-4 py-2">
                  <input type="text" name="guarantor_name[]" class="w-full border border-gray-300 rounded p-2" placeholder="Enter name" required />
                </td>
                <td class="border px-4 py-2">
                  <input type="text" name="guarantor_contact[]" class="w-full border border-gray-300 rounded p-2" placeholder="Enter contact" required />
                </td>
                <td class="border px-4 py-2 text-center">
                  <button type="button" class="btn-remove-guarantor text-red-500 hover:text-red-700">
                    <i class="fas fa-trash"></i>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>


        <!-- Guarantor Information (only visible if 'No' is selected) -->
        <div id="guarantor-info"style="display: none;">
          <h2 class="text-lg font-semibold mb-2 mt-5">Guarantor Information</h2>

          <table id="guarantorTable" class="table-auto w-full border-collapse border">
            <thead>
              <tr class="bg-gray-100">
                <th class="border px-4 py-2 text-lg">Guarantor Name</th>
                <th class="border px-4 py-2 text-lg">Guarantor Contact</th>
                <th class="border px-4 py-2 w-20">
                  <button type="button" id="add-row-button" class="btn-add">+</button>
                </th>
              </tr>
            </thead>
            <tbody id="guarantorTableBody">
              <tr>
                <td class="border px-4 py-2">
                  <input type="text" name="guarantor_name[]" class="w-full border border-gray-300 rounded p-2" placeholder="Enter name" required />
                </td>
                <td class="border px-4 py-2">
                  <input type="text" name="guarantor_contact[]" class="w-full border border-gray-300 rounded p-2" placeholder="Enter contact" required />
                </td>
                <td class="border px-4 py-2 text-center">
                  <button type="button" class="btn-remove-guarantor text-red-500 hover:text-red-700">
                    <i class="fas fa-trash"></i>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>



        <div class="space-y-4">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-5"> <!-- Two columns on medium screens and above -->

            <!-- Savings Purpose Section -->
            <div class="flex flex-col">
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

            <!-- Health Condition Impact Section -->
            <div class="flex flex-col">
              <label for="health-condition-impact" class="input-label">Will the member’s health condition affect loan status in the future?</label>
              <div class="flex items-center space-x-4">
                <input type="radio" name="health_condition_impact" value="yes" required class="radio-input" />
                <span>Yes</span>
              </div>
              <div class="flex items-center space-x-4">
                <input type="radio" name="health_condition_impact" value="no" required class="radio-input" />
                <span>No</span>
              </div>
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

/* Style for add and remove buttons */
.btn-add, .btn-remove {
  color: #DA251C;
  border: none;
  font-size: 26px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.fas {
  font-size: 16px; /* Adjust icon size */
  transition: transform 0.3s ease; /* Smooth transition for icon size change */
}

.btn-add:hover .fas, .btn-remove:hover .fas {
  transform: scale(1.2); /* Slightly enlarge the icon on hover */
}
</style>
