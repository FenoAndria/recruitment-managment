<template>
  <CompanyLayout>
    <div class="flex items-center justify-center">
      <Card class="w-3/4">
        <div>
          <form @submit.prevent="submit">
            <div class="x-form">
              <label for="">Title</label>
              <input type="text" v-model="job.title" class="x-input" />
            </div>
            <div class="x-form">
              <label for="">Deadline</label>
              <input type="date" v-model="job.deadline" class="x-input" />
            </div>
            <div class="x-form">
              <label for="">Description</label>
              <textarea
                cols="30"
                rows="2"
                v-model="job.description"
                class="x-textarea"
              ></textarea>
            </div>
            <div class="x-form">
              <label for="">Missions</label>
              <textarea
                cols="30"
                rows="2"
                v-model="job.missions"
                class="x-textarea"
              ></textarea>
            </div>
            <div class="x-form">
              <label for="">Profile required</label>
              <textarea
                cols="30"
                rows="2"
                v-model="job.profile_required"
                class="x-textarea"
              ></textarea>
            </div>
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
import CompanyLayout from "./../../../Components/Layouts/CompanyLayout.vue";
import Card from "./../../../Components/Layouts/Card.vue";
import SubmitButton from "./../../../Components/Layouts/SubmitButton.vue";

export default {
  name: "CompanyJobCreate",
  data() {
    return {
      loading: false,
      job: {
        title: "dev C++",
        deadline: "2023-05-12",
        description: "",
        missions: "",
        profile_required: "",
        urgent: false,
        visibility: false,
      },
      loadingSubmit: false,
    };
  },
  components: {
    CompanyLayout,
    Card,
    SubmitButton,
  },
  methods: {
    submit() {
      this.loadingSubmit = true;
      /**
       * boolean casting , 'false'/'true' => 0/1
       */
      let jobData = this.job;
      jobData.urgent = this.job.urgent ? 1 : 0;
      jobData.visibility = this.job.visibility ? 1 : 0;
      this.$store
        .dispatch("SaveJob", jobData)
        .then((result) => {
          this.loadingSubmit = false;
          this.$router.push({
            name: "CompanyJobsIndex",
          });
          console.log(result.data.job);
        })
        .catch((err) => {
          this.loadingSubmit = false;
          console.log(err);
        });
    },
  },
};
</script>