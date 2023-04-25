<template>
  <CandidateLayout>
    <Card>
      <div v-if="loading">LOADING INTERVIEWS...</div>
      <div v-else>
        <div v-if="CandidateInterviews">
          <table class="table table-compact w-full text-center">
            <thead>
              <tr>
                <th>Job </th>
                <th>Company name</th>
                <th>Status</th>
                <th>Date</th>
                <th>Time</th>
                <th>Details</th>
              </tr>
            </thead>
            <tbody>
              <tr
                v-for="(
                  interview, interviewIndex
                ) in CandidateInterviews"
                :key="interviewIndex"
              >
                <td>{{ interview.candidature.job_title }}</td>
                <td>{{ interview.candidature.company_name }}</td>
                <td>
                  <span class="badge font-semibold">{{
                    interview.candidature.status
                  }}</span>
                </td>
                <td>
                  {{ this.$dayjs(interview.date).format("DD MMM YYYY") }}
                </td>
                <td>
                  {{ interview.time }}
                </td>
                <td>
                  {{ interview.details}}
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </Card>
  </CandidateLayout>
</template>
<script>
import CandidateLayout from "./../../../Components/Layouts/CandidateLayout.vue";
import Card from "./../../../Components/Layouts/Card.vue";
import { mapGetters } from "vuex";

export default {
  name: "InterviewsCompanyIndex",
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
    ...mapGetters(["CandidateInterviews"]),
  },
  methods: {
    loadInterviews() {
      this.loading = true;
      this.$store
        .dispatch("GetCandidateInterviews")
        .then((result) => {
          this.$store.commit("SetCandidateInterviews", result.data.interviews);
          this.loading = false;
          console.log(result);
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
  mounted() {
    this.loadInterviews();
  },
};
</script>