<template>
  <CompanyLayout>
    <div class="" v-if="loading"><Loader /></div>
    <div class="flex items-center justify-center" v-else>
      <Card class="w-3/4">
        <div class="" v-if="loading">Loading profile...</div>
        <div class="" v-else>
          <div class="" v-if="company">
            <form @submit.prevent="updateCompany">
              <div class="x-form">
                <ValidationError :errors="validationErrors" column="brand" />
                <label for="">Brand</label>
                <input class="x-input" type="file" @change="fileChanged" />
              </div>
              <div class="x-form">
                <ValidationError :errors="validationErrors" column="name" />
                <label for="">Name</label>
                <input class="x-input" type="text" v-model="company.name" />
              </div>
              <div class="x-form">
                <ValidationError :errors="validationErrors" column="address" />
                <label for="">Address</label>
                <input class="x-input" type="text" v-model="company.address" />
              </div>
              <div class="x-form">
                <ValidationError :errors="validationErrors" column="city" />
                <label for="">City</label>
                <input class="x-input" type="text" v-model="company.city" />
              </div>
              <div class="x-form">
                <ValidationError :errors="validationErrors" column="country" />
                <label for="">Country</label>
                <input class="x-input" type="text" v-model="company.country" />
              </div>
              <div class="x-form">
                <ValidationError :errors="validationErrors" column="phone" />
                <label for="">Phone</label>
                <input class="x-input" type="text" v-model="company.phone" />
              </div>
              <div class="x-form">
                <ValidationError :errors="validationErrors" column="website" />
                <label for="">Website</label>
                <input class="x-input" type="text" v-model="company.website" />
              </div>
              <div class="x-form">
                <ValidationError :errors="validationErrors" column="description" />
                <label for="">Description</label>
                <textarea
                  class="x-textarea"
                  id=""
                  cols="30"
                  rows="2"
                  v-model="company.description"
                ></textarea>
              </div>
              <div class="mt-2">
                <SubmitButton
                  class="btn-sm btn-success btn-block"
                  :loading="this.loadingSubmit"
                  >Save</SubmitButton
                >
              </div>
            </form>
          </div>
        </div>
      </Card>
    </div>
  </CompanyLayout>
</template>
<script>
import { mapGetters } from "vuex";
import CompanyLayout from "./../../../Components/Layouts/CompanyLayout.vue";
import Card from "./../../../Components/Layouts/Card.vue";
import SubmitButton from "./../../../Components/Layouts/SubmitButton.vue";
import ValidationError from "./../../../Components/Layouts/ValidationError.vue";
import Loader from "./../../../Components/Layouts/Loader.vue";
export default {
  name: "CompanyProfileEdit",
  data() {
    return {
      loading: false,
      loadingSubmit: false,
      validationErrors: "",
      brand:''
    };
  },
  components: {
    CompanyLayout,
    Card,
    SubmitButton,
    ValidationError,
    Loader
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
    fileChanged(e) {
      this.brand = e.target.files[0];
    },
    async updateCompany() {
      this.loadingSubmit = true;
      this.validationErrors = '';
      let companyData = new FormData();
      companyData.append("brand", this.brand);
      companyData.append("name", this.company.name);
      companyData.append("address", this.company.address);
      companyData.append("city", this.company.city);
      companyData.append("country", this.company.country);
      companyData.append("phone", this.company.phone);
      companyData.append("website", this.company.website);
      companyData.append("description", this.company.description);
      console.log(companyData);
      this.$store
        .dispatch("UpdateCompany", companyData)
        .then((result) => {
          console.log(result.data.company);
          this.$router.push({ name: "CompanyProfileIndex" });
          this.loadingSubmit = false;
        })
        .catch((err) => {
          this.loadingSubmit = false;
          if (err.response.status === 422) {
            this.validationErrors = err.response.data.errors;
          }
        });
    },
  },
  created() {
    this.loadCompany();
  },
};
</script>