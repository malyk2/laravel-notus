<template>
  <div class="rounded-t mb-0 px-4 py-3 border-0">
    <div class="flex flex-wrap items-center">
      <div class="relative w-full px-4 max-w-full flex-grow flex-1">
        <h3
          class="font-semibold text-lg"
          :class="[color === 'light' ? 'text-blueGray-700' : 'text-white']"
        >
          <slot></slot>
        </h3>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'card-header',
  props: {
    color: {
      default: "light",
      validator: function (value) {
        // The value must match one of these strings
        return ["light", "dark"].indexOf(value) !== -1;
      },
    },
  },
};
</script>

<style>
</style>
