<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { type BreadcrumbItem } from '@/types'
import { Head } from '@inertiajs/vue3'
import { ref, watch } from 'vue';
import { router } from '@inertiajs/vue3'
import axios from 'axios'

const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Dashboard', href: '/member/dashboard' },
  { title: 'Membership Form', href: '/member/requirements/member-application' },
]

const housingChoicePresent = ref(''); // Track the user's housing choice for Present Home Address (Own House, Living w/ Relative, Renting)
const housingChoicePermanent = ref(''); // Track the user's housing choice for Permanent Address (Own House, Living w/ Relative, Renting)
const maritalStatus = ref(''); // Track the selected marital status
const carOwnership = ref(''); // Tracks Car Ownership selection
const houseOwnership = ref(''); // Tracks House Ownership selection

// Create a reactive array to store family members' data
const familyMembers = ref([
  {
    name: '',
    gender: '',
    relationship: '',
    maritalStatus: '',
    educationAttainment: '',
    occupation: '',
    cooperativeMembership: ''
  }
])

// Function to add a new family member to the array
const addFamilyMember = () => {
  familyMembers.value.push({
    name: '',
    gender: '',
    relationship: '',
    maritalStatus: '',
    educationAttainment: '',
    occupation: '',
    cooperativeMembership: ''
  })
}

// Function to remove a family member from the array
const removeFamilyMember = (index: number) => {
  familyMembers.value.splice(index, 1)
}

const rentingAmountPermanent = ref(''); // For storing the renting amount input

// Method to format the input as currency
const formatCurrency = () => {
  let value = rentingAmountPermanent.value;

  // Remove any non-numeric characters except for the decimal point
  value = value.replace(/[^\d.]/g, '');

  // Limit to two decimal places
  const [whole, decimal] = value.split('.');  
  if (decimal && decimal.length > 2) {
    value = `${whole}.${decimal.slice(0, 2)}`;
  }

  // Format value as currency (e.g., ₱1,234.56)
  rentingAmountPermanent.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
};


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

// Declare dob and age as reactive variables
const dob = ref('');  // For binding the user's date of birth input
const age = ref(0);   // For storing the calculated age

// Method to calculate age based on dob
const calculateAge = () => {
  if (dob.value) {
    const birthDate = new Date(dob.value);
    const today = new Date();
    let calculatedAge = today.getFullYear() - birthDate.getFullYear();
    const monthDifference = today.getMonth() - birthDate.getMonth();

    // Adjust if the birthday hasn't occurred yet this year
    if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birthDate.getDate())) {
      calculatedAge--;
    }

    age.value = calculatedAge;
  }
};

// Watch for changes in dob to recalculate age
watch(dob, calculateAge);

const monthlyAmortization = ref('') // For storing and formatting the amortization input

// Method to format the amortization input as currency
const formatCurrencyCar = () => {
  let value = monthlyAmortization.value

  // Remove any non-numeric characters except for the decimal point
  value = value.replace(/[^\d.]/g, '')

  // Limit to two decimal places
  const [whole, decimal] = value.split('.')
  if (decimal && decimal.length > 2) {
    value = `${whole}.${decimal.slice(0, 2)}`
  }

  // Format as currency with commas
  monthlyAmortization.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ',')
}

const monthlyAmortizationHouse = ref('') // For storing the amortization input

// Method to format the house amortization input as currency
const formatCurrencyHouse = () => {
  let value = monthlyAmortizationHouse.value

  // Remove any non-numeric characters except the decimal
  value = value.replace(/[^\d.]/g, '')

  // Limit to two decimal places
  const [whole, decimal] = value.split('.')
  if (decimal && decimal.length > 2) {
    value = `${whole}.${decimal.slice(0, 2)}`
  }

  // Add commas for thousands
  monthlyAmortizationHouse.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ',')
} 

