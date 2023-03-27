<template>
  <div class="bg-green-500 text-white font-bold p-4 flex justify-between">
    <div class="space-x-4">
      <router-link :to="{ name: 'Dashboard' }">Dashboard</router-link>
    </div>
    <div class="">
      <span class="btn btn-sm btn-warning" @click="logout">Logout</span>
    </div>
  </div>
</template>
<script>
export default {
  name: "Navbar",
  methods: {
    logout() {
      this.$store.dispatch("LOGOUT").then(() => {
        this.$router.push({ name: "Login" });
      });
    },
  },
};
</script>