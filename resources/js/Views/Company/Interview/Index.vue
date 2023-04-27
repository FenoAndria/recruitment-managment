<template>
  <CompanyLayout>
    <Card>
      <div v-if="loading">LOADING INTERVIEWS...</div>
      <div v-else>
        <div v-if="CompanyInterviews">
          <table class="table table-compact w-full text-center">
            <thead>
              <tr>
                <th>Job </th>
                <th>Candidate name</th>
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
                ) in CompanyInterviews"
                :key="interviewIndex"
              >
                <td>{{ interview.candidature.job_title }}</td>
                <td>{{ interview.candidature.candidate_name }}</td>
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
  </CompanyLayout>
</template>
<script>
import CompanyLayout from "./../../../Components/Layouts/CompanyLayout.vue";
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
    CompanyLayout,
    Card,
  },
  computed: {
    ...mapGetters(["CompanyInterviews"]),
  },
  methods: {
    loadInterviews() {
      this.loading = true;
      this.$store
        .dispatch("GetCompanyInterviews")
        .then((result) => {
          this.$store.commit("SetCompanyInterviews", result.data.interviews);
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