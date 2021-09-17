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
    <card-header> Users test </card-header>
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
          <tr>
            <table-td> 1 </table-td>
            <table-td> 2 </table-td>
            <table-td> 3 </table-td>
            <table-td>
              <table-dropdown />
            </table-td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
<script>
import TableDropdown from "@/components/Dropdowns/TableDropdown.vue";

import CardHeader from "@/components/Cards/CardHeader.vue";
import TableTh from "@/components/Table/TableTh.vue";
import TableTd from "@/components/Table/TableTd.vue";

export default {
  data() {
    return {
      color: 'light',
    };
  },
  components: {
    CardHeader,
    TableDropdown,
    TableTh,
    TableTd,
  },
  // props: {
  //   color: {
  //     default: "light",
  //     validator: function (value) {
  //       // The value must match one of these strings
  //       return ["light", "dark"].indexOf(value) !== -1;
  //     },
  //   },
  // },
};
</script>
