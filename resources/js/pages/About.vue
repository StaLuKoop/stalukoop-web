<script setup lang="ts">
import PublicLayout from '@/layouts/PublicLayout.vue'
import { ref } from 'vue'

// Set the layout for the page
defineOptions({
  layout: (h: any, page: any) => h(PublicLayout, { title: 'About' }, () => page),
})

// Create a reactive variable to track the current section
const currentSection = ref('vision')

// Method to change the section
const showSection = (section: string) => {
  currentSection.value = section // Set the current section to the clicked button's section
}
</script>

<template>
  <div>
    <!-- "ABOUT US" Header (conditionally shown when vision is selected) -->
    <div v-if="currentSection === 'vision'" class="bg-rose-600">
      <h1>About Us</h1>
    </div>
    <div v-if="currentSection === 'bod'" class="bg-rose-600">
      <h1>Board of Directors</h1>
    </div>
    <div v-if="currentSection === 'committees'" class="bg-rose-600">
      <h1>Commitees</h1>
    </div>
    <div v-if="currentSection === 'awards'" class="bg-rose-600">
      <h1>Awards</h1>
    </div>

    <!-- Navigation Buttons (Centered) -->
    <div class="button-container">
      <button @click="showSection('vision')">VMC</button>
      <button @click="showSection('bod')">BOARD OF DIRECTORS</button>
      <button @click="showSection('committees')">COMMITTEES</button>
      <button @click="showSection('awards')">AWARDS</button>
    </div>

    <!-- Content Sections -->
    <div v-if="currentSection === 'vision'" class="content-section">
      <div class="left-side">
        <div class="content-box">
          <h2>VISION</h2>
          <p>Isang Kooperatiba na makatutulong sa pagpapalaganap ng pananampalataya ng mga kasapi.</p>
          <p>
            Isang institusyon na ang pangunahing layunin ay upang tumulong at magtaguyod ng maayos at matibay na
            komunidad ng mga kasapi.
          </p>
          <p>
            Sa tulong ng bawat isa, layunin namin na magbigay ng makatawid sa pangangailangan ng bawat kasapi sa
            pamamagitan ng mga serbisyo at programa na akma sa kanilang mga pangangailangan.
          </p>
        </div>
        <div class="content-box1">
          <h2>MISSION</h2>
          <p>
            Maipalaganap ang kahalagahan ng pananalapi, pamumuhunan at pag-iimpok sa mga kasapi upang magamit sa
            kanilang kabuhayan.
          </p>
        </div>
        <div class="content-box2">
          <h2>CORE VALUES</h2>
          <p>
            Tulungan ang mga kasapi na matulungan ang kanilang mga sarili; Itaguyod at ipalaganap ang Kooperatibismo;
            Maging mabuti at pangunahing Kooperatiba na may integridad at kakayahan tulad ng ibang samahan.
          </p>
        </div>
      </div>
      <div class="content-image">
        <img src="/images/VMC.jpg" alt="Content Image" />
      </div>
    </div>

    <div v-if="currentSection === 'bod'">
      <div class="bod-chart">
        <div class="bod-row center">
          <div class="bod-box">RODELIO DE GUZMAN<br /><span>CHAIRMAN</span></div>
        </div>
        <div class="bod-row center">
          <div class="bod-box">ENGR. BRIGIDO GONZALES<br /><span>VICE CHAIRMAN</span></div>
        </div>
        <div class="bod-row">
          <div class="bod-box">DR. ROEL NERI<br /><span>BOARD MEMBER</span></div>
          <div class="bod-box">MA. CONCEPTION GONZALES<br /><span>BOARD MEMBER</span></div>
        </div>
        <div class="bod-row">
          <div class="bod-box">HELEN CORTEZ<br /><span>BOARD MEMBER</span></div>
          <div class="bod-box">CORAZON RABANZO<br /><span>BOARD MEMBER</span></div>
        </div>
        <div class="bod-row center">
          <div class="bod-box">JUANITA NARCA<br /><span>SECRETARY</span></div>
        </div>
        <div class="bod-row center">
          <div class="bod-box">MA. ELIZABETH VASQUEZ<br /><span>TREASURER</span></div>
        </div>
      </div>
    </div>

    <div v-if="currentSection === 'committees'">
      <div class="committee-org-chart">
        <!-- Committee Columns -->
        <div class="committee-column">
          <div class="committee-box-title">AUDIT</div>
          <div class="arrow-down"></div>
          <div class="committee-box">ALYSSA MARIE BALAZON<br /><span>CHAIRMAN</span></div>
          <div class="arrow-down"></div>
          <div class="committee-box">WILREDO ARANTON<br /><span>VICE CHAIRMAN</span></div>
          <div class="arrow-down"></div>
          <div class="committee-box">CLARITA NABOR<br /><span>SECRETARY</span></div>
        </div>

        <div class="committee-column">
          <div class="committee-box-title">ELECTION</div>
          <div class="arrow-down"></div>
          <div class="committee-box">EMILY ALFARO<br /><span>CHAIRMAN</span></div>
          <div class="arrow-down"></div>
          <div class="committee-box">MA. BERNADETTE KHO<br /><span>VICE CHAIRMAN</span></div>
          <div class="arrow-down"></div>
          <div class="committee-box">DIVINE GRACE GUDOY<br /><span>SECRETARY</span></div>
        </div>

        <div class="committee-column">
          <div class="committee-box-title">CREDIT</div>
          <div class="arrow-down"></div>
          <div class="committee-box">ROBERT PELINGO<br /><span>CHAIRMAN</span></div>
          <div class="arrow-down"></div>
          <div class="committee-box">TONY AMANDY<br /><span>VICE CHAIRMAN</span></div>
          <div class="arrow-down"></div>
          <div class="committee-box">CORAZON DIAMANTE<br /><span>SECRETARY</span></div>
        </div>

        <div class="committee-column">
          <div class="committee-box-title">MEDIATION</div>
          <div class="arrow-down"></div>
          <div class="committee-box">JOSE RULL<br /><span>CHAIRMAN</span></div>
          <div class="arrow-down"></div>
          <div class="committee-box">ROSALINDA FABIE<br /><span>VICE CHAIRMAN</span></div>
          <div class="arrow-down"></div>
          <div class="committee-box">MERCELITA ABUEVA<br /><span>SECRETARY</span></div>
        </div>

        <div class="committee-column">
          <div class="committee-box-title">GAD</div>
          <div class="arrow-down"></div>
          <div class="committee-box">MA. CONCEPTION GONZALES<br /><span>CHAIRMAN</span></div>
          <div class="arrow-down"></div>
          <div class="committee-box">WILFREDO ARANTON<br /><span>VICE CHAIRMAN</span></div>
          <div class="arrow-down"></div>
          <div class="committee-box">KHAYE BALMAÑA<br /><span>SECRETARY</span></div>
        </div>

        <div class="committee-column">
          <div class="committee-box-title">ETHICS</div>
          <div class="arrow-down"></div>
          <div class="committee-box">JOCELYN MENDOZA<br /><span>CHAIRMAN</span></div>
          <div class="arrow-down"></div>
          <div class="committee-box">NORMA ANTONIO<br /><span>VICE CHAIRMAN</span></div>
          <div class="arrow-down"></div>
          <div class="committee-box">LAURA ISABELLE TRIGO<br /><span>SECRETARY</span></div>
        </div>
      </div>

      <!-- Management Staff -->
      <div class="committee-management">
        <div class="committee-box-title">MANAGEMENT STAFF</div>
        <div class="management-row">
          <div class="committee-box">PEDRO FAUSTINO<br /><span>GENERAL MANAGER</span></div>
          <div class="committee-box">MA. ELIZABETH VASQUEZ<br /><span>LOAN OFFICER</span></div>
          <div class="committee-box">KHAYE BALMAÑA<br /><span>CASHIER</span></div>
        </div>
      </div>
    </div>

    <div v-if="currentSection === 'awards'">
      <h1 class="awards-title">AWARDS AND RECOGNITION</h1>
      <div class="awards-section">
        <img src="/images/AWARD.png" alt="Awards and Recognition" />
      </div>
    </div>
  </div>
