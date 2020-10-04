<template>
  <form @submit="loginProc" action="">
    <div class="input-group form-group">
      <div class="input-group-prepend">
                <span class="input-group-text">
                  <fa-icon icon="user"/>
                </span>
      </div>
      <input type="text"
             class="form-control"
             placeholder="email address"
             v-model="loginForm.email"
      />

    </div>
    <div class="input-group form-group">
      <div class="input-group-prepend">
                <span class="input-group-text">
                  <fa-icon icon="key"/>
                </span>
      </div>
      <input type="password"
             class="form-control"
             placeholder="password"
             v-model="loginForm.password"
      />
    </div>
    <div class="form-group">
      <input type="submit" value="Login" class="btn float-right login_btn">
      <a href="#"
         class="float-left forgot_password"
         @click='changePasswordClick'
      >Forgot your password?</a>
    </div>
  </form>
</template>

<script>
export default {
  name: "LoginForm",
  data: function () {
    return {
      loginForm: {
        email: '',
        password: '',
      }
    };
  },
  methods: {
    showMessage: function (message) {
    },
    loginProc: function (e) {
      e.preventDefault();
      const url = config.accountApiHost + '/authenticate'
      this.$parent.changeState('loading');
      this.$parent.hideError();
      axios
          .post(url, this.loginForm)
          .then(response => {
            // this.$cookies.set('token',response.data.token, null, null, config.domain);
            document.location = redirectUrl;

          })
          .catch(error => {
            this.$parent.showError(error.response.data.message);
          })
          .then(()=> {
            this.$parent.changeState('ready');

          });


    },
    changePasswordClick: function () {
      alert("Some Day We will do this?");
    }
  }
}
</script>

<style scoped>

</style>