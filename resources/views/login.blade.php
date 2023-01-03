@include('header')
<div
   class="d-flex justify-content-center align-items-center"
   style="width: 100vw; height: 100vh"
>
   <div class="">
      <center>
         <img
            src="https://bibit-unggul.var-x.id/logo/logo.png"
            class="mb-4"
            width="100px"
            alt="Logo"
         />
      </center>
      <div class="card m-3">
         <div class="card-body">
            @if ($errors->has('message'))
            <div
               class="alert alert-danger mt-3"
               style="text-align: left"
               role="alert"
            >
               {{ $errors->first('message') }}
            </div>
            @endif
            <form action="{{ url('login') }}" method="POST">
               @csrf
               <div class="form-group">
                  <label>Email</label>
                  <input
                     type="email"
                     name="email"
                     class="form-control"
                     placeholder="Email"
                  />
               </div>
               <div class="form-group">
                  <label>Password</label>
                  <input
                     type="password"
                     name="password"
                     class="form-control"
                     placeholder="Password"
                  />
               </div>
               <div class="d-flex justify-content-between">
                  <button type="submit" class="btn btn-success btn-sm">
                     Login
                  </button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

@include('footer')
