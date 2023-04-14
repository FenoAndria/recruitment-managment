<template>
  <div class="flex">
    <Sidebar :navlink="this.navlink"/>
    <div class="w-full" style="margin-left:250px">
      <Navbar />
      <div class="py-4 px-6">
        <slot></slot>
      </div>
    </div>
  </div>
</template>
<script>
import Navbar from "./Navbar.vue";
import Sidebar from "./Sidebar.vue";
export default {
  name: "UserLayout",
  props: ["navlink"],
  components: {
    Navbar,
    Sidebar,
  },
};
</script>