<template>
  <CompanyLayout>
    <div class="mb-2">
      <router-link :to="{ name: 'CompanyJobCreate' }">
        <button class="btn btn-sm btn-primary">
          <i class="bi bi-plus-lg"></i> New
        </button>
      </router-link>
    </div>
    <div v-if="loading">LOADING JOBS...</div>
    <div v-else>
      <div class="flex flex-wrap -mx-2" v-if="jobs">
        <div
          class="w-1/3 px-2 mb-2"
          v-for="(job, jobIndex) in jobs"
          :key="jobIndex"
        >
          <Card
            class="hover:bg-green-100 hover:shadow hover:mx-1 transition-all"
          >
            <span class="float-right text-blue-500">
              <i
                :class="
                  job.visibility ? 'bi bi-eye-fill' : 'bi bi-eye-slash-fill'
                "
              ></i>
            </span>
            <h3 class="jobTitle">{{ job.title }}</h3>
            <hr class="border border-green-500 mt-1" />
            <div class="">
              <h4>Published at : {{ job.published_at }}</h4>
              <h4>
                Deadline :
                <span v-if="job.deadline">{{ job.deadline }}</span>
                <span class="badge badge-error text-white" v-else>Empty</span>
              </h4>
            </div>
            <div class="float-left">
              <span class="text-warning-600 font-semibold"
                >{{ job.candidatures.length }} candidature{{ job.candidatures.length > 1 ? "s" : "" }}</span
              >
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
                :to="{ name: 'CompanyJobShow', params: { job: job.id } }"
                >More...</router-link
              >
            </div>
          </Card>
        </div>
      </div>
      <div v-else>EMPTY</div>
    </div>
  </CompanyLayout>
</template>
<script>
import { mapGetters } from "vuex";
import CompanyLayout from "./../../../Components/Layouts/CompanyLayout.vue";
import Card from "./../../../Components/Layouts/Card.vue";
export default {
  name: "CompanyJobsIndex",
  data() {
    return {
      loading: false,
    };
  },
  components: {
    CompanyLayout,
    Card,
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