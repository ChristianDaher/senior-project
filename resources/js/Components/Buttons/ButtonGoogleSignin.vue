<script setup>
import GoogleIcon from "@/Components/Icons/GoogleIcon.vue";
</script>

<template>
  <a
    :href="route('google.login')"
    class="px-6 py-4 flex items-center rounded-lg w-full bg-base-100 border border-disabled-100 outline-none hover:border-accent-200 active:border-accent-100 focus:border-accent-100 hover:ring-2 active:ring-2 focus:ring-2 hover:ring-accent-200 active:ring-accent-100 focus:ring-accent-100 custom-transition"
  >
    <GoogleIcon />
    <span class="text-center grow"> Sign in with Google </span>
  </a>
</template>
