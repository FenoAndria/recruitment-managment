<template>
  <CompanyLayout>
    <h1>Company's Jobs</h1>
    <div class="">
      <router-link :to="{ name: 'CompanyJobCreate' }">
        <button class="btn btn-sm btn-link">Create</button>
      </router-link>
    </div>
    <div v-if="loading">LOADING JOBS...</div>
    <div v-else>
      <div class="" v-if="jobs">
        <div class="" v-for="(job, jobIndex) in jobs" :key="jobIndex">
          <div>
            <h3 class="text-xl">{{ job.title }}</h3>
            <router-link :to="{ name: 'CompanyJobShow', params: { job: job.id } }"
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
import CompanyLayout from "./../../../Components/Layouts/CompanyLayout.vue";
export default {
  name: "CompanyJobsIndex",
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
        .dispatch("GetCompanyJobs")
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