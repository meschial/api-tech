<template>
  <div>
    <div class="footer">
      <h5>@Marcos Murilo Meschial</h5>
    </div>
  </div>
</template>

<script>
export default {
  name: 'FotterComponent'
}
</script>

<style scoped>
.footer {
  width: 100%;
  height: 40px;
  position: fixed;
  padding-left: 25px;
  bottom: 0;
  color: #FFF;
  background-color: #2150ad;
  z-index: 5;
}
.footer h5 {
  margin-top: 8px;
}
</style>
