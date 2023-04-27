<template>
  <CandidateLayout>
    <h1>Candidate Dashboard. Welcome!</h1>

    <Loader> </Loader>
  </CandidateLayout>
</template>
<script>
import CandidateLayout from "./../../Components/Layouts/CandidateLayout.vue";
import Loader from "./../../Components/Layouts/Loader.vue";
export default {
  name: "CandidateDashboard",
  components: {
    CandidateLayout,
    Loader,
  },
};
</script>