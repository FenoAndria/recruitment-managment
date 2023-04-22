<template>
  <CandidateLayout>
    <div v-if="loading">LOADING JOBS...</div>
    <div v-else>
      <div class="flex flex-wrap -mx-2" v-if="jobs">
        <div class="w-1/3 px-2 mb-2" v-for="(job, jobIndex) in jobs" :key="jobIndex">
          <Card class="hover:bg-green-100 hover:shadow hover:mx-1 transition-all">
            <h3 class="jobTitle">{{ job.title }}</h3>
            <hr class="border border-green-500 mt-1" />
            <h4 class="badge badge-info text-white font-bold">{{ job.company.name }}</h4>
            <div class="">
              <h4>Published at : {{ this.$dayjs(job.published_at).format("DD MMM YYYY") }}</h4>
              <h4>
                Deadline :
                <span v-if="job.deadline">{{ this.$dayjs(job.deadline).format("DD MMM YYYY") }}</span>
                <span class="badge badge-error text-white" v-else>Empty</span>
              </h4>
            </div>
            <div
              class="
                text-right text-green-400
                hover:underline
                hover:text-green-600
                transition-all
              "
            >
              <router-link
                :to="{ name: 'JobShow', params: { job: job.id } }"
                >More...</router-link
              >
            </div>
          </Card>
        </div>
      </div>
      <div v-else>EMPTY</div>
    </div>
  </CandidateLayout>
</template>
<script>
import { mapGetters } from "vuex";
import CandidateLayout from "./../../Components/Layouts/CandidateLayout.vue";
import Card from "./../../Components/Layouts/Card.vue";
export default {
  name: "JobIndex",
  data() {
    return {
      loading: false,
    };
  },
  components: {
    CandidateLayout,
    Card,
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
          console.log(result.data.jobs[0]);
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