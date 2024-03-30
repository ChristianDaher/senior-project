<script setup>
import GoogleIcon from "@/Components/Icons/GoogleIcon.vue";
</script>

<template>
  <a
    :href="route('google.login')"
    class="flex items-center w-full bg-base-100 rounded-lg px-6 py-4 border border-disabled-100 outline-none hover:ring-2 active:ring-2 focus:ring-2 hover:ring-accent-200 active:ring-accent-100 focus:ring-accent-100 transition ease-in-out duration-150"
  >
    <GoogleIcon />
    <span class="text-center grow"> Sign in with Google </span>
  </a>
</template>
