<template>
  <Modal modalId="interview">
    <h3 class="text-center text-xl">Interview planning</h3>
    <hr class="border border-green-400 my-1" />
    <div class="">
      <div class="flex space-x-2">
        <div class="x-form w-1/2">
          <label for="">Date</label>
          <input type="date" class="x-input" />
        </div>
        <div class="x-form w-1/2">
          <label for="">Time</label>
          <input type="time" class="x-input" />
        </div>
      </div>
      <div class="">
        <label for="">Details</label>
        <textarea cols="30" rows="2" class="x-textarea"></textarea>
      </div>
      <div class="">
        <Button class="btn-success btn-sm btn-block "> Save</Button>
      </div>
    </div>
  </Modal>
</template>
<script>
import Modal from "../Layouts/Modal.vue";
import Button from "../Layouts/Button.vue";

export default {
  name: "Interview",
  components: {
    Modal,
    Button,
  },
};
</script>