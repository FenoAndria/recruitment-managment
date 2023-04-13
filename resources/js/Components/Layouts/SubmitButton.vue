<template>
  <Button :class="this.loading ? ' loading' : ''"> <slot></slot> </Button>
</template>
<script>
import Button from "./../Layouts/Button.vue";
export default {
  name: "SubmitButton",
  props: ["loading"],
  components: {
    Button,
  },
};
</script>