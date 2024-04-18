<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import StatsHeader from "@/Pages/Admin/Partials/StatsHeader.vue";

const props = defineProps({
  when: {
    type: String,
  },
  stats: {
    type: Object,
    default: () => {},
  },
});

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
        <StatsHeader :when="when" :stats="stats" />
        <div class="bg-base-100 overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-primary-100">I'm an admin wehehe</div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
