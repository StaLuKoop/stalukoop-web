<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { type BreadcrumbItem } from '@/types'
import { Head } from '@inertiajs/vue3'
import { ref } from 'vue'

const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Dashboard', href: '/member/dashboard' },
  { title: 'Membership Form', href: '/member/requirements/member-application' },
]

const housingChoicePresent = ref(''); // Track the user's housing choice for Present Home Address (Own House, Living w/ Relative, Renting)
const housingChoicePermanent = ref(''); // Track the user's housing choice for Permanent Address (Own House, Living w/ Relative, Renting)

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


// Function to handle form submission
const submitForm = () => {
  // Display confirmation popup
  if (confirm('Are you sure you want to submit the form?')) {
    // Display success message upon confirmation
    alert('Form successfully submitted!');
  }
}
</script>

<template>
  <Head title="Membership Form" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex h-full flex-1 flex-col gap-8 p-6 mx-20">
      <h1 class="text-2xl font-semibold mb-4">Personal Information</h1>

      <!-- Full Name Section -->
      <div class="grid grid-cols-3 gap-6 mb-2">
        <div class="flex flex-col col-span-3">
          <label class="font-medium text-lg mb-2">Full Name</label>
          <div class="flex space-x-6">
            <div class="flex flex-col mb-4 w-1/3">
              <input type="text" placeholder="First Name" class="input border border-gray-300 rounded-lg p-2" />
            </div>
            <div class="flex flex-col mb-4 w-1/3">
              <input type="text" placeholder="Middle Name" class="input border border-gray-300 rounded-lg p-2" />
            </div>
            <div class="flex flex-col mb-4 w-1/3">
              <input type="text" placeholder="Last Name" class="input border border-gray-300 rounded-lg p-2" />
            </div>
          </div>
        </div>
      </div>

      <!-- Civil Status, Gender, Nationality, and No. of Dependents Section -->
      <div class="grid grid-cols-4 gap-6 mb-2">
        <!-- Civil Status -->
        <div class="flex flex-col">
          <label for="civilStatus" class="font-medium text-lg mb-2">Civil Status</label>
          <select id="civilStatus" class="input border border-gray-300 rounded-lg p-2">
            <option value="">Select Civil Status</option>
            <option value="single">Single</option>
            <option value="married">Married</option>
            <option value="widow">Widow</option>
            <option value="separated">Separated</option>
          </select>
        </div>

        <!-- Gender -->
        <div class="flex flex-col">
          <label for="gender" class="font-medium text-lg mb-2">Gender</label>
          <select id="gender" class="input border border-gray-300 rounded-lg p-2">
            <option value="">Select Gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
          </select>
        </div>

        <!-- Nationality -->
        <div class="flex flex-col">
          <label for="nationality" class="font-medium text-lg mb-2">Nationality</label>
          <input type="text" id="nationality" class="input border border-gray-300 rounded-lg p-2" />
        </div>

        <!-- No. of Dependents -->
        <div class="flex flex-col">
          <label for="noOfDependents" class="font-medium text-lg mb-2">No. of Dependents</label>
          <div class="flex flex-col">
            <input type="text" id="children" placeholder="(Children) if applicable" class="input border border-gray-300 rounded-lg p-2 mb-2" />
            <input type="text" id="others" placeholder="Others (Relationship)" class="input border border-gray-300 rounded-lg p-2" />
          </div>
        </div>
      </div>

      <!-- Date of Birth, Age, Place of Birth, and Religion in one row -->
      <div class="grid grid-cols-4 gap-6 mb-2">
        <div class="flex flex-col">
          <label for="dob" class="font-medium text-lg mb-2">Date of Birth</label>
          <input type="date" id="dob" class="input border border-gray-300 rounded-lg p-2" />
        </div>
        <div class="flex flex-col">
          <label for="age" class="font-medium text-lg mb-2">Age</label>
          <input type="number" id="age" class="input border border-gray-300 rounded-lg p-2" />
        </div>
        <div class="flex flex-col">
          <label for="placeOfBirth" class="font-medium text-lg mb-2">Place of Birth</label>
          <input type="text" id="placeOfBirth" class="input border border-gray-300 rounded-lg p-2" />
        </div>
        <div class="flex flex-col">
          <label for="religion" class="font-medium text-lg mb-2">Religion</label>
          <input type="text" id="religion" class="input border border-gray-300 rounded-lg p-2" />
        </div>
      </div>

      <!-- Present Home Address, Housing and Renting Section in one row -->
      <div class="grid grid-cols-4 gap-6 mb-2">
        <div class="flex flex-col col-span-3">
          <label for="presentHomeAddress" class="font-medium text-lg mb-2">Present Home Address</label>
          <input type="text" id="presentHomeAddress" class="input border border-gray-300 rounded-lg p-2" />
        </div>

        <div class="flex flex-col col-span-1">
          <label class="font-medium text-lg mb-2">Housing Status</label>
          <div class="flex space-x-4">
            <label class="flex items-center">
              <input type="radio" name="housing" value="ownHouse" v-model="housingChoicePresent" class="mr-2" /> Own House
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
          <label for="rentingAmount" class="font-medium text-lg mb-2">Renting How Much</label>
          <input type="text" id="rentingAmount" class="input border border-gray-300 rounded-lg p-2" />
        </div>
        <div class="flex flex-col">
          <label for="yearsRenting" class="font-medium text-lg mb-2">No. of Years Renting</label>
          <input type="number" id="yearsRenting" class="input border border-gray-300 rounded-lg p-2" />
        </div>
        <div class="flex flex-col">
          <label for="monthsRenting" class="font-medium text-lg mb-2">No. of Months Renting</label>
          <input type="number" id="monthsRenting" class="input border border-gray-300 rounded-lg p-2" />
        </div>
      </div>

      <!-- Permanent Home Address, Housing and Renting Section in one row -->
      <div class="grid grid-cols-4 gap-6 mb-2">
        <div class="flex flex-col col-span-3">
          <label for="permanentHomeAddress" class="font-medium text-lg mb-2">Permanent Home Address</label>
          <input type="text" id="permanentHomeAddress" class="input border border-gray-300 rounded-lg p-2" />
        </div>

        <div class="flex flex-col col-span-1">
          <label class="font-medium text-lg mb-2">Permanent Housing Status</label>
          <div class="flex space-x-4">
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
          <label for="rentingAmountPermanent" class="font-medium text-lg mb-2">Renting How Much</label>
          <input type="text" id="rentingAmountPermanent" class="input border border-gray-300 rounded-lg p-2" />
        </div>
        <div class="flex flex-col">
          <label for="yearsRentingPermanent" class="font-medium text-lg mb-2">No. of Years Renting</label>
          <input type="number" id="yearsRentingPermanent" class="input border border-gray-300 rounded-lg p-2" />
        </div>
        <div class="flex flex-col">
          <label for="monthsRentingPermanent" class="font-medium text-lg mb-2">No. of Months Renting</label>
          <input type="number" id="monthsRentingPermanent" class="input border border-gray-300 rounded-lg p-2" />
        </div>
      </div>

      <!-- Father Information Section -->
      <div class="grid grid-cols-3 gap-6 mb-2">
        <div class="flex flex-col col-span-3">
          <label class="font-medium text-lg mb-2">Name of Father</label>
          <div class="flex space-x-6">
            <div class="flex flex-col mb-4 w-1/3">
              <input type="text" placeholder="First Name" class="border border-gray-300 rounded-lg p-2" />
            </div>
            <div class="flex flex-col mb-4 w-1/3">
              <input type="text" placeholder="Middle Name" class="border border-gray-300 rounded-lg p-2" />
            </div>
            <div class="flex flex-col mb-4 w-1/3">
              <input type="text" placeholder="Last Name" class="border border-gray-300 rounded-lg p-2" />
            </div>
          </div>
        </div>
      </div>

      <!-- Mother Information Section -->
      <div class="grid grid-cols-3 gap-6 mb-2">
        <div class="flex flex-col col-span-3">
          <label class="font-medium text-lg mb-2">Name of Mother</label>
          <div class="flex space-x-6">
            <div class="flex flex-col mb-4 w-1/3">
              <input type="text" placeholder="First Name" class="border border-gray-300 rounded-lg p-2" />
            </div>
            <div class="flex flex-col mb-4 w-1/3">
              <input type="text" placeholder="Middle Name" class="border border-gray-300 rounded-lg p-2" />
            </div>
            <div class="flex flex-col mb-4 w-1/3">
              <input type="text" placeholder="Last Name" class="border border-gray-300 rounded-lg p-2" />
            </div>
          </div>
        </div>
      </div>
      
      <!-- Contact Information Section -->
      <div class="mb-2">
        <h2 class="font-medium text-lg mb-2">Contact Information</h2>
        <div class="grid grid-cols-4 gap-6">
          <div class="flex flex-col">
            <input type="text" placeholder="Telephone No." class="border border-gray-300 rounded-lg p-2" />
          </div>
          <div class="flex flex-col">
            <input type="text" placeholder="Mobile No." class="border border-gray-300 rounded-lg p-2" />
          </div>
          <div class="flex flex-col">
            <input type="email" placeholder="E-mail Add" class="border border-gray-300 rounded-lg p-2" />
          </div>
          <div class="flex flex-col">
            <input type="text" placeholder="Others (Please Specify)" class="border border-gray-300 rounded-lg p-2" />
          </div>
        </div>
      </div>

      <!-- Government ID Information Section -->
      <div class="mb-2">
        <h2 class="font-medium text-lg mb-2">Government ID's Information</h2>
        <div class="grid grid-cols-4 gap-6">
          <div class="flex flex-col">
            <input type="text" placeholder="Driver's License No." class="border border-gray-300 rounded-lg p-2" />
          </div>
          <div class="flex flex-col">
            <input type="text" placeholder="SSS No." class="border border-gray-300 rounded-lg p-2" />
          </div>
          <div class="flex flex-col">
            <input type="text" placeholder="TIN No." class="border border-gray-300 rounded-lg p-2" />
          </div>
          <div class="flex flex-col">
            <input type="text" placeholder="Others (Please Specify)" class="border border-gray-300 rounded-lg p-2" />
          </div>
        </div>
      </div>

      <!-- Educational Attainment Section -->
      <div class="mb-2">
        <h2 class="font-medium text-lg mb-2">Educational Attainment</h2>
        <div class="flex flex-col">
          <select class="border border-gray-300 rounded-lg p-2">
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
    </div>
    
    <div class="flex h-full flex-1 flex-col gap-8 p-6 mx-20">
    <h1 class="text-2xl font-semibold mb-4">Employment Information</h1>
    <div class="grid grid-cols-2 gap-6">
        <!-- Employer / Business Name -->
        <div class="flex flex-col">
            <label for="employerName" class="mb-2">Employer/Business Name</label>
            <input id="employerName" type="text" placeholder="Name" class="input input-bordered" />
        </div>

        <!-- Employer / Business Address -->
        <div class="flex flex-col">
            <label for="employerAddress" class="mb-2">Employer / Business Address</label>
            <input id="employerAddress" type="text" placeholder="Address" class="input input-bordered" />
        </div>

        <!-- Type of Employment -->
        <div class="flex flex-col">
            <label for="employmentType" class="mb-2">Type of Employment</label>
            <select id="employmentType" class="input input-bordered">
                <option value="private">Private</option>
                <option value="government">Government</option>
                <option value="professional">Professional</option>
                <option value="housewife">Housewife</option>
                <option value="private">Self - Employed</option>
                <option value="government">Unemployed</option>
                <option value="selfEmployed">Retired</option>
                <option value="professional">Others</option>
            </select>
        </div>

        <!-- Employment Status -->
        <div class="flex flex-col">
            <label for="employmentStatus" class="mb-2">Employment Status</label>
            <select id="employmentStatus" class="input input-bordered">
                <option value="permanent">Permanent</option>
                <option value="probationary">Probationary</option>
                <option value="contractual">Contractual</option>
                <option value="professional">Professional</option>
                <option value="consultant">Consultant</option>
                <option value="consultant">Others</option>
            </select>
        </div>

        <!-- Rank -->
        <div class="flex flex-col">
            <label for="rank" class="mb-2">Rank</label>
            <select id="rank" class="input input-bordered">
                <option value="rankFile">Rank & File</option>
                <option value="juniorOfficer">Junior Officer</option>
                <option value="middleManager">Middle Manager</option>
                <option value="seniorExecutive">Senior Executive</option>
                <option value="seniorExecutive">Self - Employed</option>
                <option value="seniorExecutive">Others</option>
            </select>
        </div>

        <!-- Position -->
        <div class="flex flex-col">
            <label for="position" class="mb-2">Position</label>
            <input id="position" type="text" placeholder="Position" class="input input-bordered" />
        </div>

        <!-- Total Years Working -->
        <div class="flex flex-col">
            <label class="mb-2">Total Years Working</label>
            <div class="flex gap-4">
                <input type="number" placeholder="Years" class="input input-bordered" />
                <input type="number" placeholder="Months" class="input input-bordered" />
            </div>
        </div>

        <!-- Immediate Supervisor/HR Contact Person -->
        <div class="flex flex-col">
            <label for="supervisor" class="mb-2">Immediate Supervisor/HR Contact Person</label>
            <input id="supervisor" type="text" placeholder="Name" class="input input-bordered" />
        </div>

        <!-- Office Phone Number -->
        <div class="flex flex-col">
            <label for="officePhone" class="mb-2">Office Phone Number</label>
            <input id="officePhone" type="text" placeholder="Number" class="input input-bordered" />
        </div>

        <!-- Office Email Address -->
        <div class="flex flex-col">
            <label for="officeEmail" class="mb-2">Office Email Address</label>
            <input id="officeEmail" type="email" placeholder="Email Address" class="input input-bordered" />
        </div>
    </div>
  </div>

 <div class="flex h-full flex-1 flex-col gap-8 p-6 mx-20">
    <h1 class="text-2xl font-semibold mb-4">Business Information</h1>
    <div class="grid grid-cols-2 gap-6">
        <!-- Business Name -->
        <div class="flex flex-col">
            <label for="businessName" class="mb-2">Business Name</label>
            <input id="businessName" type="text" placeholder="Name" class="input input-bordered" />
        </div>

        <!-- Business Address -->
        <div class="flex flex-col">
            <label for="businessAddress" class="mb-2">Business Address</label>
            <input id="businessAddress" type="text" placeholder="Address" class="input input-bordered" />
        </div>
    </div>
  </div>

  <div class="flex h-full flex-1 flex-col gap-8 p-6 mx-20">
    <h1 class="text-2xl font-semibold mb-4">Financial Information</h1>
    <div class="grid grid-cols-4 gap-6">
        <!-- Source of Income Funds -->
        <div class="flex flex-col">
            <label for="salary" class="mb-2">Salary</label>
            <input id="salary" type="text" placeholder="Salary" class="input input-bordered" />
        </div>

        <div class="flex flex-col">
            <label for="business" class="mb-2">Business</label>
            <input id="business" type="text" placeholder="Business" class="input input-bordered" />
        </div>

        <div class="flex flex-col">
            <label for="pension" class="mb-2">Pension</label>
            <input id="pension" type="text" placeholder="Pension" class="input input-bordered" />
        </div>

        <div class="flex flex-col">
            <label for="regularRemittance" class="mb-2">Regular Remittance</label>
            <input id="regularRemittance" type="text" placeholder="Regular Remittance" class="input input-bordered" />
        </div>

        <div class="flex flex-col col-span-4">
            <label for="others" class="mb-2">Others (Specify)</label>
            <input id="others" type="text" placeholder="Specify" class="input input-bordered" />
        </div>
    </div>
  </div>

  <div class="flex h-full flex-1 flex-col gap-8 p-6 mx-20">
    <h1 class="text-2xl font-semibold mb-4">Spouse Information</h1>
    <div class="grid grid-cols-4 gap-6">
        <!-- First Name -->
        <div class="flex flex-col">
            <label for="firstName" class="mb-2">First Name</label>
            <input id="firstName" type="text" placeholder="First Name" class="input input-bordered" />
        </div>

        <!-- Middle Name -->
        <div class="flex flex-col">
            <label for="middleName" class="mb-2">Middle Name</label>
            <input id="middleName" type="text" placeholder="Middle Name" class="input input-bordered" />
        </div>

        <!-- Last Name -->
        <div class="flex flex-col">
            <label for="lastName" class="mb-2">Last Name</label>
            <input id="lastName" type="text" placeholder="Last Name" class="input input-bordered" />
        </div>

        <!-- Employer / Business Name -->
        <div class="flex flex-col">
            <label for="employerName" class="mb-2">Employer/Business Name</label>
            <input id="employerName" type="text" placeholder="Employer/Business Name" class="input input-bordered" />
        </div>

        <!-- Employer / Business Address -->
        <div class="flex flex-col col-span-4">
            <label for="employerAddress" class="mb-2">Employer / Business Address</label>
            <input id="employerAddress" type="text" placeholder="Employer/Business Address" class="input input-bordered" />
        </div>
    </div>
