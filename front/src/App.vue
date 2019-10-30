<template>
  <v-app id="app">
    <v-navigation-drawer
            v-model="drawer"
            app
            clipped
            dark
    >

      <NavigationDrawerItems>
      </NavigationDrawerItems>

      <template v-slot:append>
        <v-list-item link :ripple="{ class: 'red-text' }" @click="logout" v-if="currentUser">
          <v-list-item-action>
            <font-awesome-icon icon="sign-out-alt" size="lg" class="red--text"/>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title class="red--text">Wyloguj</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <router-link :to="{name: 'Login'}" class="route" v-else>
          <v-list-item link :ripple="{ class: 'green-text' }">
            <v-list-item-action>
              <font-awesome-icon icon="sign-in-alt" size="lg" class="green--text"/>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title class="green--text">Zaloguj</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </router-link>
      </template>
    </v-navigation-drawer>

    <Toolbar>
      <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
    </Toolbar>

    <v-content>
      <router-view></router-view>
    </v-content>

    <Footer></Footer>

  </v-app>
</template>

<style>
  .route {
    text-decoration: none;
  }
</style>

<script>
  import Footer from "./components/Layout/Footer";
  import Toolbar from "./components/Layout/Toolbar";
  import NavigationDrawerItems from "./components/Layout/NavigationDrawerItems";

  export default {
    data: () => ({
      drawer: null,
      logged: false,
    }),
    components: {
      Toolbar,
      NavigationDrawerItems,
      Footer,
    },
    methods: {
      logout() {
        this.$store.commit('logout');
        this.$router.push('/login');
      },
    },
    computed: {
      currentUser() {
        return this.$store.getters.currentUser;
      },
    }
  }
</script>