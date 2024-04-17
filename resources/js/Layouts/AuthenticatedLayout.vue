<script setup>
import { ref } from "vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { Link } from "@inertiajs/vue3";
import IconDownArrowHead from "@/Components/Icons/IconDownArrowHead.vue";
import IconHamburgerMenu from "@/Components/Icons/IconHamburgerMenu.vue";
import IconX from "@/Components/Icons/IconX.vue";

const showingNavigationDropdown = ref(false);
</script>

<template>
  <div>
    <div class="min-h-screen bg-disabled-100/50">
      <nav class="bg-base-100 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="flex justify-between h-16">
            <div class="flex">
              <div class="shrink-0 flex items-center">
                <Link :href="route('welcome')">
                  <img
                    src="@/Assets/logo-bg.png"
                    alt="Terra AI Logo"
                    class="block h-9 w-auto"
                  />
                </Link>
              </div>
              <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                <NavLink
                  :href="route('dashboard')"
                  :active="route().current('dashboard')"
                >
                  Dashboard
                </NavLink>
                <NavLink
                  v-if="$page.props.auth.user.is_admin"
                  :href="route('admin-dashboard')"
                  :active="route().current('admin-dashboard')"
                >
                  Admin Dashboard
                </NavLink>
              </div>
            </div>
            <div class="hidden sm:flex sm:items-center sm:ms-6">
              <div class="ms-3 relative">
                <Dropdown align="right" width="48">
                  <template #trigger>
                    <span class="inline-flex rounded-md">
                      <button
                        type="button"
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-secondary-100 bg-base-100 hover:text-primary-100/75 focus:outline-none custom-transition"
                      >
                        {{ $page.props.auth.user.username }}
                        <IconDownArrowHead class="ms-2 -me-0.5 h-4 w-4" />
                      </button>
                    </span>
                  </template>
                  <template #content>
                    <DropdownLink :href="route('profile.edit')">
                      Profile
                    </DropdownLink>
                    <DropdownLink
                      :href="route('logout')"
                      method="post"
                      as="button"
                    >
                      Log Out
                    </DropdownLink>
                  </template>
                </Dropdown>
              </div>
            </div>
            <div class="-me-2 flex items-center sm:hidden">
              <button
                @click="showingNavigationDropdown = !showingNavigationDropdown"
                class="inline-flex items-center justify-center p-2 rounded-md text-secondary-100 hover:text-primary-100/50 hover:bg-disabled-100/50 focus:outline-none focus:bg-disabled-100/75 focus:text-primary-100/75 custom-transition"
              >
                <IconX class="w-6 h-6" v-show="showingNavigationDropdown" />
                <IconHamburgerMenu
                  class="w-6 h-6"
                  v-show="!showingNavigationDropdown"
                />
              </button>
            </div>
          </div>
        </div>
        <div
          :class="{
            block: showingNavigationDropdown,
            hidden: !showingNavigationDropdown,
          }"
          class="sm:hidden"
        >
          <div class="pt-2 pb-3 space-y-1">
            <ResponsiveNavLink
              :href="route('dashboard')"
              :active="route().current('dashboard')"
            >
              Dashboard
            </ResponsiveNavLink>
            <ResponsiveNavLink
              v-if="$page.props.auth.user.is_admin"
              :href="route('admin-dashboard')"
              :active="route().current('admin-dashboard')"
            >
              Admin Dashboard
            </ResponsiveNavLink>
          </div>
          <div class="pt-4 pb-1 border-t border-gray-100">
            <div class="px-4">
              <div class="font-medium text-base text-primary-100">
                {{ $page.props.auth.user.username }}
              </div>
              <div class="font-medium text-sm text-secondary-100">
                {{ $page.props.auth.user.email }}
              </div>
            </div>
            <div class="mt-3 space-y-1">
              <ResponsiveNavLink
                :href="route('profile.edit')"
                :active="route().current('profile.edit')"
              >
                Profile
              </ResponsiveNavLink>
              <ResponsiveNavLink
                :href="route('logout')"
                method="post"
                as="button"
              >
                Log Out
              </ResponsiveNavLink>
            </div>
          </div>
        </div>
      </nav>
      <header class="bg-base-100 shadow" v-if="$slots.header">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
          <slot name="header" />
        </div>
      </header>
      <main>
        <slot />
      </main>
    </div>
  </div>
</template>
