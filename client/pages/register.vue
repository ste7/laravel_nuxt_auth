<template>
  <div class="container">
    <form class="col-md-5">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" aria-describedby="name" placeholder="Enter name" v-model="form.name">
        <small class="text-danger" v-if="hasError('name')">{{ errors.name[0] }}</small>
      </div>
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
      <div class="form-group">
        <label for="passwordConfirmation">Confirm password</label>
        <input type="password" class="form-control" id="passwordConfirmation" placeholder="Confirm password" v-model="form.password_confirmation">
      </div>
      <button type="submit" class="btn btn-primary" @click.prevent="submit()">Submit</button>
    </form>
  </div>
</template>

<script>
    export default {
        middleware: 'redirectIfLoggedIn',
        data() {
            return {
                form: {
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: ''
                },
                errors: null
            }
        },
        methods: {
            async submit() {
                this.errors = null;

                try {
                    await this.$axios.$post('api/auth/register', this.form);

                    this.$router.push('/login');
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
