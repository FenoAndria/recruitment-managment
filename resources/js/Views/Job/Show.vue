<template>
  <CandidateLayout>
    <div class="" v-if="loading"><Loader /></div>
    <div class="flex items-center justify-center" v-else>
      <Card class="w-3/4">
        <div>
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
                <div class="float-right">
                  <div
                    class=""
                    v-if="this.$store.getters.USER_DATA.candidate.resume"
                  >
                    <span
                      v-if="this.candidatureExists"
                      class="font-bold text-danger-500"
                      ><i class="bi bi-check-circle"></i> Candidature
                      sended!</span
                    >
                    <SubmitButton
                      class="btn-sm"
                      :loading="this.loadingSubmit"
                      @click.prevent="submit"
                      v-else
                    >
                      Apply
                    </SubmitButton>
                  </div>
                  <div class="font-bold text-danger-500" v-else>
                    <i class="bi bi-check-circle"></i> You need to upload your
                    Resume to apply!
                  </div>
                </div>
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
import Loader from "./../../Components/Layouts/Loader.vue";
export default {
  name: "JobShow",
  data() {
    return {
      loading: false,
      loadingSubmit: false,
      candidatureExists: false,
    };
  },
  components: {
    CandidateLayout,
    Card,
    SubmitButton,
    Loader,
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
          this.candidatureExists = result.data.candidature;
          this.loading = false;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    submit() {
      this.loadingSubmit = true;
      this.$store
        .dispatch("StoreCandidature", this.job)
        .then((result) => {
          this.$router.push({ name: "JobIndex" });
          this.loadingSubmit = false;
          console.log(result);
        })
        .catch((err) => {
          this.loadingSubmit = false;
          console.log(err);
        });
    },
  },
  mounted() {
    this.loadJobs();
  },
};
</script>