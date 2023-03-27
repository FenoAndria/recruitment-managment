<template>
  <div>
    <h1>Login</h1>
    <div class="">
      <form @submit.prevent="login">
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
        <button class="btn btn-sm btn-success">Sign in</button>
      </form>
    </div>
    <div class="">
      <label
        >Don't have an account?
        <router-link
          :to="{ name: 'Register' }"
          class="text-teal-600 hover:text-teal-900"
          >Register Now!</router-link
        ></label
      >
    </div>
  </div>
</template>
<script>
import API from "./../../Services/API";
export default {
  name: "Login",
  data() {
    return {
      user: {
        email: "",
        password: "",
      },
    };
  },
  methods: {
    login() {
      API()
        .post("/auth/login", this.user)
        .then((result) => {
          // console.log(result);
          this.$router.push({ name: "Dashboard" });
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>