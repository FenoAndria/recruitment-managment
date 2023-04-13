<template>
  <!-- <div v-if="this.$props.error"> -->
  <Alert>
    <!-- <i class="bi bi-info-circle"></i> -->
    <slot></slot>
  </Alert>
  <!-- </div> -->
</template>
<script>
import Alert from "./Alert.vue";
export default {
  name: "SingleError",
  props: ["error", "column"],
  components: {
    Alert,
  },
};
</script>