<script setup>
import IconFacebook from "@/Components/Icons/IconFacebook.vue";
import IconInstagram from "@/Components/Icons/IconInstagram.vue";
import IconLinkedin from "@/Components/Icons/IconLinkedin.vue";
import IconGithub from "@/Components/Icons/IconGithub.vue";
import IconYoutube from "@/Components/Icons/IconYoutube.vue";
import IconTwitter from "@/Components/Icons/IconTwitter.vue";

const navigation = [
  {
    name: "Facebook",
    href: "https://www.facebook.com/AUST.Lebanon/",
    icon: IconFacebook,
  },
  {
    name: "Instagram",
    href: "https://www.instagram.com/aust_lebanon/",
    icon: IconInstagram,
  },
  {
    name: "Linkedin",
    href: "https://www.linkedin.com/school/american-university-of-science-and-technology/",
    icon: IconLinkedin,
  },
  {
    name: "Github",
    href: "https://github.com/ChristianDaher/senior-project",
    icon: IconGithub,
  },
  {
    name: "Youtube",
    href: "https://www.youtube.com/watch?v=dQw4w9WgXcQ",
    icon: IconYoutube,
  },
  {
    name: "Twitter",
    href: "https://twitter.com/aust_lebanon",
    icon: IconTwitter,
  },
];
</script>

<template>
  <footer class="bg-base-100">
    <div
      class="space-y-4 md:space-y-0 md:flex md:items-center md:justify-between container py-16"
    >
      <div class="flex justify-center space-x-6 md:order-2">
        <a
          v-for="item in navigation"
          :key="item.name"
          :href="item.href"
          class="text-secondary-100 hover:text-accent-100 custom-transition"
          target="_blank"
        >
          <span class="sr-only">{{ item.name }}</span>
          <component :is="item.icon" class="h-6 w-6" aria-hidden="true" />
        </a>
      </div>
      <p class="text-center text-xs leading-5 text-secondary-100">
        &copy; {{ new Date().getFullYear() }} Terra AI, Inc. All rights
        reserved.
      </p>
    </div>
  </footer>
</template>
