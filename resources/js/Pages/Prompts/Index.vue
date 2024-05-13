<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { ref } from "vue";
import Free from "@/Pages/Prompts/Partials/Free.vue";
import Paid from "@/Pages/Prompts/Partials/Paid.vue";

const activePromptComponent = ref("free");
</script>

<template>
  <Head title="Prompt" />
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-primary-100 leading-tight">
        Get AI Generated Prompts
      </h2>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex gap-4">
          <p
            class="py-2 px-4 border-b-2 custom-transition"
            :class="[
              activePromptComponent === 'free'
                ? 'text-accent-200 border-accent-200'
                : 'cursor-pointer hover:border-accent-100',
            ]"
            @click="activePromptComponent = 'free'"
          >
            Free
          </p>
          <p
            class="py-2 px-4 border-b-2 custom-transition"
            :class="[
              activePromptComponent === 'paid'
                ? 'text-accent-200 border-accent-200'
                : 'cursor-pointer hover:border-accent-100',
            ]"
            @click="activePromptComponent = 'paid'"
          >
            Paid
          </p>
        </div>
        <div class="bg-base-100 overflow-hidden shadow-sm sm:rounded-b-lg">
          <div class="p-6 text-primary-100">
            <Free v-show="activePromptComponent === 'free'" />
            <Paid v-show="activePromptComponent === 'paid'" />
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
