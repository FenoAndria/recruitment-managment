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
        { tag: "Candidatures", name: "CandidatureIndex" },
        { tag: "Jobs", name: "JobIndex" },
        { tag: "Interviews", name: "InterviewsCandidateIndex" },
      ],
    };
  },
  components: {
    UserLayout,
  },
};
</script>