const submitForm = async () => {
  const formData = {
    marital_status: maritalStatus.value,
    housing_choice_present: housingChoicePresent.value,
    housing_choice_permanent: housingChoicePermanent.value,
    car_ownership: carOwnership.value,
    house_ownership: houseOwnership.value,
    employment_type: employmentType.value,
  }

  await axios.post('/member/membership-form', formData)
}



// ADD: helpers (no UI changes)
const mapHousing = (v: string) =>
  v === 'ownHouse' ? 'own_house'
  : v === 'livingWithRelative' ? 'living_with_relative'
  : v === 'renting' ? 'renting'
  : ''

const moneyToNumber = (v: string | number | null) => {
  if (v == null) return null
  const n = String(v).replace(/[₱,\s]/g, '')
  return n === '' ? null : Number(n)
}

const toNull = (v: string | null | undefined) => (v === '' || v == null ? null : v)


</script>

<template>
  <Head title="Membership Form" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <form @submit.prevent="submitForm">
    <div class="flex h-full flex-1 flex-col gap-8 p-6 mx-7">
      <h1 class="text-2xl font-semibold mb-[-20px]">Personal Information</h1>

      <!-- Full Name Section -->
      <div class="grid grid-cols-3 gap-6 mb-[-30px]">
        <div class="flex flex-col col-span-3">
          <label class="input-label">Full Name</label>
          <div class="flex space-x-6">
            <div class="flex flex-col mb-4 w-1/3">
              <input type="text" name="first_name"placeholder="First Name" class="input border border-gray-300 rounded-lg p-2" required />
            </div>
            <div class="flex flex-col mb-4 w-1/3">
              <input type="text" name="middle_name" placeholder="Middle Name" class="input border border-gray-300 rounded-lg p-2" required />
            </div>
            <div class="flex flex-col mb-4 w-1/3">
              <input type="text" name="last_name" placeholder="Last Name" class="input border border-gray-300 rounded-lg p-2" required />
            </div>
          </div>
        </div>
      </div>

      <!-- Civil Status, Gender, Nationality, and No. of Dependents Section -->
      <div class="grid grid-cols-4 gap-6 mb-[-30px]">
        <!-- Civil Status -->
        <div class="flex flex-col">
          <label for="civilStatus" class="input-label">Civil Status</label>
          <select id="civilStatus" v-model="maritalStatus" class="input border border-gray-300 rounded-lg p-2" required>
            <option value="">Select Civil Status</option>
            <option value="single">Single</option>
            <option value="married">Married</option>
            <option value="widow">Widow</option>
            <option value="separated">Separated</option>
          </select>
        </div>

        <!-- Gender -->
        <div class="flex flex-col">
          <label for="gender" class="input-label" required>Gender</label>
          <select id="gender" name="gender" class="input border border-gray-300 rounded-lg p-2">
            <option value="">Select Gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
          </select>
        </div>

        <!-- Nationality -->
        <div class="flex flex-col">
          <label for="nationality" class="input-label" required>Nationality</label>
          <input type="text" name="nationality" id="nationality" class="input border border-gray-300 rounded-lg p-2" />
        </div>

        <!-- No. of Dependents -->
        <div class="flex flex-col">
          <label for="noOfDependents" class="input-label">No. of Dependents</label>
          <div class="flex flex-col">
            <input type="text" name="dependents_children" id="children" placeholder="(Children) if applicable" class="input border border-gray-300 rounded-lg p-2 mb-2" />
            <input type="text"  name="dependents_others_text" id="others" placeholder="Others (Relationship)" class="input border border-gray-300 rounded-lg p-2" />
          </div>
        </div>
      </div>

       <!-- Date of Birth, Age, Place of Birth, and Religion in one row -->
        <div class="grid grid-cols-4 gap-6 mb-[-10px]">
          <div class="flex flex-col">
            <label for="dob" class="input-label" required>Date of Birth</label>
            <input
              type="date"
              id="dob"
              v-model="dob" 
              class="input border border-gray-300 rounded-lg p-2"
              name="dob"
            />
          </div>

          <div class="flex flex-col">
            <label for="age" class="input-label">Age</label>
            <input
              type="text"
              id="age"
              :value="`${age} years old`"  
              class="input border border-gray-300 rounded-lg p-2"
              readonly 
            />
          </div>

          <div class="flex flex-col">
            <label for="placeOfBirth" class="input-label" required>Place of Birth</label>
            <input
              type="text"
              id="placeOfBirth"
              class="input border border-gray-300 rounded-lg p-2"
              name="dob"
            />
          </div>

          <div class="flex flex-col">
            <label for="religion" class="input-label" required>Religion</label>
            <input
              type="text"
              id="religion"
              class="input border border-gray-300 rounded-lg p-2"
              name="religion"
            />
          </div>
        </div>


      <!-- Present Home Address, Housing and Renting Section in one row -->
      <div class="grid grid-cols-3 gap-6 mb-[-20px]">
        <div class="flex flex-col col-span-2">
          <label for="presentHomeAddress" class="input-label">Present Home Address</label>
          <input type="text" name="address_present" id="presentHomeAddress" class="input border border-gray-300 rounded-lg p-2" required />
        </div>

        <div class="flex flex-col col-span-1">
          <label class="input-label">Housing Status</label>
          <div class="flex space-x-4" required>
            <label class="flex items-center">
              <input type="radio" name="housing" value="ownHouse" v-model="housingChoicePresent" class="mr-2"  /> Own House
            </label>
            <label class="flex items-center">
              <input type="radio" name="housing" value="livingWithRelative" v-model="housingChoicePresent" class="mr-2" /> Living w/ Relative
            </label>
            <label class="flex items-center">
              <input type="radio" name="housing" value="renting" v-model="housingChoicePresent" class="mr-2" /> Renting
            </label>
          </div>
        </div>
      </div>

      <!-- Renting Fields (shown only if Renting is selected) -->
      <div v-if="housingChoicePresent === 'renting'" class="grid grid-cols-3 gap-6 mb-2">
        <div class="flex flex-col">
        <label for="rentingAmountPermanent" class="input-label" >Renting How Much</label>
        <input
          type="text"
          id="rentingAmountPermanent"
          class="input border border-gray-300 rounded-lg p-2"
          v-model="rentingAmountPermanent"
          @input="formatCurrency"
          placeholder="₱0.00"
          :required="housingChoicePermanent === 'renting'"
          inputmode="decimal"
          autocomplete="off"
          pattern="^\d{1,3}(,\d{3})*(\.\d{1,2})?$"
        />
      </div>
        <div class="flex flex-col">
          <label for="yearsRenting" class="input-label">No. of Years Renting</label>
          <input type="number" id="yearsRenting" class="input border border-gray-300 rounded-lg p-2" required />
        </div>
        <div class="flex flex-col">
          <label for="monthsRenting" class="input-label">No. of Months Renting</label>
          <input type="number" id="monthsRenting" class="input border border-gray-300 rounded-lg p-2"required />
        </div>
      </div>

      <!-- Permanent Home Address, Housing and Renting Section in one row -->
      <div class="grid grid-cols-3 gap-6 mb-[-10px]">
        <div class="flex flex-col col-span-2">
          <label for="permanentHomeAddress" class="input-label">Permanent Home Address</label>
          <input type="text" name="address_permanent" id="permanentHomeAddress" class="input border border-gray-300 rounded-lg p-2" required/>
        </div>

        <div class="flex flex-col col-span-1">
          <label class="input-label">Permanent Housing Status</label>
          <div class="flex space-x-4" required>
            <label class="flex items-center">
              <input type="radio" name="housingPermanent" value="ownHouse" v-model="housingChoicePermanent" class="mr-2" /> Own House
            </label>
            <label class="flex items-center">
              <input type="radio" name="housingPermanent" value="livingWithRelative" v-model="housingChoicePermanent" class="mr-2" /> Living w/ Relative
            </label>
            <label class="flex items-center">
              <input type="radio" name="housingPermanent" value="renting" v-model="housingChoicePermanent" class="mr-2" /> Renting
            </label>
          </div>
        </div>
      </div>

      <!-- Renting Fields for Permanent Address (shown only if Renting is selected) -->
      <div v-if="housingChoicePermanent === 'renting'" class="grid grid-cols-3 gap-6 mb-2">
        <div class="flex flex-col">
        <label for="rentingAmountPermanent" class="input-label">Renting How Much</label>
        <input
          type="text"
          id="rentingAmountPermanent"
          class="input border border-gray-300 rounded-lg p-2"
          :required="housingChoicePermanent === 'renting'"
          v-model="rentingAmountPermanent"
          @input="formatCurrency"
          placeholder="₱0.00"
        />
      </div>

        <div class="flex flex-col">
          <label for="yearsRentingPermanent" class="input-label">No. of Years Renting</label>
          <input type="number" id="yearsRentingPermanent" class="input border border-gray-300 rounded-lg p-2" required/>
        </div>
        <div class="flex flex-col">
          <label for="monthsRentingPermanent" class="input-label">No. of Months Renting</label>
          <input type="number" id="monthsRentingPermanent" class="input border border-gray-300 rounded-lg p-2" required/>
        </div>
      </div>

      <!-- Father Information Section -->
      <div class="grid grid-cols-3 gap-6 mb-[-30px]">
        <div class="flex flex-col col-span-3">
          <label class="input-label">Name of Father</label>
          <div class="flex space-x-6">
            <div class="flex flex-col mb-4 w-1/3">
              <input type="text" placeholder="First Name" class="input border border-gray-300 rounded-lg p-2" required />
            </div>
            <div class="flex flex-col mb-4 w-1/3">
              <input type="text" placeholder="Middle Name" class="input border border-gray-300 rounded-lg p-2" required/>
            </div>
            <div class="flex flex-col mb-4 w-1/3">
              <input type="text" placeholder="Last Name" class="input border border-gray-300 rounded-lg p-2" required/>
            </div>
          </div>
        </div>
      </div>

      <!-- Mother Information Section -->
      <div class="grid grid-cols-3 gap-6 mb-[-30px]">
        <div class="flex flex-col col-span-3">
          <label class="input-label">Name of Mother</label>
          <div class="flex space-x-6">
            <div class="flex flex-col mb-4 w-1/3">
              <input type="text" placeholder="First Name" class="input border border-gray-300 rounded-lg p-2" required/>
            </div>
            <div class="flex flex-col mb-4 w-1/3">
              <input type="text" placeholder="Middle Name" class="input border border-gray-300 rounded-lg p-2" required/>
            </div>
            <div class="flex flex-col mb-4 w-1/3">
              <input type="text" placeholder="Last Name" class="input border border-gray-300 rounded-lg p-2" required />
            </div>
          </div>
        </div>
      </div>
      
      <!-- Contact Information Section -->
      <div class="mb-[-20px]">
        <h2 class="input-label">Contact Information</h2>
        <div class="grid grid-cols-4 gap-6">
          <div class="flex flex-col">
            <input type="number" name="landline" placeholder="e.g., (02) 1234 5678" class="border border-gray-300 rounded-lg p-2" />
          </div>
          <div class="flex flex-col">
            <input type="number" name="mobile" placeholder="e.g., +63 912 345 6789" class="border border-gray-300 rounded-lg p-2" required />
          </div>
          <div class="flex flex-col">
            <input type="email" name="email" placeholder="Enter your email address" class="border border-gray-300 rounded-lg p-2" required />
          </div>
          <div class="flex flex-col">
            <input type="text" name="other_contact" placeholder="Others (Please Specify)" class="border border-gray-300 rounded-lg p-2" />
          </div>
        </div>
      </div>

      <!-- Government ID Information Section -->
      <div class="mb-[-20px]">
        <h2 class="input-label">Government ID's Information</h2>
        <div class="grid grid-cols-4 gap-6">
          <div class="flex flex-col">
            <input type="text" name="drivers_license_no" placeholder="Driver's License No." class="border border-gray-300 rounded-lg p-2" />
          </div>
          <div class="flex flex-col">
            <input type="text" name="sss_no" placeholder="SSS No." class="border border-gray-300 rounded-lg p-2" />
          </div>
          <div class="flex flex-col">
            <input type="text" name="tin_no" placeholder="TIN No." class="border border-gray-300 rounded-lg p-2" />
          </div>
          <div class="flex flex-col">
            <input type="text" name="other_id_type" placeholder="Others (Please Specify)" class="border border-gray-300 rounded-lg p-2" required/>
          </div>
        </div>
      </div>

      <!-- Educational Attainment Section -->
      <div class="mb-2">
        <h2 class="input-label">Educational Attainment</h2>
        <div class="flex flex-col">
          <select class="border border-gray-300 rounded-lg p-2" name="highest_education" r required>
            <option value="">Select Educational Attainment</option>
            <option value="collegeDegree">College Degree</option>
            <option value="associateDegree">Associate Degree</option>
            <option value="postGraduate">Post Graduate</option>
            <option value="elementaryDegree">Elementary Degree</option>
            <option value="highSchoolGraduate">High School Graduate</option>
            <option value="noFormalSchooling">No Formal Schooling</option>
          </select>
        </div>
      </div>
    
    <div>
    <h1 class="text-2xl font-semibold mb-5">Employment Information</h1>
    <div class="grid grid-cols-2 gap-6 mb-2">
        <div class="flex flex-col mb-[-10px]">
            <label for="employerName" class="input-label">Employer/Business Name</label>
            <input id="employerName" name="employer_or_business_name" type="text" placeholder="Name" class="input input-bordered" required />
        </div>

        <div class="flex flex-col mb-[-10px]">
            <label for="employerAddress" class="input-label">Employer / Business Address</label>
            <input id="employerAddress" name="employer_or_business_address" type="text" placeholder="Address" class="input input-bordered" required/>
        </div>

        <!-- Type of Employment -->
        <div class="flex flex-col mb-5">
            <label for="employmentType" class="input-label">Type of Employment</label>
            <select id="employment-type" name="employment-type" v-model="employmentType" required class="input input-bordered">
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
            <select id="permanent-job-income" name="income_band" required class="input input-bordered">
                <option value="more-than-15-years-16k-20k">More than 15 years with net income of at least ₱16,000 to ₱20,000</option>
                <option value="less-than-10-years-11k-15k">Less than 10 years with net income of at least ₱11,000 to ₱15,000</option>
                <option value="less-than-5-years-6k-10k">Less than 5 years with net income of at least ₱6,000 to ₱10,000</option>
                <option value="less-than-5-years-5k-below">Less than 5 years with net income of at least ₱5,000 and below</option>
            </select>
        </div>

        <!-- Business -->
        <div v-show="employmentType === 'business'" class="flex flex-col">
            <label for="business-income" class="input-label">Monthly Net Income</label>
            <select id="business-income" name="income_band" required class="input input-bordered">
                <option value="16k-20k">Monthly net income of at least ₱16,000 to ₱20,000</option>
                <option value="11k-15k">Monthly net income of at least ₱11,000 to 15,000</option>
                <option value="10k">Monthly net income of at least ₱10,000</option>
                <option value="5k-below">Monthly net income of ₱5,000 and below</option>
            </select>
        </div>

        <!-- Pensioner / Retired (Same Options) -->
        <div v-show="employmentType === 'pensioner' || employmentType === 'retired'" class="flex flex-col">
            <label for="pensioner-retired-income" class="input-label">Pension</label>
            <select id="pensioner-retired-income" name="income_band" required class="input input-bordered">
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
            <select id="contractual-income" name="income_band" required class="input input-bordered">
                <option value="minimum-pay">Minimum pay</option>
                <option value="below-minimum">Below minimum</option>
            </select>
        </div>

        <!-- Self-Employed -->
        <div v-show="employmentType === 'self-employed'" class="flex flex-col">
            <label for="self-employed-income" class="input-label">Monthly Net Income</label>
            <select id="self-employed-income" name="income_band" required class="input input-bordered">
                <option value="16k-20k">Monthly net income of at least ₱16,000 to ₱20,000</option>
                <option value="11k-15k">Monthly net income of at least ₱11,000 to ₱15,000</option>
                <option value="10k">Monthly net income of at least ₱10,000</option>
                <option value="5k-below">Monthly net income of ₱5,000 and below</option>
            </select>
        </div>

        <!-- Government -->
        <div v-show="employmentType === 'government'"class="flex flex-col">
            <label for="government-income" class="input-label">Monthly Salary Range</label>
            <select id="government-income" name="income_band" required class="input input-bordered">
                <option value="20k-above">Above ₱20,000</option>
                <option value="15k-19k">₱15,000 to ₱19,000</option>
                <option value="10k-14k">₱10,000 to ₱14,000</option>
                <option value="below-10k">Below ₱10,000</option>
            </select>
        </div>

        <!-- Unemployed / Housewife (Same Options) -->
        <div v-show="employmentType === 'housewife' || employmentType === 'unemployed'" class="flex flex-col">
            <label for="housewife-unemployed-income" class="input-label">Income Status</label>
            <select id="housewife-unemployed-income" name="income_band" required class="input input-bordered">
                <option value="no-income">No income</option>
            </select>
        </div>

        
    </div>
  </div>

  <div v-if="maritalStatus === 'married'">
  <h1 class="text-2xl font-semibold mb-5">Spouse Information</h1>
  <div class="grid grid-cols-3 gap-6">
    <!-- First Name -->
    <div class="flex flex-col">
      <label for="firstName" class="input-label">First Name</label>
      <input id="firstName" name="spouse_first_name" type="text" placeholder="First Name" class="input input-bordered" required/>
    </div>

    <!-- Middle Name -->
    <div class="flex flex-col">
      <label for="middleName" class="input-label">Middle Name</label>
      <input id="middleName" name="spouse_middle_name" type="text" placeholder="Middle Name" class="input input-bordered" required/>
    </div>

    <!-- Last Name -->
    <div class="flex flex-col">
      <label for="lastName" class="input-label">Last Name</label>
      <input id="lastName" type="text" name="spouse_last_name" placeholder="Last Name" class="input input-bordered" required />
    </div>
  </div>
  <div class="grid grid-cols-2 gap-6">
    <!-- Employer / Business Name -->
    <div class="flex flex-col">
      <label for="employerName" class="input-label">Employer/Business Name</label>
      <input id="employerName" type="text" name="spouse_employer_name" placeholder="Employer/Business Name" class="input input-bordered" required/>
    </div>

    <!-- Employer / Business Address -->
    <div class="flex flex-col">
      <label for="employerAddress" class="input-label">Employer / Business Address</label>
      <input id="employerAddress"  name="spouse_employer_address" type="text" placeholder="Employer/Business Address" class="input input-bordered" required/>
    </div>
  </div>
