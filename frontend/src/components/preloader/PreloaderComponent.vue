<template>
  <div>
    <div v-show="preloader" class="preloader">
      <img
        src="@/assets/imgs/preloader.gif"
        alt="Preloader..."
        class="preloader"
      />
    </div>
  </div>
</template>
<script>
export default {
  name: "PreloaderComponent",
  props: {
    preloader: {
      type: Boolean,
      default: false,
    },
  },
};
</script>
<style scoped>
.preloader {
  text-align: center;
  background: #262626;
  color: #fff;
  position: fixed;
  z-index: 9999;
  opacity: 0.4;
  top: 50%;
  width: 100%;
  left: 50%;
  height: 100%;
  text-align: center;
  transform: translate(-50%, -50%);
}
img.preloader {
  width: 274px;
  height: auto;
  max-width: 100%;
}
</style>
