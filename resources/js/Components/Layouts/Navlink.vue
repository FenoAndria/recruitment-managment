<template>
  <div class="">
    <router-link
      class="navlink"
      active-class="navlink-active"
      :to="{ name: this.to }"
    >
      <slot></slot>
    </router-link>
  </div>
</template>
<script>
export default {
  name: "Navlink",
  props: ["to"],
};
</script>