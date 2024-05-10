<script setup>
import { ChevronRightIcon } from "@heroicons/vue/24/outline";

defineEmits(["focusOnInput"]);
</script>

<template>
  <div class="h-screen bg-gradient-to-t from-accent-200 to-accent-300">
    <div
      class="flex flex-col justify-center items-center h-screen text-base-100 container"
    >
      <h1 class="text-4xl font-bold">Welcome to the Future of Farming!</h1>
      <img
        src="@/Assets/logo-text-no-bg.png"
        alt="Terra AI Logo"
        class="mx-auto my-4"
      />
      <p class="font-semibold text-3xl">
        A community powered by AI, made for <span class="underline">you</span>
      </p>
      <button
        @click="$emit('focusOnInput')"
        class="flex items-center gap-1 mt-8 px-4 py-2 bg-base-100 text-accent-100 rounded-full font-bold text-xl hover:bg-accent-200 hover:text-base-100 transition-colors duration-300"
      >
        Try it now <ChevronRightIcon class="w-6 h-6" />
      </button>
    </div>
  </div>
</template>