</template>

<style scoped>
/* About header style */
.bg-rose-600 {
  color: white;
  text-align: center;
  padding: 40px 0;
  margin-top: -1px;
  margin-bottom: 30px;
}

.bg-rose-600 h1 {
  font-size: 40px;
  font-weight: bold;
  margin: 0;
}

/* Center the button container */
.button-container {
  display: flex;
  justify-content: center;
  gap: 10px;
  margin-bottom: 20px;
}

button {
  padding: 10px 20px;
  background-color: white;
  border: 1px solid #da251c;
  border-radius: 20px;
  cursor: pointer;
  font-size: 16px;
}

button:hover {
  background-color: #da251cd2;
  color: white;
}

/* Center the entire content section */
.content-section {
  display: flex;
  justify-content: center;
  align-items: flex-start;
  gap: 10px;

  max-width: 1400px;
  margin: -9px auto;
  /* Adjust max-width and margin for better centering */
}

/* Left content (boxes) */
.left-side {
  width: 65%; /* Increased width for left content */
}

.content-image {
  width: 50%; /* Increased width for the image */
  display: flex;
  justify-content: center;
  align-items: center;
  height: 529px;
  border: 1px solid black;
  border-radius: 10px;
  margin-bottom: 31px;
}

.content-image img {
  max-width: 100%;
  height: 100%;
  border-radius: 10px;
}

