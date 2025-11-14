<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { type BreadcrumbItem } from '@/types'
import { Head } from '@inertiajs/vue3'

const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Dashboard', href: '/member/dashboard' },
  { title: 'Policy', href: '/member/cooperative/policy' },  // Adjusted breadcrumb path
]
</script>

<template>
  <Head title="Loan Policy" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <h1  class="text-3xl font-semibold mt-8 ml-10 mb-4">Sta. Lucia Parish Credit Cooperative Policies</h1>
    <!-- Table of Contents Section -->
    <div class="container mx-auto p-5">
      <h1 class="text-3xl font-semibold mb-4">Table of Contents</h1>
      <a href="#membership-policy" class="text-blue-500 hover:underline">A. Membership Policy</a>
      <ul class="list-disc pl-6">
        
        <!-- Membership Policy Links -->
        <li><a href="#membership-requirements" class="text-blue-500 hover:underline">Membership Requirements</a></li>
        <li><a href="#membership-qualification" class="text-blue-500 hover:underline">Membership Qualification</a></li>
        <li><a href="#rights-privileges" class="text-blue-500 hover:underline">Rights and Privileges</a></li>
        <li><a href="#duties-responsibilities" class="text-blue-500 hover:underline">Duties and Responsibilities</a></li>
        <li><a href="#termination-membership" class="text-blue-500 hover:underline">Termination of Membership</a></li>
     </ul><br>
     <a href="#loan-policy" class="text-blue-500 hover:underline">B. Loan Policy</a>
     <!-- Loan Policy Links -->
     <ul class="list-disc pl-6">   
        <li><a href="#loan-types" class="text-blue-500 hover:underline">Loan Types</a></li>
        <li><a href="#eligibility" class="text-blue-500 hover:underline">Eligibility</a></li>
        <li><a href="#loan-details" class="text-blue-500 hover:underline">Loan Details</a></li>
        <ul class="list-disc pl-6">
            <li><a href="#loan_max" class="text-blue-500 hover:underline">Maximum Loan Amount</a></li>
            <li><a href="#deductions" class="text-blue-500 hover:underline">Regular Deductions</a></li>
            <li><a href="#interest" class="text-blue-500 hover:underline">Interest</a></li>
            <li><a href="#payment" class="text-blue-500 hover:underline">Payment Options</a></li>
            <li><a href="#maturity" class="text-blue-500 hover:underline">Loan Maturity</a></li>
        </ul>
        <li><a href="#loan-evaluation" class="text-blue-500 hover:underline">Loan Evaluation Criteria</a></li>
        <li><a href="#extension" class="text-blue-500 hover:underline">Extension and Deferment of Loan Payment</a></li>
        <li><a href="#penalty" class="text-blue-500 hover:underline">Penalty for Late Payments</a></li>
        <li><a href="#important-notes" class="text-blue-500 hover:underline">Important Notes</a></li>
      </ul>
    </div>

    <div class="container mx-auto p-5">
      <h1 id="membership-policy" class="text-3xl font-semibold mb-4">Membership Policy</h1>

            <div class="space-y-4">
        <h2 id="membership-requirements" class="text-xl font-semibold mt-4">Membership Requirements</h2>
        <p>To become a Regular Member of the Sta. Lucia Parish Credit Cooperative, applicants must meet the following requirements:</p>
        <ul class="list-disc pl-6">
          <li>Attend the Pre-Membership Education Seminar (PMES) </li>
          <li>Submit Membership Form along with needed documents and payment proof.</li>
          <li><strong> Share Capital: ₱2,000</strong></li>
          This amount serves as your ownership in the cooperative. It makes you a co-owner and entitles you to benefits such as dividends, voting rights, and eligibility to apply for loans.<br></br>
          The amount of your share capital also affects how much you can borrowthe higher your share capital, the larger your possible loan amount.
          <li><strong> Savings Deposit: ₱500</strong></li>
          This acts as your starting savings in the cooperative. It helps promote financial discipline among members and can also serve as a basis for future loan applications.<br></br>
          Like your share capital, your total savings are also considered when determining your loan eligibility.
          <li><strong> Membership Fee: ₱200</strong></li>
          This is a one-time payment for registration and administrative processing of your membership application. It covers documentation and maintenance costs of your cooperative record.
        </ul>

        <h2 id="membership-qualification" class="text-xl font-semibold mt-4">Membership Qualification</h2>
        <ul class="list-disc pl-6">
          <li>Must be at least 18 years old.</li>
          <li>Resident within the cooperative’s area of operation.</li>
          <li>Of good moral character and recommended by an existing member.</li>
          <li>Willing to attend the Pre-Membership Education Seminar (PMES).</li>
        </ul>

        <h2 id="rights-privileges" class="text-xl font-semibold mt-4">Rights and Privileges</h2>
        <ul class="list-disc pl-6">
          <li>Eligible to apply for loans, savings, and other cooperative services.</li>
          <li>Entitled to dividends and patronage refunds based on participation.</li>
          <li>Can vote and be elected to any elective position within the cooperative.</li>
          <li>Receives updates and reports regarding cooperative operations and performance.</li>
        </ul>

        <h2 id="duties-responsibilities" class="text-xl font-semibold mt-4">Duties and Responsibilities</h2>
        <ul class="list-disc pl-6">
          <li>Attend general assemblies.</li>
          <li>Regularly increase share capital and savings build-up.</li>
          <li>Pay obligations and dues promptly.</li>
          <li>Support and promote the cooperative’s goals and programs.</li>
        </ul>

        <h2  id="termination-membership" class="text-xl font-semibold mt-4">Termination of Membership</h2>
        <ul class="list-disc pl-6">
          <li>Resignation upon written notice and settlement of all obligations.</li>
          <li>Automatic termination due to inactivity or non-compliance with policies.</li>
          <li>Expulsion for acts that damage the cooperative’s reputation or financial integrity.</li>
        </ul>
      </div>


    <!-- Loan Policy -->  
    </div>
    <div class="container mx-auto p-5">
      <h1 id="loan-policy" class="text-3xl font-semibold mb-4">Loan Policy</h1>

      <div class="space-y-4">
        <p>This policy is based on Republic Act No. 9520, the rules and regulations of the Cooperative Development Authority (CDA),<br>
        </br> and the By-Laws of the Sta. Lucia Parish Credit Cooperative. It serves as guidance for all members and stakeholders.</p>

        <h2 id="loan-types" class="text-xl font-semibold mt-4">Loan Type</h2>
        <p>The Sta. Lucia Parish Credit Cooperative offers only one type of loan the <strong>Regular Loan</strong> which serves as financial assistance granted exclusively
         to members in good standing, based on their share capital, savings, and repayment capacity.</p>

        <h2 id="eligibility" class="text-xl font-semibold mt-4">Eligiblity</h2>
        <ul class="list-disc pl-6">
            <li>You need to be a Regular Member of the cooperative.</li>
            <li>Have been a member in good standing for at least six (6) months.</li>
            <li>Maintain an active savings account and continuously contribute to their share capital.</li>
        </ul>
        
        <h2 id="loan-details" class="text-xl font-semibold mt-4">Loan Details</h2>

        <ul class="list-disc pl-6">
          <li id="loan_max"><strong>Maximum Loan Amount:</strong> ₱200,000</li>
          This is the highest amount that a member can borrow under this loan type. The actual loanable amount depends on your share capital, savings, and repayment capacity. 
          <ul class="list-disc pl-6">
          <li>1st Loan: 100% of share capital</li>
            <li>2nd Loan: 200% of share capital</li>
            <li>3rd Loan: 300% of share capital</li>
          </ul>
          <br></br>
          
          <li id="deductions"><strong>Regular Deductions:</strong></li>
          <ul class="list-disc pl-6">
            <li><strong>Capital Build-up (CBU):</strong> 2% of loan amount</li>
            A small portion of your loan is contributed to your cooperative share capital. It increases your ownership in the cooperative.
            <li><strong>Savings Build-up (SBU):</strong> 2% of loan amount</li>
            This amount goes directly to your savings account in the cooperative. It helps you save while paying your loan.
            <li><strong>Service Fee:</strong> 3% of loan amount</li>
            A processing fee charged once when your loan is released. It covers administrative costs.
            <li><strong>Loan Protection Program (LPP):</strong> (Loan Amount ÷ 1,000) × ₱1 × Loan Term (in months)<br></br></li>
            The LPP acts as a loan insurance that covers the borrower’s remaining loan balance in case of death or total permanent disability during the loan term.
          </ul> <br></br>

          <li id="interest"><strong>Interest:</strong> 2.5% per month (based on diminishing balance)</li>
          The interest is calculated on the remaining unpaid balance of the loan, not the original amount.This means as you pay off your loan, the interest decreases each month <br></br>making it fairer than a flat rate system.<br><br></br>
          
          <li id="payment"><strong>Payment Options:</strong> Weekly, every two weeks, monthly</li>
            <ul class="list-disc pl-6">
                <li> Weekly – smaller but more frequent payments, ideal for members with weekly income.</li>
                <li>Everyday – very small daily payments for easier budgeting and consistent repayment.</li>
                <li>Every two weeks (15th and 30th of the month) – moderate payments aligned with common salary dates.</li>
                <li>Monthly – larger payments made once a month, ideal for members with steady monthly income.</li>
            </ul><br></br>

          <li id="maturity"><strong>Loan Maturity:</strong> Maximum of 36 months</li>
          This means you have up to 3 years to fully repay the loan.<br></br>
          The cooperative can set shorter terms (e.g., 12 or 24 months) depending on your financial capacity or the loan type.
        </ul>

        <h2 id="loan-evaluation" class="text-xl font-semibold mt-4">Loan Evaluation Criteria</h2>
        <p>The following criteria will be used to evaluate all loan applications:</p>
        <ul class="list-disc pl-6">
          <li><strong>Credit Performance:</strong> Review of previous loan repayment history.</li>
          <li><strong>Capacity to Pay:</strong> Analysis of the borrower’s income and expenses to ensure they can meet the loan obligations.</li>
          <li><strong>Collateral/Co-maker:</strong> A co-maker or collateral may be required to reduce credit risk.</li>
          <li><strong>Character:</strong> The borrower’s record of continuous savings and capital build-up will be considered.</li>
          <li><strong>Capital Status:</strong> The borrower’s share capital and savings must be adequate to support the loan application.</li>
        </ul>


        <h2 id="extension" class="text-xl font-semibold mt-4">Extension and Deferment of Loan Payment</h2>
        <ul class="list-disc pl-6">
          <li><strong>Extension Request:</strong> Loan extension may be granted upon written request and evaluation by the General Manager and the Loan Officer. <br></br>Extensions can be granted for up to 6 months, and should not exceed 6 months in total.</li>
          <li><strong>Deferment Request:</strong> Deferment may be granted for up to 2 months if valid reasons are presented. The co-maker must consent to the deferment request.</li>
          <li><strong>Interest During Extensions:</strong> The loan will continue to accumulate interest during the extension or deferment period.</li>
        </ul>

        <h2 id="penalty" class="text-xl font-semibold mt-4">Penalty for Late Payments</h2>
        <ul class="list-disc pl-6">
          <li><strong>Fines:</strong> A fine of 1% of the amount in default per month will be charged if payment is made after the grace period.</li>
          <li><strong>Grace Period:</strong> 
            <ul class="list-disc pl-6">
              <li>Monthly loans: 3 days</li>
              <li>Quincena loans: 3 days</li>
              <li>Weekly loans: 2 days</li>
              <li>Daily loans: 1 day</li>
            </ul>
          </li>
        </ul>

        <h2 id="important-notes" class="text-xl font-semibold mt-4">Important Notes</h2>
        <ul class="list-disc pl-6">
          <li>All loans are subject to the availability of funds.</li>
          <li>Loan approval depends on the cooperative’s assessment of the borrower’s financial status, ability to repay, and the security/collateral available.</li>
          <li>Loans may be granted only to members in good standing.</li>
        </ul>
      </div>
    </div>

     
  </AppLayout>
</template>
