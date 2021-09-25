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
      rounded-lg
      border-0
    "
    :class="[color === 'light' ? 'bg-white' : 'bg-emerald-900 text-white']"

  >
    <div class="rounded-t bg-white mb-0 px-6 py-6">
      <div class="text-center flex justify-between">
        <slot name="header">
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
        </slot>
      </div>
    </div>
    <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
      <slot/>
    </div>
  </div>
</template>
<script>
export default {
  name: 'card-base',
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