/* Styling for content boxes */
.content-box,
.content-box1,
.content-box2 {
  background-color: white;
  padding: 20px;
  border: 1px solid black;
  margin-bottom: 10px;
  border-radius: 10px;
}

.content-box h2,
.content-box1 h2,
.content-box2 h2 {
  font-size: 24px;
  font-weight: bold;
  color: #da251c;
}

.content-box p {
  font-size: 16px;
  line-height: 1.6;
  color: black;
}

/* BOD SECTION */
.bod-chart {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 15px;
  margin-bottom: 23px;
}

.bod-row {
  display: flex;
  justify-content: center;
  gap: 20px;
  flex-wrap: wrap;
}

.bod-box {
  background-color: white;
  border: 1px solid black;
  padding: 15px 25px;
  border-radius: 5px;
  box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
  font-weight: bold;
  color: #da251c;
  text-align: center;
  min-width: 200px;
}

.bod-box span {
  display: block;
  font-size: 12px;
  color: black;
  font-weight: normal;
}

.bod-row.center {
  justify-content: center;
}

/* COMMITTEE ORG CHART */
.committee-org-chart {
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  gap: 30px;
  margin-bottom: 22px;
}

.committee-column {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 10px;
  position: relative;
}

.committee-box-title {
  background-color: white;
  border: 2px solid #999;
  padding: 10px 20px;
  border-radius: 4px;
  font-weight: bold;
  color: black;
  text-align: center;
  min-width: 120px;
  box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
}

.committee-box {
  background-color: white;
  border: 1px solid #999;
  padding: 15px 25px;
  border-radius: 5px;
  box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
  font-weight: bold;
  color: #da251c;
  text-align: center;
  min-width: 200px;
}

.committee-box span {
  display: block;
  font-size: 12px;
  color: black;
  font-weight: normal;
}

/* Arrow style */
.arrow-down {
  width: 0;
  height: 0;
  border-left: 8px solid transparent;
  border-right: 8px solid transparent;
  border-top: 10px solid #999;
}

/* Management Section */
.committee-management {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-top: 10px;
  gap: 15px;
  margin-bottom: 23px;
}

.management-row {
  display: flex;
  gap: 20px;
  flex-wrap: wrap;
  justify-content: center;
}

/* Awards Section */
.awards-title {
  margin-top: 30px;
  text-align: center;
  color: #da251c;
  font-weight: bold;
  font-size: 32px;
  margin-bottom: 1.5px;
  text-transform: uppercase;
}

.awards-section {
  display: flex;
  justify-content: center;
  margin-bottom: 32px;
}

.awards-section img {
  max-width: 1500px;
  height: 450px;
  border-radius: 10px;
}

/* Media Queries for Responsiveness */

/* For tablets and smaller screens */
@media (max-width: 1024px) {
  .content-section {
    flex-direction: column;
    padding: 10px;
  }

  .left-side {
    width: 100%;
  }

  .content-image {
    width: 100%;
    height: 300px;
    margin-bottom: 20px;
  }

  .content-box,
  .content-box1,
  .content-box2 {
    width: 100%;
    padding: 10px;
  }

  .bod-box,
  .committee-box {
    min-width: 100%;
    font-size: 14px;
  }

  .committee-column {
    width: 100%;
  }

  .awards-section img {
    width: 100%;
  }
}

/* For mobile phones */
@media (max-width: 768px) {
  .bg-rose-600 h1 {
    font-size: 28px;
  }

  .button-container {
    flex-direction: column;
    align-items: center;
  }

  .service-card {
    width: 80%;
    height: auto;
    margin-bottom: 20px;
  }

  .service-card img {
    width: 100%;
    height: auto;
  }

  .bod-chart {
    display: flex;
    flex-direction: column;
  }

  .committee-org-chart {
    flex-direction: column;
  }

  .committee-box-title,
  .committee-box {
    min-width: 80%;
  }

  .awards-section img {
    width: 100%;
    height: auto;
  }
}
</style>
