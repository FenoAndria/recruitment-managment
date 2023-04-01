<template>
  <CompanyLayout>
    <div class="">
      <h1 class="text-2xl">PROFILE</h1>
      <div class="">
            <router-link :to="{ name: 'CompanyProfileCreate' }">Create</router-link>
          </div>
      <div class="" v-if="loading">Loading profile...</div>
      <div class="" v-else>
        <div class="" v-if="company">
          <p>Name : {{ company.name }}</p>
          <p>
            Address : {{ company.address }} {{ company.city }}
            {{ company.country }}
          </p>
          <p>Phone : {{ company.phone }}</p>
          <p>Website : {{ company.website }}</p>
          <p>Description : {{ company.description }}</p>
          <p>Brand : </p>
          <img
            :src="'http://localhost:8000' + company.brand"
            alt="profile-image"
            class="
              w-52
              h-52
              object-cover
              rounded-full
              shadow-lg
              border-2 border-maroon
            "
          />
          <div class="">
            <router-link :to="{ name: 'CompanyProfileEdit' }">Edit</router-link>
          </div>
        </div>
      </div>
    </div>
  </CompanyLayout>
</template>
<script>
import CompanyLayout from "./../../../Components/Layouts/CompanyLayout.vue";
import { mapGetters } from "vuex";
export default {
  name: "CompanyProfile",
  data() {
    return {
      loading: false,
    };
  },
  components: {
    CompanyLayout,
  },
  computed: {
    ...mapGetters(["company"]),
  },
  methods: {
    async loadCompany() {
      this.loading = true;
      await this.$store
        .dispatch("GetCompany")
        .then((result) => {
          this.$store.commit("setCompany", result.data.company);
          this.loading = false;
          console.log(result);
        })
        .catch((err) => {
          this.loading = false;
          console.log(err);
        });
    },
  },
  created() {
    this.loadCompany();
  },
};
</script>