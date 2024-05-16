<script setup>
import { Head } from "@inertiajs/vue3";
import Header from "@/Pages/Welcome/Partials/Header.vue";
import Landing from "@/Pages/Welcome/Partials/Landing.vue";
import Why from "@/Pages/Welcome/Partials/Why.vue";
import Trial from "@/Pages/Welcome/Partials/Trial.vue";
import Pricing from "@/Pages/Welcome/Partials/Pricing.vue";
import Contact from "@/Pages/Welcome/Partials/Contact.vue";
import Footer from "@/Pages/Welcome/Partials/Footer.vue";
</script>

<template>
  <Head title="Welcome" />
  <Header />
  <main class="space-y-4">
    <Landing @focusOnInput="" />
    <Why />
    <Trial />
    <Pricing />
    <Contact />
  </main>
  <Footer />
</template>
