<template>
  <UserLayout :navlink="this.links">
    <slot></slot>
  </UserLayout>
</template>
<script>
import UserLayout from "./../Layouts/UserLayout.vue";
export default {
  name: "CandidateLayout",
  data() {
    return {
      links: [
        { tag: "Dashboard", name: "CandidateDashboard" },
        { tag: "Profile", name: "CandidateProfileIndex" },
        { tag: "My candidatures", name: "CandidatureIndex" },
      ],
    }
  },
  components: {
    UserLayout,
  },
};
</script>