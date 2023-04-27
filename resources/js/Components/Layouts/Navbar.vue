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
      <div class="dropdown dropdown-end">
        <img
          tabindex="0"
          :src="'http://localhost:8000' + user.photo"
          alt="profile-image"
          class="
            w-8
            h-8
            object-cover
            rounded-full
            shadow-lg
            border border-white
            cursor-pointer
          "
        />
        <div
          tabindex="0"
          class="
            dropdown-content
            menu
            p-2
            shadow
            bg-base-100
            rounded-lg
            w-52
            text-green-500 text-center
          "
        >
          <span>
            <a>{{ this.user.name }}</a>
          </span>
          <hr class="border my-1" />
          <span class="btn btn-sm btn-default" @click="logout"
            ><i class="bi bi-power"></i>Logout</span
          >
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { mapGetters } from "vuex";
export default {
  name: "Navbar",
  data() {
    return {
      user: {
        name: "",
        photo: "",
      },
    };
  },
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
    this.user.name = this.USER_DATA.company
      ? this.USER_DATA.company.name
      : this.USER_DATA.candidate.first_name +
        "" +
        this.USER_DATA.candidate.last_name;
    this.user.photo = this.USER_DATA.company
      ? this.USER_DATA.company.brand
      : this.USER_DATA.candidate.photo;
  },
};
</script>