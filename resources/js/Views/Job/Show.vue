<template>
  <CandidateLayout>
    <div class="flex items-center justify-center">
      <Card class="w-3/4">
        <div v-if="loading">LOADING JOB...</div>
        <div v-else>
          <div class="" v-if="job">
            <div>
              <h3 class="jobTitle">{{ job.title }}</h3>
              <hr class="border border-green-500 mt-1" />
              <div class="space-y-2">
                <h4>
                  Description :
                  <span v-if="job.description">{{ job.description }}</span>
                  <span class="badge badge-error text-white" v-else>Empty</span>
                </h4>
                <h4>
                  Missions :
                  <span v-if="job.missions">{{ job.missions }}</span>
                  <span class="badge badge-error text-white" v-else>Empty</span>
                </h4>
                <h4>
                  Profile required :
                  <span v-if="job.profile_required">{{
                    job.profile_required
                  }}</span>
                  <span class="badge badge-error text-white" v-else>Empty</span>
                </h4>
                <h4>
                  Deadline :
                  <span v-if="job.deadline">{{
                    this.$dayjs(job.deadline).format("DD MMM YYYY")
                  }}</span>
                  <span class="badge badge-error text-white" v-else>Empty</span>
                </h4>
              </div>
              <hr class="border border-green-500 mt-1" />
              <div class="mt-1">
                <SubmitButton class="float-right btn-sm">
                  <i class="bi bi-check-circle"></i> Apply
                </SubmitButton>
                <h4 class="text-sm text-gray-500">
                  Published at :
                  {{ this.$dayjs(job.published_at).format("DD MMM YYYY") }}
                </h4>
              </div>
            </div>
          </div>
          <div v-else>EMPTY</div>
        </div>
      </Card>
    </div>
  </CandidateLayout>
</template>
<script>
import { mapGetters } from "vuex";
import CandidateLayout from "./../../Components/Layouts/CandidateLayout.vue";
import Card from "./../../Components/Layouts/Card.vue";
import SubmitButton from "./../../Components/Layouts/SubmitButton.vue";
export default {
  name: "JobShow",
  data() {
    return {
      loading: false,
    };
  },
  components: {
    CandidateLayout,
    Card,
    SubmitButton,
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