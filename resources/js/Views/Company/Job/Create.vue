<template>
  <CompanyLayout>
    <h1>Job create</h1>
    <div>
      <form @submit.prevent="submit">
        <div class="">
          <label for="">Title</label>
          <input type="text" v-model="job.title" />
        </div>
        <div class="">
          <label for="">Deadline</label>
          <input type="date" v-model="job.deadline" />
        </div>
        <div class="">
          <label for="">Description</label>
          <textarea cols="30" rows="2" v-model="job.description"></textarea>
        </div>
        <div class="">
          <label for="">Missions</label>
          <textarea cols="30" rows="2" v-model="job.missions"></textarea>
        </div>
        <div class="">
          <label for="">Profile required</label>
          <textarea
            cols="30"
            rows="2"
            v-model="job.profile_required"
          ></textarea>
        </div>
        <div class="">
          <label for="">Urgent</label>
          <input type="checkbox" v-model="job.urgent" />
        </div>
        <div class="">
          <label for="">Visibility</label>
          <input type="checkbox" v-model="job.visibility" />
        </div>
        <div class="">
          <button class="btn">Submit</button>
        </div>
      </form>
    </div>
  </CompanyLayout>
</template>
<script>
import CompanyLayout from "./../../../Components/Layouts/CompanyLayout.vue";
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
    };
  },
  components: {
    CompanyLayout,
  },
  methods: {
    submit() {
      /**
       * boolean casting , 'false'/'true' => 0/1
       */
      this.job.urgent = this.job.urgent == true ? 1 : 0;
      this.job.visibility = this.job.visibility == true ? 1 : 0;
      this.$store.dispatch("SaveJob", this.job);
      console.log(this.job.urgent);
    },
  },
};
</script>