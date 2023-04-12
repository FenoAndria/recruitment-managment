<template>
  <div class="h-screen shadow-lg fixed" style="width: 250px">
    <!-- APP NAME -->
    <div class="flex justify-center items-center" style="height: 64px">
      <span class="text-xl font-bold text-gray-500">Recruitment App</span>
    </div>
    <!-- NAVIGATION -->
    <div class="h-full">
      <div class="p-4 text-lg space-y-2">
        <Navlink
          v-for="(link, linkIndex) in this.navlink"
          :key="linkIndex"
          :to="link.name"
          >{{ link.tag }}</Navlink
        >
      </div>
    </div>
  </div>
</template>
<script>
import Navlink from "./Navlink.vue";
export default {
  name: "Sidebar",
  props: ["navlink"],
  data() {
    return {
      
    };
  },
  components: {
    Navlink,
  },
};
</script>