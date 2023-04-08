<template>
  <CompanyLayout>
    <h1>Job index</h1>
    <div v-if="loading">LOADING JOBS...</div>
    <div v-else>
      <div class="" v-if="jobs">
        <div class="" v-for="(job, jobIndex) in jobs" :key="jobIndex">
          <div>
            <h3 class="text-xl">{{ job.title }}</h3>
            <h4 class="text-lg">{{ job.company.name }}</h4>
            <router-link :to="{ name: 'JobShow', params: { job: job.id } }"
              >Show</router-link
            >
          </div>
        </div>
      </div>
      <div v-else>EMPTY</div>
    </div>
  </CompanyLayout>
</template>
<script>
import { mapGetters } from "vuex";
import CompanyLayout from "./../../Components/Layouts/CompanyLayout.vue";
export default {
  name: "JobIndex",
  data() {
    return {
      loading: false,
    };
  },
  components: {
    CompanyLayout,
  },
  computed: {
    ...mapGetters(["jobs"]),
  },
  methods: {
    loadJobs() {
      this.loading = true;
      this.$store
        .dispatch("GetJobs")
        .then((result) => {
          this.$store.commit("SetJobs", result.data.jobs);
          this.loading = false;
          console.log(result.data.jobs);
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