<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible"
    content="ie=edge">

  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900"
    rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css"
    rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css"
    rel="stylesheet">
  <meta id="token"
    name="csrf-token"
    value="{{ csrf_token() }}">
  <link href="https://fonts.googleapis.com/css2?family=Material+Icons"
    rel="stylesheet">
  <title>Document</title>


  <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="https://unpkg.com/vue-router/dist/vue-router.js"></script>
</head>

<body>


  <div id="app">
    <v-app>
      <v-main>

        <v-app-bar color="deep-purple accent-4"
          dark
          :clipped-left="!drawer">
          <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>

          <v-toolbar-title>My files @{{ drawer }}</v-toolbar-title>

          <v-spacer></v-spacer>

          <v-btn icon>
            <v-icon>mdi-magnify</v-icon>
          </v-btn>

          <v-btn icon>
            <v-icon>mdi-filter</v-icon>
          </v-btn>

          <v-btn icon>
            <v-icon>mdi-dots-vertical</v-icon>
          </v-btn>
        </v-app-bar>

        <v-navigation-drawer v-model="drawer"
          bottom>
          <v-list nav
            dense>

          </v-list>
        </v-navigation-drawer>

      </v-main>
    </v-app>
  </div>

  <script>

    new Vue({
      el: '#app',
      vuetify: new Vuetify({

      }),
      data() {
        return {
          drawer: true,

        }
      }
    })

  </script>
</body>

</html>