</div>

<div class="flex h-full flex-1 flex-col gap-8 p-6 mx-20">
    <div class="flex justify-between items-center mb-4">
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
                <th class="border-b px-4 py-2">Cooperative Membership</th>
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
          <td class="border-b px-4 py-2"><input v-model="member.cooperativeMembership" type="text" placeholder="Membership" class="input input-bordered w-full" /></td>
          <td class="border-b px-4 py-2">
            <!-- Trash button to remove the family member -->
            <button @click="removeFamilyMember(index)" class="text-red-500 text-5xl">
              <i class="fas fa-trash">-</i>
            </button>
          </td>
        </tr>
      </tbody>
    </table>
</div>
    

  <div class="flex h-full flex-1 flex-col gap-8 p-6 mx-20">
    <h1 class="text-2xl font-semibold mb-4">Are you related to any SLPMPC Officers or Employees? If YES, kindly provide the name and relationship:</h1>

    <!-- Name and Relationship Fields -->
    <div class="grid grid-cols-2 gap-6 mb-2">
      <div class="flex flex-col">
        <label for="name" class="font-medium text-lg mb-2">Name</label>
        <input type="text" id="name" placeholder="Name" class="input border border-gray-300 rounded-lg p-2" />
      </div>
      
      <div class="flex flex-col">
        <label for="relationship" class="font-medium text-lg mb-2">Relationship</label>
        <input type="text" id="relationship" placeholder="Relationship" class="input border border-gray-300 rounded-lg p-2" />
      </div>
    </div>
  </div>

  <div class="flex h-full flex-1 flex-col gap-8 p-6 mx-20">
    <h1 class="text-2xl font-semibold mb-4">Private Property</h1>

    <!-- Car Ownership Section -->
    <div class="grid grid-cols-3 gap-6 mb-6">
      <div class="flex flex-col">
        <label class="font-medium text-lg mb-2">Car Ownership</label>
        <div class="flex space-x-4">
          <label class="flex items-center">
            <input type="radio" name="carOwnership" value="yes" class="mr-2" /> Yes
          </label>
          <label class="flex items-center">
            <input type="radio" name="carOwnership" value="no" class="mr-2" /> No
          </label>
          <label class="flex items-center">
            <input type="radio" name="carOwnership" value="owned" class="mr-2" /> Owned
          </label>
        </div>
      </div>

      <!-- Monthly Amortization (Car) -->
      <div class="flex flex-col col-span-2">
        <label class="font-medium text-lg mb-2">Monthly Amortization</label>
        <input type="text" placeholder="P" class="input border border-gray-300 rounded-lg p-2" />
      </div>
    </div>

    <!-- House and Lot Section -->
    <div class="grid grid-cols-3 gap-6 mb-6">
      <div class="flex flex-col">
        <label class="font-medium text-lg mb-2">House and Lot</label>
        <div class="flex space-x-4">
          <label class="flex items-center">
            <input type="radio" name="houseOwnership" value="yes" class="mr-2" /> Yes
          </label>
          <label class="flex items-center">
            <input type="radio" name="houseOwnership" value="no" class="mr-2" /> No
          </label>
          <label class="flex items-center">
            <input type="radio" name="houseOwnership" value="owned" class="mr-2" /> Owned
          </label>
        </div>
      </div>

      <!-- Monthly Amortization (House) -->
      <div class="flex flex-col col-span-2">
        <label class="font-medium text-lg mb-2">Monthly Amortization</label>
        <input type="text" placeholder="P" class="input border border-gray-300 rounded-lg p-2" />
      </div>
    </div>
  </div>
