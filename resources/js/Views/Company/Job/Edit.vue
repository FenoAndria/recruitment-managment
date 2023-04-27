<template>
  <CompanyLayout>
    <div class="" v-if="loading"><Loader /></div>
    <div class="flex items-center justify-center" v-else>
      <Card class="w-3/4">
        <div v-if="loading">LOADING JOB...</div>
        <div v-else>
          <form @submit.prevent="submit">
            <div class="x-form">
              <ValidationError :errors="validationErrors" column="title" />
              <label for="">Title</label>
              <input type="text" v-model="job.title" class="x-input" />
            </div>
            <div class="">
              <ValidationError :errors="validationErrors" column="deadline" />
              <label for="">Deadline</label>
              <input type="date" v-model="job.deadline" class="x-input" />
            </div>
            <div class="">
              <ValidationError
                :errors="validationErrors"
                column="description"
              />
              <label for="">Description</label>
              <textarea
                cols="30"
                rows="2"
                v-model="job.description"
                class="x-textarea"
              ></textarea>
            </div>
            <div class="">
              <ValidationError :errors="validationErrors" column="missions" />
              <label for="">Missions</label>
              <textarea
                cols="30"
                rows="2"
                v-model="job.missions"
                class="x-textarea"
              ></textarea>
            </div>
            <div class="">
              <ValidationError
                :errors="validationErrors"
                column="profile_required"
              />
              <label for="">Profile required</label>
              <textarea
                cols="30"
                rows="2"
                v-model="job.profile_required"
                class="x-textarea"
              ></textarea>
            </div>
            <ValidationError :errors="validationErrors" column="visibility" />
            <ValidationError :errors="validationErrors" column="urgent" />
            <div class="py-2 flex items-center space-x-4 text-white">
              <div
                class="
                  flex
                  items-center
                  px-2
                  rounded
                  max-w-min
                  space-x-2
                  bg-danger-500
                "
              >
                <label for="">Urgent</label>
                <input
                  type="checkbox"
                  v-model="job.urgent"
                  class="checkbox checkbox-sm checkbox-error"
                />
              </div>
              <div
                class="
                  flex
                  items-center
                  px-2
                  rounded
                  max-w-min
                  space-x-2
                  bg-blue-500
                "
              >
                <label for="">Visible</label>
                <input
                  type="checkbox"
                  v-model="job.visibility"
                  class="checkbox checkbox-sm checkbox-info"
                />
              </div>
            </div>
            <div class="">
              <SubmitButton
                class="btn-sm btn-block btn-success"
                :loading="this.loadingSubmit"
                >Save</SubmitButton
              >
            </div>
          </form>
        </div>
      </Card>
    </div>
  </CompanyLayout>
</template>
<script>
import { mapGetters } from "vuex";
import CompanyLayout from "./../../../Components/Layouts/CompanyLayout.vue";
import Card from "./../../../Components/Layouts/Card.vue";
import SubmitButton from "./../../../Components/Layouts/SubmitButton.vue";
import ValidationError from "./../../../Components/Layouts/ValidationError.vue";
import Loader from "./../../../Components/Layouts/Loader.vue";

export default {
  name: "CompanyJobEdit",
  data() {
    return {
      loading: false,
      loadingSubmit: false,
      validationErrors: "",
    };
  },
  components: {
    CompanyLayout,
    Card,
    SubmitButton,
    ValidationError,
    Loader
  },
  computed: {
    ...mapGetters(["job"]),
  },
  methods: {
    loadJob() {
      this.loading = true;
      this.$store
        .dispatch("GetCompanyJob", this.$route.params.job)
        .then((result) => {
          this.$store.commit("SetJob", result.data.job);
          this.loading = false;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    submit() {
      this.loadingSubmit = true;
      this.validationErrors = "";
      /**
       * boolean casting , 'false'/'true' => 0/1
       */
      let jobData = this.job;
      jobData.urgent = this.job.urgent ? 1 : 0;
      jobData.visibility = this.job.visibility ? 1 : 0;
      this.$store
        .dispatch("UpdateJob", jobData)
        .then((result) => {
          this.loadingSubmit = false;
          this.$router.push({
            name: "CompanyJobShow",
            params: { id: jobData.id },
          });
        })
        .catch((err) => {
          this.loadingSubmit = false;
          if (err.response.status === 422) {
            this.validationErrors = err.response.data.errors;
          }
        });
    },
  },
  mounted() {
    this.loadJob();
  },
};
</script>