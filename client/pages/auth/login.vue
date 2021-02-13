<template>
  <a-layout>
    <a-layout-content style="min-height: calc(100vh - 90px);">
      <a-row style="min-height: 80vh;" type="flex" align="middle" justify="center">
        <a-col xl="14" lg="14" sm="24" xs="24" md="16">
          <a-card title="Register">
            <a-form
              id="components-form-demo-normal-login"
              class="login-form"
              @submit.prevent="handleSubmit"
            >
              <a-form-item
                label="E-mail Address"
                :validate-status="errors.email ? 'error' : ''"
                :help="errors.email ? errors.email[0] : ''">
                <a-input required type="email" v-model="form.email" placeholder="Please enter your E-mail Address">
                  <a-icon slot="prefix" type="mail" style="color: rgba(0,0,0,.25)"/>
                </a-input>
              </a-form-item>

              <a-form-item
                label="Password"
                :validate-status="errors.password ? 'error' : ''"
                :help="errors.password ? errors.password[0] : ''">
                <a-input required type="password" v-model="form.password" placeholder="Please enter your password">
                  <a-icon slot="prefix" type="lock" style="color: rgba(0,0,0,.25)"/>
                </a-input>
              </a-form-item>

              <a-form-item>
                <n-link to="/auth/register">
                  Haven't got a user? Sign up here!
                </n-link>
                <a class="login-form-forgot" href="">
                  Forgot password
                </a>
                <a-button v-on:click="handleSubmit" type="primary" html-type="submit" class="login-form-button">
                  Sign In
                </a-button>
              </a-form-item>
            </a-form>
          </a-card>
        </a-col>
      </a-row>
    </a-layout-content>
  </a-layout>
</template>
<script>
  export default {
    data() {
      return {
        errors: [],
        form: {
          email: '',
          password: '',
        },
        validUser: false
      }
    },
    methods: {
      filterOption(input, option) {
        return (
          option.componentOptions.children[0].text.toLowerCase().indexOf(input.toLowerCase()) >= 0
        );
      },

      async handleSubmit(e) {
        e.preventDefault();

        // try {
        //   await this.$axios.$get('sanctum/csrf-cookie')
        //   await this.$axios.post('/api/verified', {email: this.form.email, password: this.form.password})
        //       .then(res => this.validUser = res.data.validUser)
        //         if(this.validUser) {
        //           try{
        //             await this.$axios.$get('sanctum/csrf-cookie')
        //             await this.$auth.loginWith('local', {data: this.form})
        //           } catch(e) {
        //                 this.errors = e.response.data.errors;
        //           }
        //         } else if(this.validUser === false) {
        //             this.errors = { email: { 0: 'Please verify your email first.'}};
        //         } 
        //   } catch(e) {
        //       this.errors = e.response.data.errors;

        //     // if(e.response.data.errors){
        //       // this.errors = e.response;
        //     // }
        // }

          try {

            await this.$axios.$get('sanctum/csrf-cookie');
            await this.$auth.loginWith('local', {data: this.form})
              
          } catch (e) {
            if(e.response.data.errors){
              this.errors = e.response.data.errors;
            } else if(e.response.request.status == 401) {
              this.errors = { email: { 0: 'Credentials does not match to any user.'}}
            }
          }
      }
    }
  }
</script>
<style>
  #components-form-demo-normal-login .login-form-forgot {
    float: right;
  }
  #components-form-demo-normal-login .login-form-button {
    width: 100%;
  }
</style>
