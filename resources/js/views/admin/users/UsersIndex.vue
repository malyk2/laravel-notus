<template>
  <div
    class="
      relative
      flex flex-col
      min-w-0
      break-words
      w-full
      mb-6
      shadow-lg
      rounded
    "
    :class="[color === 'light' ? 'bg-white' : 'bg-emerald-900 text-white']"
  >
    <card-header> Users </card-header>
    <div class="block w-full overflow-x-auto">
      <!-- Projects table -->
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
                <table-dropdown-link @click="gotoUserForm(user)"> Update </table-dropdown-link>
                <table-dropdown-link @click="deleteUser(user)"> Delete </table-dropdown-link>
              </table-dropdown>
            </table-td>
          </tr>
        </tbody>
      </table>
      <div class="mx-auto">
        <paginator-admin :pagination="pagination" @paginate="getUsers"/>
      </div>
    </div>
  </div>
</template>
<script>

import CardHeader from "@/components/Cards/CardHeader.vue";
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
    CardHeader,
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
    getUsers() {
      api.index(this.userQuery).then((response) => {
        this.users = response.data;
        this.pagination = response.meta;
      });
    },
    gotoUserForm(user) {
      console.log('gotoUserForm');
    },
    deleteUser(user) {
      console.log('deleteUser');
    },
  },
  computed: {
    userQuery() {
      return {
        page: this.pagination ? this.pagination.current_page : null,
      }
    }
  }
};
</script>
