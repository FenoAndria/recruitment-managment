<template>
  <CandidateLayout>
    <div class="flex items-center justify-center">
      <Card class="w-3/4 py-16">
        <div class="flex flex-wrap items-center justify-center">
          <div class="w-1/2">
            <p class="text-3xl text-green-500 text-center font-semibold">
              {{ USER_DATA.candidate.first_name }}
              {{ USER_DATA.candidate.last_name }}
            </p>
            <hr class="border-2 border-gray-200 my-1 rounded-lg" />
            <div class="space-y-2">
              <p>
                <i class="bi bi-geo-alt"></i> {{ USER_DATA.candidate.address }}
                {{ USER_DATA.candidate.city }}
                {{ USER_DATA.candidate.country }}
              </p>
              <p><i class="bi bi-phone"></i> {{ USER_DATA.candidate.phone }}</p>
              <p>
                <i class="bi bi-calendar-heart"></i>
                {{ USER_DATA.candidate.birth_date }}
              </p>
              <p>
                <i class="bi bi-list-nested"></i>
                <!-- {{ USER_DATA.candidate.bio ?? "Empty" }} -->
                <span v-if="USER_DATA.candidate.bio">{{USER_DATA.candidate.bio}}</span>
                <span v-else class="badge badge-error text-white font-semibold"> EMPTY</span>
              </p>
            </div>
            <div class="float-right">
              <router-link
                :to="{ name: 'CompanyProfileEdit' }"
                class="
                  py-1
                  px-2
                  text-green-500
                  font-bold
                  hover:shadow
                  hover:bg-green-500
                  hover:text-white
                  transition-all
                  rounded
                "
              >
                <i class="bi bi-pencil-square"></i>
              </router-link>
            </div>
          </div>
          <div class="w-1/2 flex justify-center items-center">
            <img
              :src="'http://localhost:8000' + USER_DATA.candidate.photo"
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
      </Card>
    </div>
  </CandidateLayout>
</template>
<script>
import { mapGetters } from "vuex";
import CandidateLayout from "./../../../Components/Layouts/CandidateLayout.vue";
export default {
  name: "CandidateProfileIndex",
  data() {
    return {
      loading: false,
    };
  },
  components: {
    CandidateLayout,
  },
  computed: {
    ...mapGetters(["USER_DATA"]),
  },
  methods: {
    loadCandidate() {
      // this.loading = true
      console.log(this.$store.getters.USER_DATA.candidate);
    },
  },
  mounted() {
    this.loadCandidate();
  },
};
</script>