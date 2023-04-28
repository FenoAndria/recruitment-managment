<template>
  <NoProfileLayout :links="[{ tag: 'Profile', name: 'CandidateProfileCreate' }]">
    <div class="flex items-center justify-center">
      <Card class="w-3/4">
        <form @submit.prevent="storeCandidate">
          <div class="x-form">
            <ValidationError :errors="validationErrors" column="photo" />
            <label for="">Photo</label>
            <input class="x-input" type="file" @change="photoFile" />
          </div>
          <div class="x-form">
            <ValidationError :errors="validationErrors" column="first_name" />
            <label for="">First name</label>
            <input class="x-input" type="text" v-model="candidate.first_name" />
          </div>
          <div class="x-form">
            <ValidationError :errors="validationErrors" column="last_name" />
            <label for="">Last name</label>
            <input class="x-input" type="text" v-model="candidate.last_name" />
          </div>
          <div class="x-form">
            <ValidationError :errors="validationErrors" column="birth_date" />
            <label for="">Birth date</label>
            <input class="x-input" type="date" v-model="candidate.birth_date" />
          </div>
          <div class="x-form">
            <ValidationError :errors="validationErrors" column="address" />
            <label for="">Address</label>
            <input class="x-input" type="text" v-model="candidate.address" />
          </div>
          <div class="x-form">
            <ValidationError :errors="validationErrors" column="city" />
            <label for="">City</label>
            <input class="x-input" type="text" v-model="candidate.city" />
          </div>
          <div class="x-form">
            <ValidationError :errors="validationErrors" column="country" />
            <label for="">Country</label>
            <input class="x-input" type="text" v-model="candidate.country" />
          </div>
          <div class="x-form">
            <ValidationError :errors="validationErrors" column="phone" />
            <label for="">Phone</label>
            <input class="x-input" type="text" v-model="candidate.phone" />
          </div>

          <div class="x-form">
            <ValidationError :errors="validationErrors" column="bio" />
            <label for="">Bio</label>
            <textarea
              class="x-textarea"
              id=""
              cols="30"
              rows="2"
              v-model="candidate.bio"
            ></textarea>
          </div>
          <div class="x-form">
            <ValidationError :errors="validationErrors" column="resume" />
            <label for="">Resume</label>
            <input class="x-input" type="file" @change="resumeFile" />
          </div>
          <div class="mt-2">
            <SubmitButton
              class="btn-sm btn-success btn-block"
              :loading="this.loadingSubmit"
              >Save</SubmitButton
            >
          </div>
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
import ValidationError from "./../../../Components/Layouts/ValidationError.vue";
export default {
  name: "CompanyProfileCreate",
  data() {
    return {
      loading: false,
      loadingSubmit: false,
      validationErrors: "",
      photo: "",
      resume: "",
      candidate: {
        first_name: "RAKOTO",
        last_name: "Bob",
        birth_date: "2000-05-19",
        address: "Marovato Abattoir",
        city: "Mahajanga",
        country: "Madagascar",
        phone: "0381256945",
        bio: "",
        resume: "",
        photo: "",
      },
    };
  },
  components: {
    NoProfileLayout,
    Card,
    SubmitButton,
    ValidationError,
  },
  methods: {
    photoFile(e) {
      this.candidate.photo = e.target.files[0];
    },
    resumeFile(e) {
      this.candidate.resume = e.target.files[0];
    },
    async storeCandidate() {
      this.loadingSubmit = true;
      this.validationErrors = "";
      let candidateData = new FormData();
      candidateData.append("photo", this.candidate.photo);
      candidateData.append("first_name", this.candidate.first_name);
      candidateData.append("last_name", this.candidate.last_name);
      candidateData.append("address", this.candidate.address);
      candidateData.append("city", this.candidate.city);
      candidateData.append("country", this.candidate.country);
      candidateData.append("phone", this.candidate.phone);
      candidateData.append("birth_date", this.candidate.birth_date);
      candidateData.append("bio", this.candidate.bio ?? "");
      candidateData.append("resume", this.candidate.resume);

      this.$store
        .dispatch("StoreCandidate", candidateData)
        .then((result) => {
          this.$store.commit("SET_CANDIDATE", result.data.candidate);
          // this.$router.push({ name: "CandidateProfileIndex" });
          location.reload();
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
};
</script>