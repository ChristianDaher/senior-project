<script setup>
import { Head, Link } from "@inertiajs/vue3";
import Landing from "@/Pages/Welcome/Partials/Landing.vue";
</script>

<template>
  <Head title="Welcome" />
  <nav class="bg-transparent fixed z-50 w-screen p-4">
    <div class="flex items-center justify-end container text-base-100">
      <div class="flex items-center gap-4">
        <Link
          v-if="$page.props.auth.user"
          :href="route('dashboard')"
          class="custom-transition hover:text-disabled-100 hover:underline"
          >Dashboard</Link
        >
        <template v-else>
          <Link
            :href="route('login')"
            class="custom-transition hover:text-disabled-100 hover:underline"
            >Login</Link
          >
          <Link
            :href="route('register')"
            class="custom-transition hover:text-disabled-100 hover:underline"
            >Register</Link
          >
        </template>
      </div>
    </div>
  </nav>
  <main>
    <Landing @focusOnInput="" />
  </main>
</template>
