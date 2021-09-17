<template>
  <th
    class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
    :class="[
      color === 'light'
        ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
        : 'bg-emerald-800 text-emerald-300 border-emerald-700',
    ]"
  >
    <slot/>
  </th>
</template>

<script>
export default {
  name: 'table-th',
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
