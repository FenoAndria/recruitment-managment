<template>
  <div class="px-4 py-2 rounded bg-red-300 text-red-700 font-semibold block shadow transition-all text-sm">
    <slot></slot>
  </div>
</template>
<script>
export default {
  name: "Alert",
};
</script>