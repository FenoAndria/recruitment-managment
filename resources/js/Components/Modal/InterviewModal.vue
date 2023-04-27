<template>
  <Modal modalId="interview">
    <h3 class="text-center text-xl">Interview planning</h3>
    <hr class="border border-green-400 my-1" />
    <div class="">
      <div class="flex space-x-2">
        <div class="x-form w-1/2">
          <label for="">Date</label>
          <input type="date" class="x-input" v-model="interview.date" />
        </div>
        <div class="x-form w-1/2">
          <label for="">Time</label>
          <input type="time" class="x-input" v-model="interview.time" />
        </div>
      </div>
      <div class="">
        <label for="">Details</label>
        <textarea
          cols="30"
          rows="2"
          class="x-textarea"
          v-model="interview.details"
        ></textarea>
      </div>
      <div class="">
        <SubmitButton
          class="btn-success btn-sm btn-block"
          @click.prevent="submit"
          :loading="this.loadingSubmit"
          >Save</SubmitButton
        >
      </div>
    </div>
  </Modal>
</template>
<script>
import Modal from "../Layouts/Modal.vue";
import SubmitButton from "../Layouts/SubmitButton.vue";

export default {
  name: "Interview",
  props: ["candidature"],
  data() {
    return {
      interview: {
        date: "",
        time: "",
        details: "",
      },
      loadingSubmit: false,
    };
  },
  components: {
    Modal,
    SubmitButton,
  },
  methods: {
    submit() {
      this.loadingSubmit = true;

      this.$store
        .dispatch("StoreInterview", {
          candidature: this.candidature,
          interview: this.interview,
        })
        .then((result) => {
          this.candidature.status = "interview";
          this.$store.dispatch("UpdateCandidature", this.candidature);
          this.loadingSubmit = false;
          console.log(result);
        })
        .catch((err) => {
          this.loadingSubmit = false;
          console.log(err.response.data);
        });
    },
  },
};
</script>