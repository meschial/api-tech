<template>
  <div id="app">
    <main>
      <TopComponent />
      <div class="pages">
          <router-view />
      </div>
    </main>
    <FotterComponent />
  </div>
</template>

<script>
import TopComponent from './components/TopComponent.vue'
import FotterComponent from './components/FotterComponent.vue'
export default {
  name: 'App',
  components: {
    TopComponent,
    FotterComponent
  }
}
</script>
<style>
@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap');
body, h1, h2, h3, h4, h5 {
  font-family: 'Montserrat';
  margin: 0;
  padding: 0;
}
.pages {
  margin-top: 100px;
  margin-bottom: 100px;
}
.close {
  background: transparent;
  border: 1px solid;
  border-radius: 2px;
}
</style>
