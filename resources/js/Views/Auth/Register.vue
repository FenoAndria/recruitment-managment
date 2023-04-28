<template>
  <GuestLayout class="h-screen flex justify-center items-center">
    <Card class="w-1/3 bg-green-500 py-16">
      <h2 class="text-center text-gray-200 font-bold text-2xl mb-2">
        Recruitment App
      </h2>
      <hr />
      <h2 class="text-3xl text-white text-center mb-2">Register</h2>
      <div class="">
        <form @submit.prevent="register">
          <div class="x-form">
            <ValidationError :errors="validationErrors" column="email" />
            <label for="email" class="text-white">Email</label>
            <input class="x-input" type="text" v-model="user.email" />
          </div>
          <div class="x-form">
            <ValidationError :errors="validationErrors" column="password" />
            <label for="password" class="text-white">Password</label>
            <input class="x-input" type="text" v-model="user.password" />
          </div>
          <div class="text-white inline">
            <ValidationError :errors="validationErrors" column="role_id" />
            <label for="role_id">
              <input
                type="radio"
                class="radio radio-sm radio-success"
                v-model="user.role_id"
                value="1"
                checked
              />
              Company
            </label>
            <label for="role_id">
              <input
                type="radio"
                class="radio radio-sm radio-success"
                v-model="user.role_id"
                value="2"
              />
              Candidate
            </label>
          </div>
          <SubmitButton
            :loading="this.loadingSubmit"
            class="btn-success btn-block text-lg"
          >
            Sign up
          </SubmitButton>
        </form>
      </div>
      <div class="text-right text-white">
        <label
          >Do you have already an account?
          <router-link
            :to="{ name: 'Login' }"
            class="text-gray-600 hover:text-gray-900"
            >Sign In!</router-link
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
  name: "Register",
  data() {
    return {
      user: {
        email: "",
        password: "",
        role_id: 1,
      },
      loadingSubmit: false,
      validationErrors: "",
    };
  },
  methods: {
    register() {
      this.loadingSubmit = true;
      this.validationErrors = "";
      this.$store
        .dispatch("REGISTER", this.user)
        .then((result) => {
          this.loadingSubmit = false;
          this.$store.commit("SET_USER_DATA", result.data.user);
          localStorage.setItem("userToken", result.data.user.token);
          location.reload(); 
        })
        .catch((err) => {
          this.loadingSubmit = false;
          if (err.response.status === 422) {
            this.validationErrors = err.response.data.errors;
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