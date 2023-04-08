<template>
  <UserLayout :navlink="this.links">
    <slot></slot>
  </UserLayout>
</template>
<script>
import UserLayout from "./../Layouts/UserLayout.vue";
export default {
  name: "CompanyLayout",
  data() {
    return {
      links: [
        { tag: "Dashboard", name: "Dashboard" },
        { tag: "My Company", name: "CompanyProfileIndex" },
        { tag: "Jobs", name: "JobIndex" },
      ],
    }
  },
  components: {
    UserLayout,
  },
};
</script>