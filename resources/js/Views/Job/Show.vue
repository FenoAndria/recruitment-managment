<template>
  <AppLayout>
    <h1>Job</h1>
    <div v-if="loading">LOADING JOB...</div>
    <div v-else>
      <div class="" v-if="job">
        <div>
          <h3 class="text-xl">{{ job.title }}</h3>
          <h4 class="text-lg">{{ job.company.name }}</h4>
        </div>
      </div>
      <div v-else>EMPTY</div>
    </div>
  </AppLayout>
</template>
<script>
import { mapGetters } from "vuex";
import AppLayout from "./../../Components/Layouts/AppLayout.vue";
export default {
  name: "JobShow",
  data() {
    return {
      loading: false,
    };
  },
  components: {
    AppLayout,
  },
  computed: {
    ...mapGetters(["job"]),
  },
  methods: {
    loadJobs() {
      this.loading = true;
      this.$store
        .dispatch("GetJob", this.$route.params.job)
        .then((result) => {
            this.$store.commit("SetJob", result.data.job);
            this.loading = false;
            console.log(this.$store.getters.job);
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
  mounted() {
    this.loadJobs();
  },
};
</script>