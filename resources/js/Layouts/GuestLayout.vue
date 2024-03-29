<script setup>
import { Link } from "@inertiajs/vue3";
import GoogleIcon from "@/Components/Icons/GoogleIcon.vue";
</script>

<template>
  <div
    class="min-h-screen flex justify-center items-center bg-secondary-100/10 p-8 before:absolute before:top-0 before:left-1/2 before:-translate-x-1/2 before:w-full before:h-1/2 before:bg-gradient-to-t from-accent-200 to-accent-300"
  >
    <div
      class="w-full sm:max-w-xl relative z-1 flex flex-col items-center gap-10"
    >
      <img
        class="w-full"
        src="@/Assets/logo-text-no-bg.png"
        alt="Terra AI Logo"
      />

      <div class="w-full px-6 py-4 bg-base-100 shadow-md rounded-lg">
        <slot />
      </div>
      <a
        :href="route('google.login')"
        class="flex items-center w-full shadow-md bg-base-100 rounded-lg px-6 py-4"
      >
        <GoogleIcon />
        <span class="text-center grow"> Sign in With Google </span>
      </a>
    </div>
  </div>
</template>
