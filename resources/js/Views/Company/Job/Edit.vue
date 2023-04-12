<template>
  <CompanyLayout>
    <h1>Job edit</h1>
    <div v-if="loading">LOADING JOB...</div>
    <div v-else>
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
import { mapGetters } from "vuex";
import CompanyLayout from "./../../../Components/Layouts/CompanyLayout.vue";
export default {
  name: "CompanyJobEdit",
  data() {
    return {
      loading: false,
    };
  },
  components: {
    CompanyLayout,
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
      /**
       * boolean casting , 'false'/'true' => 0/1
       */
      this.job.urgent = this.job.urgent == true ? 1 : 0;
      this.job.visibility = this.job.visibility == true ? 1 : 0;
      this.$store
        .dispatch("UpdateJob", this.job)
        .then((result) => {
          console.log(result);
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
  mounted() {
    this.loadJob();
  },
};
</script>