<template>
  <CompanyLayout>
    <div class="flex items-center justify-center">
      <Card class="w-3/4 py-16">
        <div class="" v-if="loading">Loading profile...</div>
        <div class="" v-else>
          <div
            class="flex flex-wrap items-center justify-center"
            v-if="company"
          >
            <div class="w-1/2">
              <p class="text-3xl text-green-500 text-center font-semibold">
                {{ company.name }}
              </p>
              <hr class="border-2 border-gray-200 my-1 rounded-lg" />
              <div class="space-y-2">
                <p>
                  <i class="bi bi-geo-alt"></i> {{ company.address }}
                  {{ company.city }}
                  {{ company.country }}
                </p>
                <p><i class="bi bi-phone"></i> {{ company.phone }}</p>
                <p><i class="bi bi-globe"></i> {{ company.website }}</p>
                <p>
                  <i class="bi bi-list-nested"></i> {{ company.description }}
                </p>
              </div>
              <div class="float-right">
                <router-link :to="{ name: 'CompanyProfileEdit' }" class="py-1 px-2 text-green-500 font-bold hover:shadow hover:bg-green-500 hover:text-white transition-all rounded">
                  <i class="bi bi-pencil-square"></i>
                </router-link>
              </div>
            </div>
            <div class="w-1/2 flex justify-center items-center">
              <img
                :src="'http://localhost:8000' + company.brand"
                alt="profile-image"
                class="
                  w-64
                  h-64
                  object-cover
                  rounded-full
                  shadow-lg
                  border-2 border-maroon
                "
              />
            </div>
          </div>
        </div>
      </Card>
    </div>
  </CompanyLayout>
</template>
<script>
import CompanyLayout from "./../../../Components/Layouts/CompanyLayout.vue";
import Card from "./../../../Components/Layouts/Card.vue";
import Button from "./../../../Components/Layouts/Button.vue";
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
    Card,
    Button,
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