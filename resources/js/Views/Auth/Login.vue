<template>
  <GuestLayout class="h-screen flex justify-center items-center">
    <Card class="w-1/3 bg-green-500 py-16">
      <h2 class="text-center text-gray-200 font-bold text-2xl mb-2">
        Recruitment App
      </h2>
      <hr />
      <h2 class="text-3xl text-white text-center mb-2">Login</h2>
      <div class="">
        <div class="" v-if="this.userNotAuthenticated">
          <SingleError :error="feno"
            >{{ this.userNotAuthenticated }}
          </SingleError>
        </div>
        <form @submit.prevent="login">
          <div class="x-form">
            <ValidationError :errors="validationErrors" column="email" />
            <label for="email" class="text-white">Email</label>
            <input class="x-input" type="text" v-model="user.email" />
          </div>
          <div class="x-form">
            <ValidationError :errors="validationErrors" column="password" />
            <label for="password" class="text-white">Password</label>
            <input class="x-input" type="password" v-model="user.password" />
          </div>
          <SubmitButton
            :loading="this.loadingSubmit"
            class="btn-success btn-block text-lg"
          >
            Sign in
          </SubmitButton>
        </form>
      </div>
      <div class="text-right">
        <label class="text-white"
          >Don't have an account ?
          <router-link
            :to="{ name: 'Register' }"
            class="text-gray-600 hover:text-gray-900"
            >Register Now!</router-link
          ></label
        >
      </div>
    </Card>
  </GuestLayout>
</template>
<script>
import GuestLayout from "./../../Components/Layouts/GuestLayout.vue";
import SubmitButton from "./../../Components/Layouts/SubmitButton.vue";
import Card from "./../../Components/Layouts/Card.vue";
import ValidationError from "./../../Components/Layouts/ValidationError.vue";
import SingleError from "./../../Components/Layouts/SingleError.vue";

export default {
  name: "Login",
  data() {
    return {
      user: {
        email: "",
        password: "",
      },
      loadingSubmit: false,
      validationErrors: "",
      userNotAuthenticated: false,
    };
  },
  methods: {
    login() {
      this.loadingSubmit = true;
      this.validationErrors = "";
      this.userNotAuthenticated = "";
      this.$store
        .dispatch("LOGIN", this.user)
        .then((result) => {
          this.loadingSubmit = false;
          this.$store.commit("SET_USER_DATA", result.data.user);
          localStorage.setItem("userToken", result.data.user.token);
          location.reload();
        })
        .catch((err) => {
          this.loadingSubmit = false;
          // console.log(err.response);
          if (err.response.status === 422) {
            this.validationErrors = err.response.data.errors;
          }
          if (err.response.status === 401) {
            this.userNotAuthenticated = err.response.data.errors;
          }
        });
    },
  },
  components: {
    GuestLayout,
    Card,
    SubmitButton,
    ValidationError,
    SingleError,
  },
};
</script>