<div class="flex h-full flex-1 flex-col gap-8 p-6 mx-20">
    <h1 class="text-2xl font-semibold mb-4">Expenditures</h1>

    <!-- Income Section -->
    <div class="grid grid-cols-3 gap-6 mb-6">
      <div class="flex flex-col">
        <label for="monthlySalary" class="font-medium text-lg mb-2">Monthly Salary</label>
        <input type="text" id="monthlySalary" placeholder="Monthly Salary" class="input border border-gray-300 rounded-lg p-2" />
      </div>
      <div class="flex flex-col">
        <label for="otherIncome" class="font-medium text-lg mb-2">Other Income</label>
        <input type="text" id="otherIncome" placeholder="Other income" class="input border border-gray-300 rounded-lg p-2" />
      </div>
      <div class="flex flex-col">
        <label for="remittance" class="font-medium text-lg mb-2">Remittance</label>
        <input type="text" id="remittance" placeholder="Remittance" class="input border border-gray-300 rounded-lg p-2" />
      </div>
    </div>

    <!-- Total Income Section -->
    <div class="flex flex-col mb-6">
      <label for="totalIncome" class="font-medium text-lg mb-2">Total Income</label>
      <input type="text" id="totalIncome" placeholder="Total Income" class="input border border-gray-300 rounded-lg p-2" />
    </div>

    <!-- Expenses Section -->
    <div class="grid grid-cols-3 gap-6 mb-6">
      <div class="flex flex-col">
        <label for="food" class="font-medium text-lg mb-2">Food</label>
        <input type="text" id="food" placeholder="Food" class="input border border-gray-300 rounded-lg p-2" />
      </div>
      <div class="flex flex-col">
        <label for="electricBill" class="font-medium text-lg mb-2">Electric Bill</label>
        <input type="text" id="electricBill" placeholder="Electric Bill" class="input border border-gray-300 rounded-lg p-2" />
      </div>
      <div class="flex flex-col">
        <label for="creditCard" class="font-medium text-lg mb-2">Credit Card</label>
        <input type="text" id="creditCard" placeholder="Credit Card" class="input border border-gray-300 rounded-lg p-2" />
      </div>
      <div class="flex flex-col">
        <label for="waterBill" class="font-medium text-lg mb-2">Water Bill</label>
        <input type="text" id="waterBill" placeholder="Water Bill" class="input border border-gray-300 rounded-lg p-2" />
      </div>
      <div class="flex flex-col">
        <label for="cableInternet" class="font-medium text-lg mb-2">Cable/Internet</label>
        <input type="text" id="cableInternet" placeholder="Cable/Internet" class="input border border-gray-300 rounded-lg p-2" />
      </div>
      <div class="flex flex-col">
        <label for="tuitionFee" class="font-medium text-lg mb-2">Tuition Fee</label>
        <input type="text" id="tuitionFee" placeholder="Tuition Fee" class="input border border-gray-300 rounded-lg p-2" />
      </div>
       <div class="flex flex-col">
      <label for="Others" class="font-medium text-lg mb-2">Others:</label>
      <input type="text" id="Others" placeholder="Others" class="input border border-gray-300 rounded-lg p-2" />
      </div>
    </div>

    <!-- Total Expenses Section -->
    <div class="flex flex-col mb-6">
      <label for="totalExpenses" class="font-medium text-lg mb-2">Total Expenses</label>
      <input type="text" id="totalExpenses" placeholder="Total Expenses" class="input border border-gray-300 rounded-lg p-2" />
    </div>

    <!-- Submit Button -->
    <div class="flex justify-end mt-6">
      <button @click="submitForm" class="btn btn-primary bg-blue-500 text-white py-2 px-6 rounded-lg">Submit</button>
    </div>
  </div>

  </AppLayout>
</template>


<style scoped>
.input {
  width: 100%;
  height: 40px; /* Ensure consistent height */
  padding: 10px;
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
