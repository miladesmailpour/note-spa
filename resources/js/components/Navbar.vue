<template>
  <nav class="navbar navbar-expand-lg navbar-light shadow bg-main">
    <div class="container">
      <router-link
        :to="{ name: user ? 'home' : 'welcome' }"
        class="navbar-brand"
      >
        <!-- {{ appName }} -->
        <h1><span>N</span><span>Y</span><span>R</span></h1>
      </router-link>

      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbar"
      >
        <span class="navbar-toggler-icon" />
      </button>

      <div id="navbar" class="collapse navbar-collapse">
        <ul class="navbar-nav">
          <locale-dropdown />
          <!-- <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li> -->
        </ul>

        <ul class="navbar-nav ms-auto">
          <!-- Authenticated -->
          <li v-if="user" class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle text-dark"
              href="#"
              role="button"
              data-bs-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              <img
                :src="user.photo_url"
                class="rounded-circle profile-photo me-1"
              />
              {{ user.name }}
            </a>
            <div class="dropdown-menu">
              <router-link
                :to="{ name: 'settings.profile' }"
                class="dropdown-item ps-3"
              >
                <fa icon="cog" fixed-width />
                {{ $t("settings") }}
              </router-link>

              <div class="dropdown-divider" />
              <a href="#" class="dropdown-item ps-3" @click.prevent="logout">
                <fa icon="sign-out-alt" fixed-width />
                {{ $t("logout") }}
              </a>
            </div>
          </li>
          <!-- Guest -->
          <template v-else>
            <li class="nav-item">
              <router-link
                :to="{ name: 'login' }"
                class="nav-link"
                active-class="active"
              >
                {{ $t("login") }}
              </router-link>
            </li>
            <li class="nav-item">
              <router-link
                :to="{ name: 'register' }"
                class="nav-link"
                active-class="active"
              >
                {{ $t("register") }}
              </router-link>
            </li>
          </template>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
import { mapGetters } from "vuex";
import LocaleDropdown from "./LocaleDropdown";

export default {
  components: {
    LocaleDropdown,
  },

  data: () => ({
    appName: window.config.appName,
  }),

  computed: mapGetters({
    user: "auth/user",
  }),

  methods: {
    async logout() {
      // Log out the user.
      await this.$store.dispatch("auth/logout");

      // Redirect to login.
      this.$router.push({ name: "login" });
    },
  },
};
</script>

<style scoped>
.profile-photo {
  width: 2rem;
  height: 2rem;
  margin: -0.375rem 0;
}

.container {
  max-width: 1100px;
}
.shadow {
  box-shadow: 0 0 15px 4px rgba(0, 0, 0, 0.06);
}
.bg-main {
  background-color: cadetblue;
}
.app-name {
  text-shadow: 1px 1px 2px pink;
  color: #2a2e2a;
}

h1 {
  color: #484848;
  font-size: 35px;
  font-weight: bold;
  font-family: monospace;
  letter-spacing: 7px;
  cursor: pointer;
}
h1 span {
  transition: 0.5s linear;
}
h1:hover span:nth-child(1) {
  margin-right: 5px;
}
h1:hover span:nth-child(1):after {
  content: "ote";
}
h1:hover span:nth-child(2) {
  margin-left: 30px;
}
h1:hover span:nth-child(2):after {
  content: "our";
}
h1:hover span:nth-child(3) {
  margin-left: 30px;
}
h1:hover span:nth-child(3):after {
  content: "ates";
}
h1:hover span {
  color: #fff;
  text-shadow: 0 0 10px #fff, 0 0 20px #fff, 0 0 40px #fff;
}
/*made with ❤, by qpi65*/
</style>
