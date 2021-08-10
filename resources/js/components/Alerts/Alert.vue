<template>
  <div
    v-if="alertOpen"
    class="px-6 py-4 border-0 rounded relative mb-4 "
    :class="alertClasses"
  >
    <!-- <span class="text-xl inline-block mr-5 align-middle">
      <i class="fas fa-bell"></i>
    </span> -->
    <span class="inline-block align-middle mr-8">
      <slot>Some message</slot>
    </span>
    <button
      class="
        absolute
        bg-transparent
        text-2xl
        font-semibold
        leading-none
        right-0
        top-0
        mt-4
        mr-6
        outline-none
        focus:outline-none
      "
      v-on:click="closeAlert()"
    >
      <span>×</span>
    </button>
  </div>
</template>

<script>
export default {
  name: "alert",
  props: {
    // 'success', 'danger'
    type: {
      type: String,
      required: false,
      default: "success",
      validator(value) {
        return ['success', 'danger'].includes(value)
      },
    },
  },
  data() {
    return {
      alertOpen: true,
    };
  },
  computed: {
    alertClasses: function () {
      switch (this.type) {
        case "success":
          return ["text-white", "bg-emerald-500"];
        case "danger":
          return ["text-white", "bg-red-500"];
        default:
          return [];
      }
      // return ['text-white', 'bg-emerald-500']
    },
  },
  methods: {
    closeAlert: function () {
      this.alertOpen = false;
    },
  },
};
</script>
