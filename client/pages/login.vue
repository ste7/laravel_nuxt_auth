<template>
  <div>
    <div class="container">
      <form class="col-md-5">
        <div class="form-group">
          <label for="email">Email address</label>
          <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" v-model="form.email">
          <small class="text-danger" v-if="hasError('email')">{{ errors.email[0] }}</small>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" v-model="form.password">
          <small class="text-danger" v-if="hasError('password')">{{ errors.password[0] }}</small>
        </div>
        <button type="submit" class="btn btn-primary" @click.prevent="submit()">Submit</button>
      </form>
    </div>
  </div>
</template>

<script>
    import { mapActions, mapGetters } from 'vuex';

    export default {
        middleware: 'redirectIfLoggedIn',
        data() {
            return {
                form: {
                    email: '',
                    password: ''
                },
                errors: null
            }
        },
        methods: {
            ...mapActions({
                login: 'login'
            }),
            async submit() {
                try {
                    await this.$auth.loginWith('local', {
                        data: this.form
                    });

                    this.$router.replace({name: 'index'});
                } catch (e) {
                    console.log(this.errors = e.response.data.errors);
                }
            },
            hasError(field) {
                if (this.errors !== null && this.errors.hasOwnProperty(field)) return true;
            }
        }
    }
</script>

<style>
  .container {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
  }
</style>
