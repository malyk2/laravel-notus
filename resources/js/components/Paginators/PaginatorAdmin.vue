<template>
  <div class="py-2">
    <nav class="block">
      <ul class="flex pl-0 rounded list-none flex-wrap">
        <li>
          <a
            href="#pablo"
            class="
              first:ml-0
              text-xs
              font-semibold
              flex
              w-8
              h-8
              mx-1
              p-0
              rounded-full
              items-center
              justify-center
              leading-tight
              relative
              border border-solid border-emerald-500
              bg-white
              text-emerald-500
            "
            @click.prevent="changePage(1)"
            v-if="pagination.current_page > 2"
          >
            <i class="fas fa-chevron-left -ml-px"></i>
            <i class="fas fa-chevron-left -ml-px"></i>
          </a>
        </li>
        <li>
          <a
            href="#pablo"
            class="
              first:ml-0
              text-xs
              font-semibold
              flex
              w-8
              h-8
              mx-1
              p-0
              rounded-full
              items-center
              justify-center
              leading-tight
              relative
              border border-solid border-emerald-500
              bg-white
              text-emerald-500
            "
            @click.prevent="changePage(pagination.current_page - 1)"
            v-if="pagination.current_page > 1"
          >
            <i class="fas fa-chevron-left -ml-px"></i>
          </a>
        </li>

        <li v-for="page in pagesNumber" :key="page">
          <a
            href="#pablo"
            class="
              first:ml-0
              text-xs
              font-semibold
              flex
              w-8
              h-8
              mx-1
              p-0
              rounded-full
              items-center
              justify-center
              leading-tight
              relative
              border border-solid border-emerald-500
            "
            :class="[
              page == pagination.current_page
                ? ['text-white', 'bg-emerald-500']
                : ['text-emerald-500', 'bg-white'],
            ]"
            @click.prevent="changePage(page)"
          >
            {{ page }}
          </a>
        </li>

        <li>
          <a
            href="#pablo"
            class="
              first:ml-0
              text-xs
              font-semibold
              flex
              w-8
              h-8
              mx-1
              p-0
              rounded-full
              items-center
              justify-center
              leading-tight
              relative
              border border-solid border-emerald-500
              bg-white
              text-emerald-500
            "
            @click.prevent="changePage(pagination.current_page + 1)"
            v-if="pagination.last_page > pagination.current_page"
          >
            <i class="fas fa-chevron-right -mr-px"></i>
          </a>
        </li>
        <li>
          <a
            href="#pablo"
            class="
              first:ml-0
              text-xs
              font-semibold
              flex
              w-8
              h-8
              mx-1
              p-0
              rounded-full
              items-center
              justify-center
              leading-tight
              relative
              border border-solid border-emerald-500
              bg-white
              text-emerald-500
            "
            @click.prevent="changePage(pagination.last_page)"
            v-if="(pagination.last_page - pagination.current_page) > 1"
          >
            <i class="fas fa-chevron-right -mr-px"></i>
            <i class="fas fa-chevron-right -mr-px"></i>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</template>
<script>
export default {
  name: "paginator-admin",
  props: {
    pagination: {
      type: Object,
      required: true,
    },
    offset: {
      type: Number,
      default: 2,
    }
  },
  computed: {
    pagesNumber() {
      if (!this.pagination.to) {
        return [];
      }
      let from = this.pagination.current_page - this.offset;
      if (from < 1) {
        from = 1;
      }
      let to = from + this.offset * 2;
      if (to >= this.pagination.last_page) {
        to = this.pagination.last_page;
      }
      let pagesArray = [];
      for (let page = from; page <= to; page++) {
        pagesArray.push(page);
      }
      return pagesArray;
    },
  },
  methods: {
    changePage(page) {
      this.pagination.current_page = page;
      this.$emit("paginate");
    },
  },
};
</script>
