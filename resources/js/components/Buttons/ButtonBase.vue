<template>
  <button
    class="
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
    :class="colorClasses"
    :type="type"
  >
    <slot></slot>
  </button>
</template>
<script>
export default {
  name: "button-base",
  props: {
    color: {
      default: "success",
      validator: function (value) {
        return ["success"].indexOf(value) !== -1;
      },
    },
    type: {
      default: "button",
      validator: function (value) {
        return ["button", "submit"].indexOf(value) !== -1;
      },
    },
    disabled: {
      default: false,
      type: Boolean,
    }
  },
  // emits: ['click'],
  computed: {
    colorClasses() {
      switch (this.color) {
        case 'success':
          return ['bg-emerald-500', 'text-white', 'active:bg-emerald-600'];
          break;
        default:
          return [];
          break;
      }
    },
  },
};
</script>
