const menu = Vue.component('MyMenu', {
    props: ['navigation', 'acl'],
    template: `
    <div>
         <v-toolbar fixed app :clipped="clipped" dark>
           <v-app-bar-nav-icon @click.stop="updateState"></v-app-bar-nav-icon>
            <v-toolbar-title>
            {{ navigation.component.title }}
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn icon  v-for="item in acl.menu" :key="item.title" link>
                <v-icon>{{ item.icon }}</v-icon>
            </v-btn>
        </v-toolbar>

        <v-toolbar class="brown darken-4" app="app">
            <v-toolbar-side-icon @click.stop="clickToggleDrawer"></v-toolbar-side-icon>
            <v-spacer></v-spacer>
            <v-btn icon="icon">
                <v-icon>search</v-icon>
            </v-btn>
            <v-btn icon="icon">
                <v-icon>email</v-icon>
            </v-btn>
            <v-menu offset-y="offset-y">
                <v-btn flat="flat" slot="activator" small="small">John Doe
                <v-icon>keyboard_arrow_down</v-icon>
                </v-btn>
                <v-list>
                <v-list-tile @click="">
                    <v-icon class="mr-2">settings</v-icon>
                    <v-list-tile-title>Settings</v-list-tile-title>
                </v-list-tile>
                <v-list-tile @click="">
                    <v-icon class="mr-2">exit_to_app</v-icon>
                    <v-list-tile-title>Logout</v-list-tile-title>
                </v-list-tile>
                </v-list>
            </v-menu>
            <v-avatar class="mr-2" size="36"><img src="http://i.pravatar.cc/150?img=53"/></v-avatar>
        </v-toolbar>
        <section id="scrolling-techniques-7" class="overflow-y-auto">
            <slot></slot>
        </section>



    </div>
    `,
    data() {
        return {
            clipped: false
        }
    },
    methods: {
        updateState() {
            this.navigation.drawer = !this.navigation.drawer;
        }
    }

});
