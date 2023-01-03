<nav class="navbar navbar-expand-lg navbar-light bg-light">
   <div class="container">
      <a class="navbar-brand" href="#">
         <img src="https://bibit-unggul.var-x.id/logo/logo.png" height="30" />
      </a>
      <button
         class="navbar-toggler"
         type="button"
         data-toggle="collapse"
         data-target="#navbarNav"
         aria-controls="navbarNav"
         aria-expanded="false"
         aria-label="Toggle navigation"
      >
         <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
         <ul class="navbar-nav ml-auto">
            <li class="nav-item mr-4">
               <a class="nav-link text-dark" href="/dashboard">Dashboard</a>
            </li>
            <li class="nav-item mr-4">
               <a class="nav-link text-dark" href="/jimpitan/tampil"
                  >Jimpitan</a
               >
            </li>
            @if (Auth::user()->level == 'admin')
            <li class="nav-item mr-4">
               <a class="nav-link text-dark" href="/admin/tampil">Admin</a>
            </li>
            <li class="nav-item mr-4">
               <a class="nav-link text-dark" href="/rt-rw/tampil">RT/RW</a>
            </li>
            <li class="nav-item mr-4">
               <a class="nav-link text-dark" href="/warga/tampil">Warga</a>
            </li>
            <li class="nav-item mr-4">
               <a class="nav-link text-dark" href="/kas-warga/tampil"
                  >Kas Warga</a
               >
            </li>
            @endif
            <li>
               <a
                  class="nav-link text-danger"
                  href="/logout"
                  onclick="return confirm('Klick OK jika ingin Logout');"
                  >Logout</a
               >
            </li>
         </ul>
      </div>
   </div>
</nav>
<br />
