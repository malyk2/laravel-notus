<template>
  <card-base>
    <template v-slot:header>
      <h6 class="text-blueGray-700 text-xl font-bold">Create user</h6>
    </template>
    <form>
      <div class="flex flex-wrap">
        <div class="w-full lg:w-6/12 px-4">
          <input-base label="Name" v-model="user.name" />
        </div>
        <div class="w-full lg:w-6/12 px-4">
          <input-base label="Email" v-model="user.email" />
        </div>
        <div class="w-full lg:w-6/12 px-4">
          <input-base label="Password" v-model="password" />
        </div>
      </div>
      <button
        class="
          bg-emerald-500
          text-white
          active:bg-emerald-600
          font-bold
          uppercase
          text-xs
          px-4
          py-2
          rounded
          shadow
          hover:shadow-md
          outline-none
          focus:outline-none
          mr-1
          ease-linear
          transition-all
          duration-150
        "
        type="button"
      >
        Settings
      </button>
    </form>
  </card-base>
</template>
<script>
import CardBase from "@/components/Cards/CardBase.vue";
import InputBase from "@/components/Inputs/InputBase.vue";
import { users as api } from "@/api";

export default {
  props: {
    id: {
      default: null,
      type: Number,
    },
  },
  data() {
    return {
      user: {},
      password: "",
    };
  },
  components: {
    CardBase,
    InputBase,
  },
  mounted() {
    console.log(this.id);
    // this.getUsers();
  },
  methods: {
    getUsers() {
      api.index(this.userQuery).then((response) => {
        this.users = response.data;
        this.pagination = response.meta;
      });
    },
    gotoUserForm(user) {
      console.log("gotoUserForm");
    },
    deleteUser(user) {
      console.log("deleteUser");
    },
  },
  computed: {
    userQuery() {
      return {
        page: this.pagination ? this.pagination.current_page : null,
      };
    },
  },
};
</script>
