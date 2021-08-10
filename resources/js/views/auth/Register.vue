<template>
  <div class="container mx-auto px-4 h-full">
    <div class="flex content-center items-center justify-center h-full">
      <div class="w-full lg:w-6/12 px-4">
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
              <h6 class="text-blueGray-500 text-sm font-bold">Sign up with</h6>
            </div>
            <alert v-if="message.show" :type="message.type">
              {{ message.text }}
            </alert>
            <div class="btn-wrapper text-center">
              <button
                class="
                  bg-white
                  active:bg-blueGray-50
                  text-blueGray-700
                  font-normal
                  px-4
                  py-2
                  rounded
                  outline-none
                  focus:outline-none
                  mr-2
                  mb-1
                  uppercase
                  shadow
                  hover:shadow-md
                  inline-flex
                  items-center
                  font-bold
                  text-xs
                  ease-linear
                  transition-all
                  duration-150
                "
                type="button"
              >
                <img alt="..." class="w-5 mr-1" :src="github" />
                Github
              </button>
              <button
                class="
                  bg-white
                  active:bg-blueGray-50
                  text-blueGray-700
                  font-normal
                  px-4
                  py-2
                  rounded
                  outline-none
                  focus:outline-none
                  mr-1
                  mb-1
                  uppercase
                  shadow
                  hover:shadow-md
                  inline-flex
                  items-center
                  font-bold
                  text-xs
                  ease-linear
                  transition-all
                  duration-150
                "
                type="button"
              >
                <img alt="..." class="w-5 mr-1" :src="google" />
                Google
              </button>
            </div>
            <hr class="mt-6 border-b-1 border-blueGray-300" />
          </div>
          <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
            <div class="text-blueGray-400 text-center mb-3 font-bold">
              <small>Or sign up with credentials</small>
            </div>
            <form @submit.prevent="register">
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
                  Name
                </label>
                <input
                  v-model="form.name"
                  type="text"
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
                    form.errors.has('name') ? 'border-red-500' : 'border-none',
                  ]"
                  placeholder="Name"
                />
                <p v-if="form.errors.has('name')" class="text-red-500 text-xs">
                  {{ form.errors.first("name") }}
                </p>
              </div>

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
                  v-model="form.email"
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
                />
                <p v-if="form.errors.has('email')" class="text-red-500 text-xs">
                  {{ form.errors.first("email") }}
                </p>
              </div>

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
                  Password
                </label>
                <input
                  v-model="form.password"
                  type="password"
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
                    form.errors.has('password')
                      ? 'border-red-500'
                      : 'border-none',
                  ]"
                  placeholder="Password"
                />
                <p
                  v-if="form.errors.has('password')"
                  class="text-red-500 text-xs"
                >
                  {{ form.errors.first("password") }}
                </p>
              </div>

              <div>
                <label class="inline-flex items-center cursor-pointer">
                  <input
                    id="customCheckLogin"
                    type="checkbox"
                    class="
                      form-checkbox
                      border-0
                      rounded
                      text-blueGray-700
                      ml-1
                      w-5
                      h-5
                      ease-linear
                      transition-all
                      duration-150
                    "
                  />
                  <span class="ml-2 text-sm font-semibold text-blueGray-600">
                    I agree with the
                    <a href="javascript:void(0)" class="text-emerald-500">
                      Privacy Policy
                    </a>
                  </span>
                </label>
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
                >
                  Create Account
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import github from "r@/assets/img/github.svg";
import google from "r@/assets/img/google.svg";
import { mapState, mapMutations } from "vuex";
import { auth as api } from "@/api";
import Form from "@/libs/Form";
import Alert from "@/components/Alerts/Alert";

export default {
  components: {
    Alert,
  },
  data() {
    return {
      form: new Form({
        name: "",
        email: "",
        password: "",
      }),
      github,
      google,
    };
  },
  computed: {
    ...mapState({
      message: (state) => state.auth.message,
    }),
  },
  methods: {
    ...mapMutations("auth", ["setMessage"]),
    register() {
      this.form.errors.clear();
      this.form.busy = true;
      api
        .register(this.form.data())
        .then((data) => {
          this.form.onSuccess();
          this.setMessage({
            show: true,
            text: "Please verify your email",
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
