<template>
  <div class="container">
    <div class="d-flex justify-content-center h-100">
      <div class="card">
        <div class="card-header">
          <h3>
            <span v-if="state==='loading'"
                  class="float-left"
            >
              <img src="/images/spinner.gif"
                   style="width: 35px"
              />
            </span>
            Sign In
          </h3>
        </div>
        <div class="card-body">
          <LoginForm :state="state"></LoginForm>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import LoginForm from "./LoginForm";

export default {
  name: "App.vue",
  components: {LoginForm},
  data: function () {
    return {
      state: 'ready',
    };
  },
  methods: {
    changeState: function (stateValue) {
      this.state = stateValue;
    },
  }
}
</script>

<style>
</style>