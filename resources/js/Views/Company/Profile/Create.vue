<template>
  <NoProfileLayout :links="[{ tag: 'Profile', name: 'CompanyProfileCreate' }]">
    <div class="flex justify-center">
      <Card class="w-3/4">
        <form @submit.prevent="storeCompany">
          <div class="x-form">
            <label for="">Brand</label>
            <input type="file" @change="fileChanged" class="x-input" />
          </div>
          <div class="x-form">
            <label for="">Name</label>
            <input type="text" v-model="this.company.name" class="x-input" />
          </div>
          <div class="x-form">
            <label for="">Address</label>
            <input type="text" v-model="this.company.address" class="x-input" />
          </div>
          <div class="x-form">
            <label for="">City</label>
            <input type="text" v-model="this.company.city" class="x-input" />
          </div>
          <div class="x-form">
            <label for="">Country</label>
            <input type="text" v-model="this.company.country" class="x-input" />
          </div>
          <div class="x-form">
            <label for="">Phone</label>
            <input type="text" v-model="this.company.phone" class="x-input" />
          </div>
          <div class="x-form">
            <label for="">Website</label>
            <input type="text" v-model="this.company.website" class="x-input" />
          </div>
          <div class="x-form">
            <label for="">Description</label>
            <textarea
              v-model="this.company.description"
              class="x-textarea"
              cols="30"
              rows="2"
            ></textarea>
          </div>
          <SubmitButton
            :loading="this.loadingSubmit"
            class="btn-sm btn-success btn-block"
            >Save</SubmitButton
          >
        </form>
      </Card>
    </div>
  </NoProfileLayout>
</template>
<script>
import { mapGetters } from "vuex";
import NoProfileLayout from "./../../../Components/Layouts/NoProfileLayout.vue";
import Card from "./../../../Components/Layouts/Card.vue";
import SubmitButton from "./../../../Components/Layouts/SubmitButton.vue";
export default {
  name: "CompanyProfileCreate",
  data() {
    return {
      loadingSubmit: false,
      company: {
        brand: "",
        name: "Savony tropicale",
        address: "Manga",
        city: "Mahajanga",
        country: "Madagascar",
        phone: "641258123",
        website: "savony.com",
        description: "",
      },
    };
  },
  components: {
    NoProfileLayout,
    Card,
    SubmitButton,
  },
  computed: {},
  methods: {
    fileChanged(e) {
      this.company.brand = e.target.files[0];
    },
    async storeCompany() {
      this.loadingSubmit = true;
      let companyData = new FormData();
      companyData.append("brand", this.company.brand);
      companyData.append("name", this.company.name);
      companyData.append("address", this.company.address);
      companyData.append("city", this.company.city);
      companyData.append("country", this.company.country);
      companyData.append("phone", this.company.phone);
      companyData.append("website", this.company.website);
      companyData.append("description", this.company.description);
      this.$store
        .dispatch("StoreCompany", companyData)
        .then((result) => {
          this.$store.commit("SET_COMPANY", result.data.company);
          location.reload();
          this.loadingSubmit = false;
          // this.$router.push({ name: "CompanyProfileIndex" });
        })
        .catch((err) => {
          this.loadingSubmit = false;
          console.log(err.response);
        });
    },
  },
  created() {},
};
</script>