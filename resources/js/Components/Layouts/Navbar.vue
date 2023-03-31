<template>
  <div class="bg-green-500 text-white font-bold p-4 flex justify-between">
    <div class="space-x-4">
      <router-link :to="{ name: 'Dashboard' }">Dashboard</router-link>
      <router-link :to="{ name: 'CompanyProfileIndex' }">My company</router-link>
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
      this.$store
        .dispatch("LOGOUT")
        .then(() => {
          localStorage.setItem('userToken','')
          location.reload();
          // this.$router.push({ name: "Login" });
        })
        .catch((err) => {
          console.log(err.response);
        });
    },
  },
};
</script>