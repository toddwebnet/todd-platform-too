1
<template>
  <div>
    <nav-bar></nav-bar>

    <main role="main">
      <div class="container">

        Stuff Goes Hereasdfasdf
        Stuff Goes Hereasdfasdf
        Stuff Goes Hereasdfasdf
        Stuff Goes Hereasdfasdf
        Stuff Goes Hereasdfasdf
        <textarea ></textarea>
        <br/><br/><br/>
        {{ dude }}
      </div>
    </main>
  </div>
</template>

<script>

import NavBar from "./NavBar";

export default {
  permissions: {'f':3},
  name: "App.vue",
  components: {NavBar},

  computed: {
    dude: function () {
      return this.permissions;
    }
  },
  mounted: function () {
    let token = this.$cookies.get('token');
    if (token !== null) {
      this.getAndSetPermissions(token);
    } else {
      this.redirectToLogin();
      return;
    }
    //this.$cookies.get('token')
  },
  methods: {

    redirectToLogin: function () {
      document.location = "http://login.tpt.com?redirect" + encodeURI("http://admin.tpt.com");
    },
    changeState: function (stateValue) {
      this.state = stateValue;
    },
    showError: function (errorMessage) {
      this.showErrorInd = true;
      this.errorMessage = errorMessage;
    },
    hideError: function () {
      this.errorMessage = '';
      this.showErrorInd = false;
    },
    getAndSetPermissions: (token) => {
      const url = config.sessionApiPath + '/get'
      axios
          .get(url, {
            headers: {
              'token': token
            }
          })
          .then(response => {
            alert(JSON.stringify(response.data));
            this.permissions = {'one': 'two'};
          })
          .catch(error => {

          })
          .then(() => {


          })

    }

  }
}
</script>

<style scoped>
.container {
  margin-top: 55px;
}
</style>