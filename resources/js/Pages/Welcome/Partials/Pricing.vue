<script setup>
import { CheckCircleIcon } from "@heroicons/vue/20/solid";
import { Link } from "@inertiajs/vue3";
import ButtonPrimary from "@/Components/Buttons/ButtonPrimary.vue";

const tiers = [
  {
    name: "Basic",
    id: "tier-basic",
    href: route("forum"),
    price: { monthly: "Free", annually: null },
    description: "Everything necessary to get started.",
    features: [
      "Access to forum",
      "Access to prompt bot",
      "Limited access to Terra AI bot",
    ],
    buttonText: "Get started",
  },
  {
    name: "Premium",
    id: "tier-premium",
    href: route("forum"), //should be something else
    price: { monthly: "$9.99", annually: "$99.9" },
    description: "For more seasoned farmers.",
    features: [
      "Access to forum",
      "Access to prompt bot",
      "Unlimited access to Terra AI bot",
      "Priority customer support",
    ],
    buttonText: "Subscribe",
  },
  {
    name: "Entreprise",
    id: "tier-entreprise",
    href: route("forum"), //should be something else
    price: { monthly: "Custom", annually: null },
    description:
      "Unlimited access for your entire team — up to 25 premium accounts to accommodate even the largest teams at your company.",
    features: [
      "Access to forum",
      "Access to prompt bot",
      "Unlimited access to Terra AI bot",
      "Priority customer support",
      "Manage team members",
      "Custom trained models available",
    ],
    buttonText: "Contact us",
  },
];
</script>

<template>
  <div class="bg-base-100">
    <div class="container">
      <div class="mx-auto max-w-4xl sm:text-center">
        <p
          class="mt-2 text-4xl font-bold tracking-tight text-primary-100 sm:text-5xl"
        >
          Choose the right plan for&nbsp;you
        </p>
      </div>
      <p
        class="mx-auto mt-6 max-w-2xl text-lg leading-8 text-secondary-100 sm:text-center"
      >
        Free and Affordable plans with advanced tools <br />catered to your
        every farming need
      </p>
      <div class="mt-20 flow-root">
        <div
          class="isolate -mt-16 grid max-w-sm grid-cols-1 gap-y-16 divide-y divide-gray-100 sm:mx-auto lg:-mx-8 lg:mt-0 lg:max-w-none lg:grid-cols-3 lg:divide-x lg:divide-y-0 xl:-mx-4"
        >
          <div
            v-for="tier in tiers"
            :key="tier.id"
            class="pt-16 lg:px-8 lg:pt-0 xl:px-14"
          >
            <h3
              :id="tier.id"
              class="text-base font-semibold leading-7 text-primary-100"
            >
              {{ tier.name }}
            </h3>
            <p class="mt-6 flex items-baseline gap-x-1">
              <span
                class="text-5xl font-bold tracking-tight text-primary-100"
                >{{ tier.price.monthly }}</span
              >
              <span class="text-sm font-semibold leading-6 text-secondary-100"
                >/month</span
              >
            </p>
            <p
              class="mt-3 text-sm leading-6 text-gray-500"
              v-if="tier.price.annually"
            >
              {{ tier.price.annually }} per month if paid annually
            </p>
            <ButtonPrimary
              :class="[tier.price.annually ? 'mt-7' : 'mt-16']"
              class="w-full !p-0"
              ><Link :href="tier.href" class="block px-4 py-2">
                {{ tier.buttonText }}</Link
              ></ButtonPrimary
            >
            <p class="mt-10 text-sm font-semibold leading-6 text-primary-100">
              {{ tier.description }}
            </p>
            <ul
              role="list"
              class="mt-6 space-y-3 text-sm leading-6 text-secondary-100"
            >
              <li
                v-for="feature in tier.features"
                :key="feature"
                class="flex gap-x-3"
              >
                <CheckCircleIcon
                  class="h-6 w-5 flex-none text-accent-200"
                  aria-hidden="true"
                />
                {{ feature }}
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
