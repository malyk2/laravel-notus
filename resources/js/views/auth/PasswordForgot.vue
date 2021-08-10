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
              <h6 class="text-blueGray-500 text-sm font-bold">
                Forgot password
              </h6>
            </div>
            <alert v-if="message.show" :type="message.type">
              {{ message.text }}
            </alert>
            <hr class="mt-6 border-b-1 border-blueGray-300" />
          </div>
          <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
            <form @submit.prevent="forgotPassword">
              <div class="relative w-full mb-3">
                <label
                  class="
                    block
                    uppercase
                    text-blueGray-600 text-xs
                    font-bold
                    mb-2
                  "
                  htmlFor="grid-password"
                >
                  Email
                </label>
                <input
                  type="email"
                  class="
                    px-3
                    py-3
                    placeholder-blueGray-300
                    text-blueGray-600
                    bg-white
                    rounded
                    text-sm
                    shadow
                    focus:outline-none
                    focus:ring
                    w-full
                    ease-linear
                    transition-all
                    duration-150
                  "
                  :class="[
                    form.errors.has('email') ? 'border-red-500' : 'border-none',
                  ]"
                  placeholder="Email"
                  v-model="form.email"
                />
                <p v-if="form.errors.has('email')" class="text-red-500 text-xs">
                  {{ form.errors.first("email") }}
                </p>
              </div>

              <div class="text-center mt-6">
                <button
                  class="
                    bg-blueGray-800
                    text-white
                    active:bg-blueGray-600
                    text-sm
                    font-bold
                    uppercase
                    px-6
                    py-3
                    rounded
                    shadow
                    hover:shadow-lg
                    outline-none
                    focus:outline-none
                    mr-1
                    mb-1
                    w-full
                    ease-linear
                    transition-all
                    duration-150
                  "
                  type="submit"
                  :disabled="form.busy"
                >
                  Request
                </button>
              </div>
            </form>
          </div>
        </div>
        <div class="flex flex-wrap mt-6 relative">
          <div class="w-1/2">
            <router-link
              :to="{ name: 'admin.login' }"
              class="text-blueGray-200"
            >
              <small>Login</small>
            </router-link>
          </div>
          <div class="w-1/2 text-right">
            <router-link to="/auth/register" class="text-blueGray-200">
              <small>Create new account</small>
            </router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { auth as api } from "@/api";
import { mapMutations, mapState } from "vuex";
import Form from "@/libs/Form";
import Alert from "@/components/Alerts/Alert";
export default {
  components: {
    Alert,
  },
  data() {
    return {
      form: new Form({
        email: "",
      }),
    };
  },
  mounted() {},
  computed: {
    ...mapState({
      message: (state) => state.auth.message,
    }),
  },
  methods: {
    ...mapMutations("auth", ["setMessage"]),
    forgotPassword() {
      this.form.errors.clear();
      this.form.busy = true;
      api
        .forgotPassword(this.form.data())
        .then((data) => {
          this.form.onSuccess();
          this.setMessage({
            show: true,
            text: data.message,
            type: "success",
          });
          this.$router.push("/admin/login");
        })
        .catch((response) => {
          this.form.onFail(response.data.errors);
          if (response.status == 422) {
            this.setMessage({
              show: false,
            });
          } else {
            this.setMessage({
              show: true,
              text: response.data.message,
              type: "danger",
            });
          }
        });
    },
  },
};
</script>
