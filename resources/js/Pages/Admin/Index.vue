<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

defineProps({
  userStats: {
    type: Object,
    default: () => ({}),
  },
  postStats: {
    type: Object,
    default: () => ({}),
  },
  promptStats: {
    type: Object,
    default: () => ({}),
  },
  predictionStats: {
    type: Object,
    default: () => ({}),
  },
});

const stats = {
  title: "Revenue",
  main: "$1,542,233.49",
  footer: {
    part1: "%52+ ",
    isGood: true,
    part2: "Since last week",
  },
};
</script>

<template>
  <Head title="Admin Dashboard" />
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-primary-100 leading-tight">
        Admin Dashboard
      </h2>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-4 px-4 sm:px-0">
          <div v-for="i in 4" :key="i" class="rounded-lg bg-base-100 p-8">
            <h3 class="text-secondary-100 text-sm">{{ stats.title }}</h3>
            <p class="text-lg text-primary-100">{{ stats.main }}</p>
            <p class="text-sm">
              <span
                :class="[
                  stats.footer.isGood ? 'text-accent-100' : 'text-error-100',
                ]"
              >
                {{ stats.footer.part1 }}</span
              >
              <span class="text-secondary-100" v-if="stats.footer.part2">
                {{ stats.footer.part2 }}</span
              >
            </p>
          </div>
        </div>
        <div class="bg-base-100 overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-primary-100">I'm an admin wehehe</div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
