<script setup>
import { Link } from "@inertiajs/vue3";
import { ArrowLeftIcon } from '@heroicons/vue/24/solid'

defineProps({
  backRoute: {
    type: String,
    required: false,
  },
});
</script>

<template>
  <div
    class="min-h-screen flex justify-center items-center bg-disabled-100/50 p-8 before:absolute before:top-0 before:left-1/2 before:-translate-x-1/2 before:w-full before:h-1/2 before:bg-gradient-to-t from-accent-200 to-accent-300"
  >
    <Link
      v-if="backRoute"
      :href="backRoute"
      class="absolute top-4 left-4 p-1 rounded-full hover:bg-accent-200 outline-none focus:bg-accent-200 custom-transition"
    >
      <ArrowLeftIcon class="h-6 w-6 text-white" />
    </Link>
    <div
      class="w-full sm:max-w-xl relative z-1 flex flex-col items-center gap-10"
    >
      <Link :href="route('welcome')" class="block w-full">
        <img
          class="w-full"
          src="@/Assets/logo-text-no-bg.png"
          alt="Terra AI Logo"
        />
      </Link>
      <div
        class="w-full px-6 py-4 bg-base-100 shadow-md rounded-lg border border-disabled-100"
      >
        <slot name="body" />
      </div>
      <slot name="extras" />
    </div>
  </div>
</template>
