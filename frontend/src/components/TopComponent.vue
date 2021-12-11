<template>
  <div>
    <div class="top-bar">
      <div class="container">
        <div class="row">
          <div class="col-4">
            <h2 class="mt-4 logo-tech">Api Tech</h2>
          </div>
          <div class="col-8">
            <h5 class="mt-4">
              Crud de níveis e desenvolvedores, usando o <b>Laravel</b> e o <b>Vue.JS</b>
            </h5>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'TopComponent'
}
</script>

<style scoped>
.top-bar {
  width: 100%;
  height: 100px;
  position: fixed;
  top: 0;
  color: #FFF;
  background-color: #2150ad;
  z-index: 5;
}
.logo-tech {
  font-weight: 700;
}
</style>