</div>

    <div>
    <div class="flex justify-between items-center mb-5">
        <h1 class="text-2xl font-semibold">Family Information</h1>
         <!-- Icon button to add a new family member -->
        <button @click="addFamilyMember" class="btn1 bg-transparent p-2 border border-green-500 text-green-500 rounded-lg flex items-center text-3xl">
          +
        </button>
    </div>
    
    <!-- Family Information Table -->
    <table id="familyTable" class="table-auto w-full border-collapse">
        <thead>
            <tr>
                <th class="border-b px-4 py-2">Name</th>
                <th class="border-b px-4 py-2">Gender</th>
                <th class="border-b px-4 py-2">Relationship to Member</th>
                <th class="border-b px-4 py-2">Marital Status</th>
                <th class="border-b px-4 py-2">Education Attainment</th>
                <th class="border-b px-4 py-2">Occupation/Income</th>
                <th class="border-b px-4 py-2"></th>
            </tr>
        </thead>
         <tbody>
        <!-- Loop through the familyMembers array and display data dynamically -->
        <tr v-for="(member, index) in familyMembers" :key="index">
          <td class="border-b px-4 py-2"><input v-model="member.name" type="text" placeholder="Name" class="input input-bordered w-full" /></td>
          <td class="border-b px-4 py-2"><input v-model="member.gender" type="text" placeholder="Gender" class="input input-bordered w-full" /></td>
          <td class="border-b px-4 py-2"><input v-model="member.relationship" type="text" placeholder="Relationship" class="input input-bordered w-full" /></td>
          <td class="border-b px-4 py-2"><input v-model="member.maritalStatus" type="text" placeholder="Status" class="input input-bordered w-full" /></td>
          <td class="border-b px-4 py-2"><input v-model="member.educationAttainment" type="text" placeholder="Attainment" class="input input-bordered w-full" /></td>
          <td class="border-b px-4 py-2"><input v-model="member.occupation" type="text" placeholder="Occupation" class="input input-bordered w-full" /></td>
          <td class="border-b px-4 py-2">
            <!-- Trash button to remove the family member -->
            <button @click="removeFamilyMember(index)" class="text-red-500 text-xl">
              <i class="fas fa-trash"></i>
            </button>
          </td>
        </tr>
      </tbody>
    </table>
