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
        { tag: "Dashboard", name: "CompanyDashboard" },
        { tag: "Profile", name: "CompanyProfileIndex" },
        { tag: "My Jobs", name: "CompanyJobsIndex" },
        { tag: "Interviews", name: "InterviewsCompanyIndex" },
      ],
    }
  },
  components: {
    UserLayout,
  },
};
</script>