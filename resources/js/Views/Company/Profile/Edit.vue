<template>
  <CompanyLayout>
    <h1 class="text-2xl">PROFILE EDIT</h1>
    <div class="" v-if="loading">Loading profile...</div>
    <div class="" v-else>
      <div class="" v-if="company">
        <form @submit.prevent="updateCompany">
          <div class="">
            <label for="">Brand</label>
            <input type="file" @change="fileChanged" />
          </div>
          <div class="">
            <label for="">Name</label>
            <input type="text" v-model="company.name" />
          </div>
          <div class="">
            <label for="">Address</label>
            <input type="text" v-model="company.address" />
          </div>
          <div class="">
            <label for="">City</label>
            <input type="text" v-model="company.city" />
          </div>
          <div class="">
            <label for="">Country</label>
            <input type="text" v-model="company.country" />
          </div>
          <div class="">
            <label for="">Phone</label>
            <input type="text" v-model="company.phone" />
          </div>
          <div class="">
            <label for="">Website</label>
            <input type="text" v-model="company.website" />
          </div>
          <div class="">
            <label for="">Description</label>
            <input type="text" v-model="company.description" />
          </div>
          <button class="btn">UPDATE</button>
        </form>
      </div>
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
    fileChanged(e) {
      this.company.brand = e.target.files[0];
    },
    async updateCompany() {
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
        .dispatch("UpdateCompany", companyData)
        .then((result) => {
					console.log(result.data.company);
					this.$router.push({name:'CompanyProfileIndex'})
				})
        .catch((err) => {
					console.log(err);
				});
    },
  },
  created() {
    this.loadCompany();
  },
};
</script>