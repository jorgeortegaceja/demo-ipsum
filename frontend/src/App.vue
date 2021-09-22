<template>
  <v-app>
    <v-main>
      <component :is="layout">
        <router-view />
      </component>
    </v-main>
  </v-app>
</template>

<script>
import Blank from "./components/Templates/blank.vue";
import Dashboard from "./components/Templates/dashboard.vue";

export default {
  name: "App",
  computed: {
    layout() {
      return this.$route.meta.template || "dashboard";
    }
  },
  components: {
    Blank,
    Dashboard
  },
  data: () => ({
    //
  })
};
</script>
