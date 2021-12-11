<template>
  <div class="home container">
    <div class="row">
      <div class="accordion mt-4" role="tablist">
        <b-card no-body class="mb-1">
          <div>
            <button block v-b-toggle.accordion-1 class="btn-tech">Desenvolvedores</button>
          </div>
          <b-collapse id="accordion-1" visible accordion="my-accordion" role="tabpanel">
            <b-card-body>
              <DevelopersComponent />
            </b-card-body>
          </b-collapse>
        </b-card>

        <b-card no-body class="mb-1 mt-4">
          <div>
            <button block v-b-toggle.accordion-2 class="btn-tech">Níveis</button>
          </div>
          <b-collapse id="accordion-2" accordion="my-accordion" role="tabpanel">
            <b-card-body>
              <LevelsComponent ref="foo"/>
            </b-card-body>
          </b-collapse>
        </b-card>
      </div>
    </div>
  </div>
</template>

<script>
import LevelsComponent from '../components/LevelsComponent.vue'
import DevelopersComponent from '../components/DevelopersComponent.vue'
export default {
  name: 'Home',
  components: {
    LevelsComponent,
    DevelopersComponent
  }
}
</script>

<style>
.btn-tech {
  width: 100%;
  border: none;
  font-size: 20px;
  font-weight: 700;
  background-color: #348ef5;
  color: #FFF;
  padding: 5px 0;
  border-radius: 5px;
}
.btn-tech:hover {
  background-color: #3489eb;
}
.btn-tech:focus {
  background-color: #3489eb;
}
.btn-tech:active {
  background-color: #3489eb;
}
.btn-register {
  cursor: pointer;
  font-weight: 700;
  width: 275px;
}
.new-register {
  color: #FFF;
  background-color: #1c469b;
  padding: 8px 15px;
  border-radius: 50px;
}
.search-filter {
  width: 250px;
  float: right;
}
</style>
