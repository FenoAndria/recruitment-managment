<template>
  <div class="bg-green-500 text-white font-bold p-4 flex justify-between shadow-lg">
    <div class=""></div>
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
          localStorage.setItem("userToken", "");
          location.reload();
        })
        .catch((err) => {
          console.log(err.response);
        });
    },
  },
};
</script>