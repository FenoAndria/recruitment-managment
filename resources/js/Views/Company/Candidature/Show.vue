<template>
  <CompanyLayout>
    <Card>
      <div v-if="loading">LOADING CANDIDATURE...</div>
      <div v-else>
        <div v-if="candidature">
          <p class="text-lg">
            Candidate : {{ candidature.candidate.first_name }}
            {{ candidature.candidate.last_name }}
          </p>
          <p class="text-lg">
            Date : {{ this.$dayjs(candidature.date).format("DD MMM YYYY") }}
          </p>
          <!-- <p class="text-lg">Status : {{ candidature.status }}</p> -->
          <form @submit.prevent="submit">
            <div class="space-y-4">
              <div class="form-control">
                <select
                  v-model="candidature.status"
                  class="select select-bordered select-sm select-success"
                >
                  <option value="pending">Pending</option>
                  <option value="interview">Interview</option>
                  <option value="keeped">Keeped</option>
                  <option value="rejected">Rejected</option>
                </select>
              </div>
              <SubmitButton
                class="btn-sm btn-block"
                :loading="this.loadingSubmit"
              >
                Update</SubmitButton
              >
            </div>
          </form>
        </div>
      </div>
    </Card>
  </CompanyLayout>
</template>
<script>
import CompanyLayout from "./../../../Components/Layouts/CompanyLayout.vue";
import Card from "./../../../Components/Layouts/Card.vue";
import SubmitButton from "./../../../Components/Layouts/SubmitButton.vue";
import { mapGetters } from "vuex";

export default {
  name: "CandidaturesForCompanyShow",
  data() {
    return {
      loading: false,
      loadingSubmit: false,
      status: "",
    };
  },
  components: {
    CompanyLayout,
    Card,
    SubmitButton,
  },
  computed: {
    ...mapGetters(["candidature"]),
  },
  methods: {
    loadCandidature() {
      this.loading = true;
      this.$store
        .dispatch(
          "GetCandidatureForCompanyShow",
          this.$route.params.candidature
        )
        .then((result) => {
          this.$store.commit("setCandidature", result.data.candidature);
          this.loading = false;
          console.log(result);
        })
        .catch((err) => {
          this.loading = false;
          console.log(err);
        });
    },
    submit() {
      this.loadingSubmit = true;
      this.$store
        .dispatch("UpdateCandidature", this.candidature)
        .then((result) => {
          this.loadingSubmit = false;
          this.$router.push({
            name: "CompanyJobShow",
            params: { job: this.candidature.job.id },
          });
        })
        .catch((err) => {
          this.loadingSubmit = false;
          console.log(err);
        });
    },
  },
  mounted() {
    this.loadCandidature();
  },
};
</script>