<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

defineProps({
  tags: {
    type: Array,
    default: () => [],
  },
});
</script>

<template>
  <Head title="Create Post" />
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-primary-100 leading-tight">
        Create Post
      </h2>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-base-100 overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-primary-100">{{ tags }}</div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
