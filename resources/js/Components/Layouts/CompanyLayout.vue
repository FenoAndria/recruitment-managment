<template>
  <div>
    <Navbar />
    <slot></slot>
  </div>
</template>
<script>
import Navbar from "./Navbar.vue";
export default {
  name: "CompanyLayout",
  components: {
    Navbar,
  },
};
</script>