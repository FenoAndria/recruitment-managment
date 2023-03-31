<template>
  <GuestLayout>
    <h1>REGISTER</h1>
    <div class="">
      <form @submit.prevent="register">
        <div class="">
          <label for="email">Email</label>
          <input
            class="input input-bordered input-sm"
            type="text"
            v-model="user.email"
          />
        </div>
        <div class="">
          <label for="password">Password</label>
          <input type="text" v-model="user.password" />
        </div>
        <div class="">
          <label for="role_id">
            Company
            <input
              type="radio"
              class="radio radio-sm radio-success"
              v-model="user.role_id"
              value="1"
              checked
            />
          </label>
          <label for="role_id">
            Candidate
            <input
              type="radio"
              class="radio radio-sm radio-success"
              v-model="user.role_id"
              value="2"
            />
          </label>
        </div>
        <button class="btn btn-success btn-sm">Sign up</button>
      </form>
    </div>
    <div class="">
      <label
        >Do you have already an account?
        <router-link
          :to="{ name: 'Login' }"
          class="text-teal-600 hover:text-teal-900"
          >Sign In!</router-link
        ></label
      >
    </div>
  </GuestLayout>
</template>
<script>
import GuestLayout from './../../Components/Layouts/GuestLayout.vue'

export default {
  name: "Register",
  data() {
    return {
      user: {
        email: "",
        password: "",
        role_id: 1,
      },
    };
  },
  methods: {
    register() {
      this.$store
        .dispatch("REGISTER", this.user)
        .then((result) => {
          // console.log(result);
          localStorage.setItem("userToken", result.data.user.token);
          location.reload();
          // this.$router.push({ name: "Dashboard" });
        })
        .catch((err) => {
          console.log(err.response);
        });
    },
  },
  components: {
    GuestLayout,
  },
};
</script>