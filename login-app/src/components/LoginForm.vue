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
    created: function(){
      alert('I got created');
    },
    loginProc: function (e) {
      e.preventDefault();
      axios
          .get('https://api.coindesk.com/v1/bpi/currentprice.json')
          .then(function(response) {
            alert(JSON.stringify(response));
          });


    },
    changePasswordClick: function(){
      alert("Some Day We will do this?");
    }
  }
}
</script>

<style scoped>

</style>