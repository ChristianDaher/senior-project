<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import StatsHeader from "@/Pages/Admin/Partials/StatsHeader.vue";
import ChartUserProviders from "@/Pages/Admin/Partials/ChartUserProviders.vue";
import ChartLatestPosts from "@/Pages/Admin/Partials/ChartLatestPosts.vue";
import ChartMostUsedTags from "@/Pages/Admin/Partials/ChartMostUsedTags.vue";

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
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div
            class="bg-base-100 overflow-hidden shadow-sm sm:rounded-lg p-4"
            v-if="stats.users?.providers"
          >
            <ChartUserProviders
              :stats="stats.users.providers"
              class="h-[600px] w-full"
            />
          </div>
          <div
            class="bg-base-100 overflow-hidden shadow-sm sm:rounded-lg p-4"
            v-if="stats.posts?.perDay"
          >
            <ChartLatestPosts :stats="stats.posts.perDay" class="h-[600px] w-full" />
          </div>
          <div
            class="bg-base-100 overflow-hidden shadow-sm sm:rounded-lg p-4"
            v-if="stats.tags?.mostUsed"
          >
            <ChartMostUsedTags :stats="stats.tags.mostUsed" class="h-[600px] w-full" />
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
