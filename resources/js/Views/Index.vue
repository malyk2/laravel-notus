<template>
  <h1>Index</h1>
  <h2>{{ value }}</h2>
</template>

<script>
import { ref } from "vue";
export default {
  setup() {
    const value = ref("some value");

    return {
      value,
    };
  },
};
</script>

<style>
</style>
