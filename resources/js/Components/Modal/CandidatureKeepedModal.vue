<template>
  <Modal modalId="keeped">
    <div class="text-center">
      <p class="text-lg">This candidate will be keeped. Are you sure?</p>
      <div class="flex justify-center space-x-4">
        <Button class="btn-sm btn-success">yes </Button>
        <Button class="btn-sm btn-default">No </Button>
      </div>
    </div>
  </Modal>
</template>
<script>
import Modal from "./..//Layouts/Modal.vue";
import Button from "./..//Layouts/Button.vue";

export default {
  name: "CandidatureKeepedModal",
  components: {
    Modal,
    Button,
  },
};
</script>