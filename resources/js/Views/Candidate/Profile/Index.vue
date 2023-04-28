<template>
  <CandidateLayout>
    <div class="" v-if="loading"><Loader /></div>
    <div v-else class="flex items-center justify-center">
      <Card class="w-3/4 py-16">
        <div class="">
          <div
            class="flex flex-wrap items-center justify-center"
            v-if="candidate"
          >
            <div class="w-1/2">
              <p class="text-3xl text-green-500 text-center font-semibold">
                {{ candidate.first_name }}
                {{ candidate.last_name }}
              </p>
              <hr class="border-2 border-gray-200 my-1 rounded-lg" />
              <div class="space-y-2">
                <p>
                  <i class="bi bi-geo-alt"></i> {{ candidate.address }}
                  {{ candidate.city }}
                  {{ candidate.country }}
                </p>
                <p><i class="bi bi-phone"></i> {{ candidate.phone }}</p>
                <p>
                  <i class="bi bi-calendar-heart"></i>
                  {{ this.$dayjs(candidate.birth_date).format("DD MMM YYYY") }}
                </p>
                <p>
                  <i class="bi bi-list-nested"></i>
                  <span v-if="candidate.bio">{{ candidate.bio }}</span>
                  <span
                    v-else
                    class="badge badge-error text-white font-semibold"
                  >
                    EMPTY</span
                  >
                </p>
                <p class="badge" v-if="candidate.resume">
                  <i class="bi bi-file-person"></i>
                  <a :href="candidate.resume">Resume</a>
                </p>
                <p class="badge badge-error text-white font-semibold" v-else>
                  <i class="bi bi-file-person"></i>
                    Resume empty!
                </p>
              </div>
              <div class="float-right">
                <router-link
                  :to="{ name: 'CandidateProfileEdit' }"
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
                :src="'http://localhost:8000' + candidate.photo"
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
  </CandidateLayout>
</template>
<script>
import { mapGetters } from "vuex";
import CandidateLayout from "./../../../Components/Layouts/CandidateLayout.vue";
import Card from "./../../../Components/Layouts/Card.vue";
import Loader from "./../../../Components/Layouts/Loader.vue";
export default {
  name: "CandidateProfileIndex",
  data() {
    return {
      loading: false,
    };
  },
  components: {
    CandidateLayout,
    Card,
    Loader,
  },
  computed: {
    ...mapGetters(["candidate"]),
  },
  methods: {
    loadCandidate() {
      this.loading = true;
      this.$store
        .dispatch("GetCandidate")
        .then((result) => {
          this.$store.commit("setCandidate", result.data.candidate);
          this.loading = false;
          //   console.log(result.data.candidate);
        })
        .catch((err) => {
          this.loading = false;
          console.log(err);
        });
    },
  },
  mounted() {
    this.loadCandidate();
  },
};
</script>