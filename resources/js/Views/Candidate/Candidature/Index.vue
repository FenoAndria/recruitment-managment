<template>
  <CandidateLayout>
    <Card>
      <div class="" v-if="loading">LOADING CANDIDATURES...</div>
      <div v-else>
        <div class="overflow-x-auto" v-if="candidaturesByCandidate">
          <table class="table table-compact w-full text-center">
            <thead>
              <tr>
                <th>JOB TITLE</th>
                <th>COMPANY</th>
                <th>STATUS</th>
                <th>DATE</th>
              </tr>
            </thead>
            <tbody>
              <tr
                v-for="(
                  candidature, candidatureIndex
                ) in candidaturesByCandidate"
                :key="candidatureIndex"
              >
                <td>{{ candidature.job.title }}</td>
                <td>{{ candidature.job.company.name }}</td>
                <td><span class="badge badge-primary font-semibold">{{ candidature.status }}</span></td>
                <td>{{ this.$dayjs(candidature.date).format('DD MMM YYYY')  }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </Card>
  </CandidateLayout>
</template>
<script>
import { mapGetters } from "vuex";
import CandidateLayout from "./../../../Components/Layouts/CandidateLayout.vue";
import Card from "./../../../Components/Layouts/Card.vue";
export default {
  name: "CandidatureIndex",
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
    ...mapGetters(["candidaturesByCandidate"]),
  },
  methods: {
    loadCandidatures() {
      this.loading = true;
      this.$store
        .dispatch("GetCandidaturesByCandidate")
        .then((result) => {
          this.loading = false;
          this.$store.commit(
            "setCandidaturesByCandidate",
            result.data.candidatures
          );
          console.log(result.data.candidatures[1]);
        })
        .catch((err) => {
          this.loading = false;
          console.log(err);
        });
    },
  },
  mounted() {
    this.loadCandidatures();
  },
};
</script>