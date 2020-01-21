<template>
    <div class="container-fluid">
    <nav class="navbar navbar-expand-sm bg-light">

  <!-- Links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="#">Categpry</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Forum</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Post</a>
    </li>
  </ul>

</nav>
<div class="card-body card card-accent-primary">
             <div class="card">
                <div class="card-header pr-0 pl-0">
                    <div class="row no-gutters align-items-center w-100">
                        <div class="col font-weight-bold pl-3">General</div>
                        <div class="d-none d-md-block col-6 text-muted">
                            <div class="row no-gutters align-items-center">
                                <div class="col-3">Threads</div>
                                <div class="col-3">Replies</div>
                                <div class="col-6">Last update</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-8">
                    <div class="row no-gutters align-items-center">
                        <div class="col"><a href="javascript:void(0)" class="text-big font-weight-semibold" data-abc="true">Getting started with BBBootstrap.com</a></div>
                        <div class="d-none d-md-block col-6">
                            <div class="row no-gutters align-items-center">
                                <div class="col-3">120</div>
                                <div class="col-3">14</div>
                                <div class="media col-6 align-items-center"> <img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1574583246/AAA/2.jpg" alt="" class="d-block ui-w-30 rounded-circle">
                                    <div class="media-body flex-truncate ml-2"> <a href="javascript:void(0)" class="d-block text-truncate" data-abc="true">Thankyou for your help. appreciate your solution</a>
                                        <div class="text-muted small text-truncate">2d ago &nbsp;·&nbsp; <a href="javascript:void(0)" class="text-muted" data-abc="true">William Smith</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="m-0">
                <div class="card-body py-3">
                    <div class="row no-gutters align-items-center">
                        <div class="col"><a href="javascript:void(0)" class="text-big font-weight-semibold" data-abc="true">Announcements</a></div>
                        <div class="d-none d-md-block col-6">
                            <div class="row no-gutters align-items-center">
                                <div class="col-3">23</div>
                                <div class="col-3">12</div>
                                <div class="media col-6 align-items-center"> <img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1574583319/AAA/3.jpg" alt="" class="d-block ui-w-30 rounded-circle">
                                    <div class="media-body flex-truncate ml-2"> <a href="javascript:void(0)" class="d-block text-truncate" data-abc="true">We have created a new feature for developers and designers</a>
                                        <div class="text-muted small text-truncate">1d ago &nbsp;·&nbsp; <a href="javascript:void(0)" class="text-muted" data-abc="true">Rodie Angel</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="m-0">
                <div class="card-body py-3">
                    <div class="row no-gutters align-items-center">
                        <div class="col"><a href="javascript:void(0)" class="text-big font-weight-semibold" data-abc="true">Guides</a></div>
                        <div class="d-none d-md-block col-6">
                            <div class="row no-gutters align-items-center">
                                <div class="col-3">42</div>
                                <div class="col-3">654</div>
                                <div class="media col-6 align-items-center"> <img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1574583336/AAA/4.jpg" alt="" class="d-block ui-w-30 rounded-circle">
                                    <div class="media-body flex-truncate ml-2"> <a href="javascript:void(0)" class="d-block text-truncate" data-abc="true">To enable new notifications. just go to settings.</a>
                                        <div class="text-muted small text-truncate">1d ago &nbsp;·&nbsp; <a href="javascript:void(0)" class="text-muted" data-abc="true">Kim Nicolas </a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
// import Navbar from "./components/navbar";
import NProgress from "nprogress";

import Helper from "../utils/helper";

export default {
  name: "app",
  // components: {Navbar},
  data() {
    return {
      user: null,
      postsCount: 0,
      activeThreads: null,
      threadCount: 0,
      loading: false,
      helper: Helper
    };
  },

  mounted() {
    this.init();
  },

  methods: {
    init() {
      let $this = this;
      axios.get("general/lists").then(function(response) {
        $this.user = response.data.user;
        $this.threadCount = response.data.threadCount;
        $this.activeThreads = response.data.activeThreads;
      });
    }
  }
};
</script>

<style>
.fade-enter-active {
  transition: opacity 0.5s;
}
.fade-enter /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}

.bigSpinner {
  margin: 25% auto auto;
}
</style>