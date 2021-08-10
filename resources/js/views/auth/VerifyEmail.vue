<template>
  <div class="container mx-auto px-4 h-full">
    <div class="flex content-center items-center justify-center h-full">
      <div class="w-full lg:w-4/12 px-4">
        <div
          class="
            relative
            flex flex-col
            min-w-0
            break-words
            w-full
            mb-6
            shadow-lg
            rounded-lg
            bg-blueGray-200
            border-0
          "
        >
          <div class="rounded-t mb-0 px-6 py-6">
            <div class="text-center mb-3">
              <h6 class="text-blueGray-500 text-sm font-bold">Verify email</h6>
            </div>
            <alert v-if="message.show" :type="message.type">
              {{ message.text }}
            </alert>
            <hr class="mt-6 border-b-1 border-blueGray-300" />
          </div>
          <div class="flex-auto p-1">
            <base-spiner classes="h-6/12 w-6/12 text-blueGray-800 m-auto" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { auth as api } from "@/api";
import { mapMutations, mapState, mapActions } from "vuex";
import Alert from "@/components/Alerts/Alert";
import BaseSpiner from "@/components/Spiners/BaseSpiner";
export default {
  components: {
    Alert,
    BaseSpiner,
  },
  data() {
    return {
      showSpiner: true,
      query: {},
    };
  },
  mounted() {
    this.verifyEmail({
      id: this.$route.params.id,
      hash: this.$route.params.hash,
      query: this.$route.query,
    })
      .then((data) => {
        this.$router.push("/admin/dashboard");
      })
      .catch((response) => {
        this.setMessage({
          show: true,
          text: response.data.message,
          type: "danger",
        });
      });
  },
  computed: {
    ...mapState({
      message: (state) => state.auth.message,
    }),
  },
  methods: {
    ...mapMutations("auth", ["setMessage"]),
    ...mapActions("auth", ["verifyEmail"]),
    runVerifyEmail() {
      api
        .verifyEmail(this.query)
        .then((data) => {
          // this.form.onSuccess();
          this.setMessage({
            show: true,
            text: data.message,
            type: "success",
          });
          this.$router.push("/admin/login");
        })
        .catch((response) => {
          this.setMessage({
            show: true,
            text: response.data.message,
            type: "danger",
          });
        });
    },
  },
};
</script>
