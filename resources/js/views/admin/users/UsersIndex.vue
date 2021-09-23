<template>
  <card-base>
    <template v-slot:header>
      <h6 class="text-blueGray-700 text-xl font-bold">Users</h6>
      <router-link :to="{ name: 'admin.users.create' }">
        <button-base>Create</button-base>
      </router-link>
    </template>
    <div class="block w-full overflow-x-auto">
      <table class="items-center w-full bg-transparent border-collapse">
        <thead>
          <tr>
            <table-th> Name </table-th>
            <table-th> Email </table-th>
            <table-th> Created </table-th>
            <table-th> Actions </table-th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users" :key="user.id">
            <table-td> {{ user.name }} </table-td>
            <table-td> {{ user.email }} </table-td>
            <table-td> {{ user.created_at }} </table-td>
            <table-td>
              <table-dropdown>
                <table-dropdown-link @click="gotoUserForm(user)">
                  Update
                </table-dropdown-link>
                <table-dropdown-link @click="deleteUser(user)">
                  Delete
                </table-dropdown-link>
              </table-dropdown>
            </table-td>
          </tr>
        </tbody>
      </table>
      <div class="mx-auto">
        <paginator-admin :pagination="pagination" @paginate="getUsers" />
      </div>
    </div>
  </card-base>
</template>
<script>
import CardHeader from "@/components/Cards/CardHeader.vue";
import CardBase from "@/components/Cards/CardBase.vue";
import ButtonBase from "@/components/Buttons/ButtonBase.vue";
import TableTh from "@/components/Table/TableTh.vue";
import TableTd from "@/components/Table/TableTd.vue";
import TableDropdown from "@/components/Dropdowns/TableDropdown.vue";
import TableDropdownLink from "@/components/Dropdowns/TableDropdownLink.vue";
import PaginatorAdmin from "@/components/Paginators/PaginatorAdmin.vue";
import { users as api } from "@/api";

export default {
  data() {
    return {
      color: "light",
      users: [],
      pagination: {},
    };
  },
  components: {
    CardBase,
    CardHeader,
    ButtonBase,
    TableDropdown,
    TableDropdownLink,
    TableTh,
    TableTd,
    PaginatorAdmin,
  },
  mounted() {
    this.getUsers();
  },
  methods: {
    // test() {
    //   console.log("sclick");
    // },
    getUsers() {
      api.index(this.userQuery).then((response) => {
        this.users = response.data;
        this.pagination = response.meta;
      });
    },
    gotoUserForm(user) {
      this.$router.push({name:'admin.users.edit', params:{id: user.id}})
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