</div>
    
      
  <!-- Relation to SLPMPC Officers or Employees Section -->
    <div>
      <h1 class="text-1 font-semibold mb-5">Are you related to any SLPMPC Officers or Employees? If YES, kindly provide the name and relationship:</h1>
      <div class="grid grid-cols-2 gap-6 mb-5">
        <div class="flex flex-col">
          <label for="name" class="input-label">Name</label>
          <input type="text" name="related_name_officer" id="name" placeholder="Name" class="input border border-gray-300 rounded-lg p-2" />
        </div>
        
        <div class="flex flex-col">
          <label for="relationship" class="input-label">Relationship</label>
          <input type="text"  name="relationship_officer" id="relationship" placeholder="Relationship" class="input border border-gray-300 rounded-lg p-2" />
        </div>
      </div>
    </div>

  <!-- Private Property Section -->
    <div>
      <h1 class="text-2xl font-semibold mb-5">Private Property</h1>

      <!-- Car Ownership Section -->
  <div class="grid grid-cols-2 gap-6 mb-5">
    <div class="flex flex-col">
    <label class="input-label">Car Ownership</label>
    <div class="flex space-x-4"required>
      <label class="flex items-center">
        <input type="radio"  name="car_ownership"  value="yes" v-model="carOwnership" class="mr-2" /> Yes
      </label>
      <label class="flex items-center">
        <input type="radio"  name="car_ownership"  value="no" v-model="carOwnership" class="mr-2" /> No
      </label>
      <label class="flex items-center">
        <input type="radio"  name="car_ownership"  value="owned" v-model="carOwnership" class="mr-2" /> Owned
      </label>
    </div>

    <!-- Monthly Amortization (Car) - Show only if "Yes" is selected for Car Ownership -->
    <div v-if="carOwnership === 'yes'" class="flex flex-col col-span-2">
      <label class="input-label mt-2">Monthly Amortization</label>
      <input
        type="text"
        placeholder="₱"
        v-model="monthlyAmortization"
        @input="formatCurrencyCar"
        :required="carOwnership === 'yes'"
        class="input border border-gray-300 rounded-lg p-2"
      />
    </div>
  </div>

    <div class="flex flex-col">
    <label class="input-label">House and Lot</label>
    <div class="flex space-x-4"required >
      <label class="flex items-center">
        <input type="radio" name="house_ownership" value="yes" v-model="houseOwnership" class="mr-2" /> Yes
      </label>
      <label class="flex items-center">
        <input type="radio" name="house_ownership" value="no" v-model="houseOwnership" class="mr-2" /> No
      </label>
      <label class="flex items-center">
        <input type="radio" name="house_ownership" value="owned" v-model="houseOwnership" class="mr-2" /> Owned
      </label>
    </div>

    <!-- Show Monthly Amortization only if "Yes" is selected -->
    <div v-if="houseOwnership === 'yes'" class="flex flex-col col-span-2">
      <label class="input-label mt-2">Monthly Amortization</label>
      <input
        type="text"
        placeholder="₱"
        v-model="monthlyAmortizationHouse"
        :required="houseOwnership === 'yes'"
        @input="formatCurrencyHouse"
        class="input border border-gray-300 rounded-lg p-2"
      />
    </div>
  </div>
