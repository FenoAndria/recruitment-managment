<template>
  <Modal modalId="keeped">
    <div class="text-center">
      <p class="text-lg">This candidate will be keeped. Are you sure?</p>
      <div class="flex justify-center space-x-4">
        <SubmitButton
          class="btn-sm btn-success"
          :loading="this.loadingSubmit"
          @click.prevent="submit"
          >yes
        </SubmitButton>
        <Button class="btn-sm btn-default">No </Button>
      </div>
    </div>
  </Modal>
</template>
<script>
import Modal from "./..//Layouts/Modal.vue";
import Button from "./..//Layouts/Button.vue";
import SubmitButton from "./..//Layouts/SubmitButton.vue";

export default {
  name: "CandidatureKeepedModal",
  props: ["candidature"],
  data() {
    return {
      loadingSubmit: false,
    };
  },
  components: {
    Modal,
    Button,
    SubmitButton,
  },
   methods: {
    submit() {
      this.loadingSubmit = true;
      this.candidature.status = "keeped";
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
};
</script>