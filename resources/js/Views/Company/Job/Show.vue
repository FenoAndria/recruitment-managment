<template>
  <CompanyLayout>
    <h1>Job</h1>
    <div v-if="loading">LOADING JOB...</div>
    <div v-else>
      <div class="" v-if="job">
        <div>
          <h3 class="text-xl">{{ job.title }}</h3>
          <h4 class="text-lg">{{ job.company.name }}</h4>
          <router-link :to="{ name: 'CompanyJobEdit', params: { id: job.id } }"
            >Edit</router-link
          >
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
  name: "CompanyJobShow",
  data() {
    return {
      loading: false,
    };
  },
  components: {
    CompanyLayout,
  },
  computed: {
    ...mapGetters(["job"]),
  },
  methods: {
    loadJobs() {
      this.loading = true;
      this.$store
        .dispatch("GetCompanyJob", this.$route.params.job)
        .then((result) => {
          this.$store.commit("SetJob", result.data.job);
          this.loading = false;
          console.log(result.data);
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