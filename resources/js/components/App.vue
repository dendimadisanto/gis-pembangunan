<template>
     <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
       <router-link class="sidebar-brand d-flex align-items-center justify-content-center" :to="{ name:'map' }">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-globe"></i>
        </div>
        <div class="sidebar-brand-text mx-3">GIS PEMBANGUNAN</div>
       </router-link>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <router-link class="nav-link" :to="{ name:'map' }">
          <i class="fas fa-fw fa-home"></i>
          <span>Home</span></router-link>
      </li>

       <li class="nav-item active">
        <router-link class="nav-link" :to="{ name:'sumber_dana' }">
          <i class="fas fa-fw fa-university"></i>
          <span>Sumber Dana</span></router-link>
      </li>

       <li class="nav-item active">
        <router-link class="nav-link" :to="{ name:'kegiatan_fisik' }">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Kegiatan Fisik</span></router-link>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
            <div class="container" style="justify-content:flex-end">
            <marquee direction="right">Selamat Datang di Web GIS Pembangunan&nbsp;&nbsp<i class="fas fa-globe"></i>&nbsp;&nbspHai Admin</marquee>
          </div>
            <button @click="login" class="btn btn-primary" >Login</button>
         
        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <router-view></router-view>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->
      
      <!-- modal login-->

      <div class="modal" tabindex="-1" role="dialog" aria-modal="true" id="modal-login" style="color:black">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Username</label>
                      <div class="input-container">
                        <i class="fa fa-user icon"></i>
                        <input class="form-control" type="text" placeholder="Username" name="usrnm">
                      </div>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                     <div class="input-container">
                        <i class="fa fa-key icon"></i>
                        <input class="form-control" type="password" placeholder="Password" name="psw">
                      </div>
                  </div>
                </form>
            </div>
            <div class="modal-footer">
                <button style="width:100%" type="button" class="btn btn-primary" @click="doLogin">Sign In</button>
            </div>
            </div>
        </div>
        </div>
  </div>
  <!-- End of Page Wrapper -->

</template>
<script>
export default {
    data(){
      return{
        isLogin:'false'
      } 
    },
    methods:{
      login(){
          $('#modal-login').modal('show');
      },
      doLogin(){
          axios.post('/do-login',App.request).then(response=>{
            
          })
      }
    }
}
</script>