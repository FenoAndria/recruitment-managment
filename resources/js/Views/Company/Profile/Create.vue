<template>
  <CompanyLayout>
    <h1 class="text-2xl">PROFILE CREATE</h1>
    <div class="">
      <form @submit.prevent="storeCompany">
        <div class="">
          <label for="">Brand</label>
          <input type="file" @change="fileChanged" />
        </div>
        <div class="">
          <label for="">Name</label>
          <input type="text" v-model="this.company.name" />
        </div>
        <div class="">
          <label for="">Address</label>
          <input type="text" v-model="this.company.address" />
        </div>
        <div class="">
          <label for="">City</label>
          <input type="text" v-model="this.company.city" />
        </div>
        <div class="">
          <label for="">Country</label>
          <input type="text" v-model="this.company.country" />
        </div>
        <div class="">
          <label for="">Phone</label>
          <input type="text" v-model="this.company.phone" />
        </div>
        <div class="">
          <label for="">Website</label>
          <input type="text" v-model="this.company.website" />
        </div>
        <div class="">
          <label for="">Description</label>
          <input type="text" v-model="this.company.description" />
        </div>
        <button class="btn">UPDATE</button>
      </form>
    </div>
  </CompanyLayout>
</template>
<script>
import { mapGetters } from "vuex";
import CompanyLayout from "./../../../Components/Layouts/CompanyLayout.vue";
export default {
  name: "CompanyProfileEdit",
  data() {
    return {
      loading: false,
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
    CompanyLayout,
  },
  computed: {},
  methods: {
    fileChanged(e) {
      this.company.brand = e.target.files[0];
    },
    async storeCompany() {
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
          console.log(result.data.company);
          // this.$router.push({ name: "CompanyProfileIndex" });
        })
        .catch((err) => {
          console.log(err.response);
        });
    },
  },
  created() {
    
  },
};
</script>