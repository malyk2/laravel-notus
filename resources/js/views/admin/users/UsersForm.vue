<template>
  <card-base>
    <template v-slot:header>
      <h6 class="text-blueGray-700 text-xl font-bold">Create user</h6>
    </template>
    <form>
      <h6 class="text-blueGray-400 text-sm mt-3 mb-6 font-bold uppercase">
        User Information
      </h6>
      <div class="flex flex-wrap">
        <div class="w-full lg:w-6/12 px-4">
          <div class="relative w-full mb-3">
            <label
              class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
              htmlFor="grid-password"
            >
              Username
            </label>
            <input
              type="text"
              class="
                border-0
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
              value="lucky.jesse"
            />
          </div>
        </div>
        <div class="w-full lg:w-6/12 px-4">
          <div class="relative w-full mb-3">
            <label
              class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
              htmlFor="grid-password"
            >
              Email address
            </label>
            <input
              type="email"
              class="
                border-0
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
              value="jesse@example.com"
            />
          </div>
        </div>
        <div class="w-full lg:w-6/12 px-4">
          <div class="relative w-full mb-3">
            <label
              class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
              htmlFor="grid-password"
            >
              First Name
            </label>
            <input
              type="text"
              class="
                border-0
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
              value="Lucky"
            />
          </div>
        </div>
        <div class="w-full lg:w-6/12 px-4">
          <div class="relative w-full mb-3">
            <label
              class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
              htmlFor="grid-password"
            >
              Last Name
            </label>
            <input
              type="text"
              class="
                border-0
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
              value="Jesse"
            />
          </div>
        </div>
      </div>
    </form>
  </card-base>
</template>
<script>
import CardBase from "@/components/Cards/CardBase.vue";
// import TableTh from "@/components/Table/TableTh.vue";
// import TableTd from "@/components/Table/TableTd.vue";
// import TableDropdown from "@/components/Dropdowns/TableDropdown.vue";
// import TableDropdownLink from "@/components/Dropdowns/TableDropdownLink.vue";
// import PaginatorAdmin from "@/components/Paginators/PaginatorAdmin.vue";
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
    };
  },
  components: {
    CardBase,
    // CardHeader,
    // TableDropdown,
    // TableDropdownLink,
    // TableTh,
    // TableTd,
    // PaginatorAdmin,
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
