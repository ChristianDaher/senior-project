<script setup>
import { Link } from "@inertiajs/vue3";
import { ArrowDownIcon, ArrowUpIcon } from "@heroicons/vue/20/solid";
import {
  CursorArrowRaysIcon,
  NewspaperIcon,
  UsersIcon,
  TagIcon,
  QuestionMarkCircleIcon,
} from "@heroicons/vue/24/outline";

defineProps({
  when: {
    type: String,
  },
  stats: {
    type: Object,
    required: true,
  },
});

const icons = [
  UsersIcon,
  NewspaperIcon,
  CursorArrowRaysIcon,
  TagIcon,
  QuestionMarkCircleIcon,
];
</script>

<template>
  <div>
    <h3 class="font-semibold leading-6 text-primary-100 mb-2 ml-1" v-if="when">
      {{ when }}
    </h3>
    <dl class="grid grid-cols-1 gap-5 sm:grid-cols-2 mb-4">
      <div
        v-for="(value, key, index) in stats"
        :key="key"
        class="relative overflow-hidden rounded-lg bg-base-100 px-4 pb-12 pt-5 shadow sm:px-6 sm:pt-6"
      >
        <dt>
          <div class="absolute rounded-md bg-accent-200 p-3">
            <component
              :is="icons[index]"
              class="h-6 w-6 text-white"
              aria-hidden="true"
            />
          </div>
          <p class="ml-16 truncate text-sm font-medium text-secondary-100">
            {{ value.title }}
          </p>
        </dt>
        <dd class="ml-16 flex items-baseline pb-6 sm:pb-7">
          <p class="text-2xl font-semibold text-primary-100">
            {{ new Intl.NumberFormat().format(value.stat) }}
          </p>
          <p
            v-if="value.change"
            class="ml-2 flex items-baseline text-sm font-semibold"
            :class="[value.change > 0 ? 'text-green-500' : 'text-error-100']"
          >
            <ArrowUpIcon
              v-if="value.change > 0"
              class="h-5 w-5 flex-shrink-0 self-center text-green-500"
              aria-hidden="true"
            />
            <ArrowDownIcon
              v-else
              class="h-5 w-5 flex-shrink-0 self-center text-error-100"
              aria-hidden="true"
            />
            <span class="sr-only">
              {{ value.change > 0 ? "Increased" : "Decreased" }}
              by
            </span>
            {{ value.change > 0 ? "+" : ""
            }}{{ new Intl.NumberFormat().format(value.change) }}
          </p>
          <div class="absolute inset-x-0 bottom-0 bg-gray-50 px-4 py-4 sm:px-6">
            <div class="text-sm" v-if="value.route">
              <Link
                :href="route(value.route)"
                class="font-medium text-accent-100 hover:text-accent-300 hover:underline custom-transition"
                >View all<span class="sr-only">
                  {{ value.title }} stats</span
                ></Link
              >
            </div>
          </div>
        </dd>
      </div>
    </dl>
  </div>
</template>
