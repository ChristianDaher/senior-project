<script setup>
import { Head, Link } from "@inertiajs/vue3";
import { MinusIcon, PlusIcon } from "@heroicons/vue/24/outline";
import { ArrowLeftIcon } from "@heroicons/vue/24/solid";
import { Disclosure, DisclosureButton, DisclosurePanel } from "@headlessui/vue";

defineProps({
  faqs: {
    type: Array,
    default: () => [],
  },
  backRoute: {
    type: String,
    default: () => route("dashboard"),
  },
});
</script>

<template>
  <Head title="FAQ" />
  <div
    class="min-h-screen bg-disabled-100/50 py-4 before:absolute before:top-0 before:left-1/2 before:-translate-x-1/2 before:w-full before:h-1/2 before:bg-gradient-to-t from-accent-200 to-accent-300"
  >
    <div
      class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 bg-base-100 shadow rounded-md mb-4 relative"
    >
      <Link
        :href="backRoute"
        class="inline-block mb-4 p-1 rounded-full hover:bg-disabled-100 outline-none focus:bg-disabled-100 custom-transition"
      >
        <ArrowLeftIcon class="h-6 w-6 text-accent-200" />
      </Link>
      <div class="mx-auto max-w-4xl divide-y divide-gray-900/10">
        <h2 class="text-2xl font-bold leading-10 tracking-tight text-primary-100">
          Frequently asked questions
        </h2>
        <dl class="mt-10 space-y-6 divide-y divide-gray-900/10">
          <Disclosure
            as="div"
            v-for="faq in faqs"
            :key="faq.id"
            class="pt-6"
            v-slot="{ open }"
          >
            <dt>
              <DisclosureButton
                class="flex w-full items-start justify-between text-left text-primary-100"
              >
                <span class="text-base font-semibold leading-7">{{
                  faq.question
                }}</span>
                <span class="ml-6 flex h-7 items-center">
                  <PlusIcon v-if="!open" class="h-6 w-6" aria-hidden="true" />
                  <MinusIcon v-else class="h-6 w-6" aria-hidden="true" />
                </span>
              </DisclosureButton>
            </dt>
            <DisclosurePanel as="dd" class="mt-2 pr-12">
              <p class="text-base leading-7 text-secondary-100">{{ faq.answer }}</p>
            </DisclosurePanel>
          </Disclosure>
        </dl>
      </div>
    </div>
  </div>
</template>
