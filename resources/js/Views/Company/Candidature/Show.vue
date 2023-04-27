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
          <p class="text-lg">
            Status :
            <span class="badge badge-secondary">{{ candidature.status }}</span>
          </p>

          <div
            class="flex space-x-2 justify-center"
            v-if="candidature.status == 'pending'"
          >
            <label class="btn btn-sm btn-primary" for="interview"
              >Interview</label
            >
            <label class="btn btn-sm btn-success" for="keeped">Keeped</label>
            <label class="btn btn-sm btn-error" for="rejected">Rejected</label>
            <InterviewModal :candidature="candidature" />
            <CandidatureKeepedModal :candidature="candidature" />
            <CandidatureRejectedModal :candidature="candidature" />
          </div>
          <div
            class=""
            v-if="candidature.status == 'interview' && candidature.interview"
          >
            <h4 class="text-lg font-bold">Interview</h4>
            <p>Date : {{ candidature.interview.date }}</p>
            <p>Time : {{ candidature.interview.time }}</p>
            <p>Details : {{ candidature.interview.details }}</p>
          </div>
        </div>
      </div>
    </Card>
  </CompanyLayout>
</template>
<script>
import CompanyLayout from "./../../../Components/Layouts/CompanyLayout.vue";
import Card from "./../../../Components/Layouts/Card.vue";
import SubmitButton from "./../../../Components/Layouts/SubmitButton.vue";
import Button from "./../../../Components/Layouts/Button.vue";
import Modal from "./../../../Components/Layouts/Modal.vue";
import CandidatureKeepedModal from "./../../../Components/Modal/CandidatureKeepedModal.vue";
import CandidatureRejectedModal from "./../../../Components/Modal/CandidatureRejectedModal.vue";
import InterviewModal from "./../../../Components/Modal/InterviewModal.vue";
import { mapGetters } from "vuex";

export default {
  name: "CandidaturesForCompanyShow",
  data() {
    return {
      loading: false,
      loadingSubmit: false,
      status: "",
      modal: {
        content: "",
        status: "",
      },
    };
  },
  components: {
    CompanyLayout,
    Card,
    SubmitButton,
    Button,
    Modal,
    CandidatureKeepedModal,
    CandidatureRejectedModal,
    InterviewModal,
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
          // console.log(result.data);
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