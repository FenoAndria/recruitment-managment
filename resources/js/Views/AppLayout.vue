<template>
  <div>
    <Navbar />
    <slot></slot>
  </div>
</template>
<script>
import Navbar from "./../Components/Layouts/Navbar.vue";
export default {
  name: "AppLayout",
  components: {
    Navbar,
  },
};
</script>