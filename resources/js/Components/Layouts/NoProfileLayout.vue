<template>
  <div class="flex">
    <Sidebar :navlink="this.links"/>
    <div class="w-full" style="margin-left:250px">
      <Navbar :noProfile="true"/>
      <div class="py-4 px-6">
        <slot></slot>
      </div>
    </div>
  </div>
</template>
<script>
import UserLayout from "./../Layouts/UserLayout.vue";
import Sidebar from "./../Layouts/Sidebar.vue";
import Navbar from "./../Layouts/Navbar.vue";
export default {
  name: "NoProfileLayout",
  props: ["links"],
  data() {
    return {
    };
  },
  components: {
    UserLayout,
    Sidebar,
    Navbar,
  },
};
</script>