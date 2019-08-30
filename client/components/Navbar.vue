<template>
  <div class="">
    <nav class="navbar navbar-light bg-light justify-content-between">
      <nuxt-link to="/" class="navbar-brand">home</nuxt-link>
      <form class="form-inline" v-if="! loggedIn">
        <nuxt-link :to="{ name: 'login' }" class="nav-link text-black-50">login</nuxt-link>
        <nuxt-link to="register" class="nav-link text-black-50">register</nuxt-link>
      </form>
      <form class="form-inline" v-else>
        <a class="nav-link text-black-50">{{ user.name }}</a>
        <a href="#" class="nav-link text-black-50" @click.prevent="logout()">logout</a>
      </form>
    </nav>
  </div>
</template>

<script>
    import { mapGetters } from 'vuex';

    export default {
        computed: {
            ...mapGetters({
                user: 'user',
                loggedIn: 'loggedIn'
            })
        },
        methods: {
            async logout() {
                await this.$auth.logout();

                this.$router.replace({name: 'login'});
            }
        }
    }
</script>
