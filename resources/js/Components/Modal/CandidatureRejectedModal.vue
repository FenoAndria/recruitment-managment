<template>
  <Modal modalId="rejected"
    ><p class="text-lg">This candidate will be rejected. Are you sure?</p>
    <div class="flex justify-center space-x-4">
      <Button class="btn-sm btn-error">yes </Button>
      <Button class="btn-sm btn-default">No </Button>
    </div></Modal
  >
</template>
<script>
import Modal from "./..//Layouts/Modal.vue";
import Button from "./..//Layouts/Button.vue";

export default {
  name: "CandidatureRejectedModal",
  components: {
    Modal,
    Button,
  },
};
</script>