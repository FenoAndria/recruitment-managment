<template>
  <CompanyLayout>
    <div class="flex items-center justify-center">
      <Card class="w-3/4">
        <div v-if="loading">LOADING JOB...</div>
        <div v-else>
          <div class="" v-if="job">
            <div>
              <div class="float-right space-x-2">
                <span
                  class="badge badge-error text-white font-semibold"
                  v-if="job.urgent"
                  >Urgent</span
                >
                <span class="text-blue-500">
                  <i
                    :class="
                      job.visibility ? 'bi bi-eye-fill' : 'bi bi-eye-slash-fill'
                    "
                  ></i>
                </span>
              </div>
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
                  <span v-if="job.deadline">{{ job.deadline }}</span>
                  <span class="badge badge-error text-white" v-else>Empty</span>
                </h4>
              </div>
              <hr class="border border-green-500 mt-1" />
              <div class="mt-1">
                <h4 class="text-sm text-gray-500 float-left">
                  Published at : {{ job.published_at }}
                </h4>
                <router-link
                  :to="{ name: 'CompanyJobEdit', params: { id: job.id } }"
                >
                  <Button class="float-right btn-xs">
                    <i class="bi bi-pencil-square"></i> Edit
                  </Button>
                </router-link>
              </div>
            </div>
          </div>
          <div v-else>EMPTY</div>
        </div>
      </Card>
    </div>
  </CompanyLayout>
</template>
<script>
import { mapGetters } from "vuex";
import CompanyLayout from "./../../../Components/Layouts/CompanyLayout.vue";
import Card from "./../../../Components/Layouts/Card.vue";
import Button from "./../../../Components/Layouts/Button.vue";
export default {
  name: "CompanyJobShow",
  data() {
    return {
      loading: false,
    };
  },
  components: {
    CompanyLayout,
    Card,
    Button,
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