<template>
  <div
    class="
      bg-green-500
      text-white
      font-bold
      py-4
      px-6
      flex
      justify-between
      shadow-lg
    "
  >
    <div class="headTitle">
      <span id="documentTitle"></span>
    </div>
    <div class="space-x-2">
      <span class=""><i class="bi bi-person-circle"></i> {{ USER_DATA.email }}</span>
      <span class="btn btn-sm btn-warning" @click="logout">Logout</span>
    </div>
  </div>
</template>
<script>
import { mapGetters } from "vuex";
export default {
  name: "Navbar",
  computed: {
    ...mapGetters(["USER_DATA"]),
  },
  methods: {
    logout() {
      this.$store
        .dispatch("LOGOUT")
        .then(() => {
          localStorage.setItem("userToken", "");
          localStorage.setItem("vuex", "");
          location.reload();
        })
        .catch((err) => {
          console.log(err.response);
        });
    },
  },
  mounted() {
    document.getElementById("documentTitle").innerHTML = document.title;
  },
};
</script>