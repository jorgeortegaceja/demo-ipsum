<template>
  <div>
    <v-navigation-drawer
      v-model="navigator.drawer"
      enable-resize-watcher
      dark
      app
      class="secondary"
    >
      <v-list style="padding: 0px !important">
        <v-list-item style="padding: 0px !important">
          <v-img
            max-height="75px"
            contain
            src="https://ipsumtechnology.mx/wp-content/uploads/2020/12/logotipo-ipsum-cromatico-negativo-e1608761287420.png"
          ></v-img>
        </v-list-item>
      </v-list>
      <v-divider></v-divider>

      <v-list nav dense>
        <v-list-item-group v-model="selectedItem" color="primary">
          <v-list-item
            v-for="(item, i) in navigation_drawer"
            :key="i"
            @click="update_component(item)"
          >
            <v-list-item-icon>
              <v-icon v-text="item.icon"></v-icon>
            </v-list-item-icon>

            <v-list-item-content>
              <v-list-item-title v-text="item.name"></v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list-item-group>
      </v-list>
    </v-navigation-drawer>

    <v-toolbar class="secondary" fixed dark>
      <v-toolbar-title> {{ navigator.component.name }} </v-toolbar-title>
      <v-app-bar-nav-icon @click.stop="updateDrawer()"></v-app-bar-nav-icon>
      <v-spacer></v-spacer>
      <v-menu :close-on-content-click="false" :nudge-width="200" offset-x>
        <template v-slot:activator="{ on, attrs }">
          <v-btn v-bind="attrs" fab v-on="on">
            <v-icon>mdi-account-circle-outline</v-icon>
          </v-btn>
        </template>

        <v-card>
          <v-list>
            <v-list-item>
              <v-list-item-avatar class="secondary">
                <img
                  src="https://ipsumtechnology.mx/wp-content/uploads/2020/12/logotipo-ipsum-cromatico-negativo-e1608761287420.png"
                  alt="John"
                />
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>{{ user.name }}</v-list-item-title>
                <v-list-item-subtitle>{{ user.email }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>
          </v-list>

          <v-divider></v-divider>

          <v-card-actions>
            <v-btn text> Cerrar sessión </v-btn>
          </v-card-actions>
        </v-card>
      </v-menu>
    </v-toolbar>
    <v-container fluid>
      <slot></slot>
    </v-container>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
export default {
  computed: {
    ...mapGetters(["menu", "navigation_drawer", "user", "navigator"])
  },
  methods: {
    ...mapActions(["updateDrawer", "updateComponent"]),

    update_component(item) {
      if (item.title != this.navigator.component.title) {
        this.updateComponent(item);
        this.$router.push({ name: item.title });
      }
    }
  },
  data() {
    return {
      selectedItem: "",
      drawer: true,
      clipped: false
    };
  }
};
</script>
