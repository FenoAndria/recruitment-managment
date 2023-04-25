<template>
  <div>
    <input type="checkbox" :id="this.modalId" class="modal-toggle" />
    <label :for="this.modalId" class="modal cursor-pointer">
      <label class="modal-box relative" for="">
        <slot></slot>
      </label>
    </label>
  </div>
</template>
<script>
export default {
  name: "Modal",
  props: ["modalId"],
};
</script>