</div>
</div>

    <!-- Expenditures Section -->
    <div>
      <h1 class="text-2xl font-semibold mb-5">Monthly Expenses</h1>
      

      <!-- Expenses Section -->
      <div class="grid grid-cols-4 gap-6 mb-[-20px]">
        <div class="flex flex-col">
          <label for="food" class="input-label">Food</label>
          <input type="number" id="food" name="food" placeholder="Food" class="input border border-gray-300 rounded-lg p-2" required />
        </div>
        <div class="flex flex-col">
          <label for="electricBill" class="input-label">Electric Bill</label>
          <input type="number" id="electricBill" name="electric_bill" placeholder="Electric Bill" class="input border border-gray-300 rounded-lg p-2" required />
        </div>
        <div class="flex flex-col">
          <label for="creditCard" class="input-label">Credit Card</label>
          <input type="number" id="creditCard" name="credit_card"  placeholder="Credit Card" class="input border border-gray-300 rounded-lg p-2"  />
        </div>
        <div class="flex flex-col">
          <label for="waterBill" class="input-label">Water Bill</label>
          <input type="number" id="waterBill" name="water_bill"  placeholder="Water Bill" class="input border border-gray-300 rounded-lg p-2" required />
        </div>
        <div class="flex flex-col">
          <label for="cableInternet" class="input-label">Cable/Internet</label>
          <input type="number" id="cableInternet" name="cable_internet" placeholder="Cable/Internet" class="input border border-gray-300 rounded-lg p-2" />
        </div>
        <div class="flex flex-col">
          <label for="tuitionFee" class="input-label">Tuition Fee</label>
          <input type="number" id="tuitionFee" name="tuition_fee"  placeholder="Tuition Fee" class="input border border-gray-300 rounded-lg p-2" />
        </div>
        <div class="flex flex-col">
          <label for="Others" class="input-label">Others</label>
          <input type="number" id="Others" name="others_exp"placeholder="Others" class="input border border-gray-300 rounded-lg p-2" />
        </div>
        <div class="flex flex-col mb-[-20px]">
        <label for="totalExpenses" class="input-label">Total Expenses</label>
        <input type="number" id="totalExpenses" placeholder="Total Expenses" class="input border border-gray-300 rounded-lg p-2" required />
      </div>
      </div>
      
    <!-- Submit Button -->
    <div class="flex justify-end mt-6">
        <button @click="submitForm" class="btn">Submit</button>
    </div>
  </div>
  </div>
</form>
  </AppLayout>
</template>


<style scoped>
.input-label {
  font-size: 16px;
  font-weight: 500;
  margin-bottom: 10px;
  color: #000;
}

.input {
  width: 100%;
  height: 40px; /* Ensure consistent height */
  padding: 5px;
  border: 1px solid #d1d5db;
  border-radius: 0.375rem;
  font-size: 1rem;
}

.checkbox {
  width: 20px;
  height: 20px;
  margin-top: 10px;
}

.btn1 {
  padding: 0.75rem 2rem;
  background-color: white;
  border: none;
  color: #DA251C;
  border-radius: 0.375rem;
  cursor: pointer;
}

.btn {
  padding: 0.75rem 2rem;
  background-color: #DA251C;
  border: none;
  color: white;
  border-radius: 0.375rem;
  cursor: pointer;
}

.btn:hover {
  background-color: lightcoral;
}

.mx-4 {
  margin-left: 16px;
  margin-right: 16px;
}
</style>
