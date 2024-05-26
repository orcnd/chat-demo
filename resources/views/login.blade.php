

<style>
.bd-placeholder-img {
    font-size: 1.125rem;
    text-anchor: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    user-select: none;
}

@media (min-width: 768px) {
    .bd-placeholder-img-lg {
        font-size: 3.5rem;
    }
}

html,
body {
  height: 100%;
}

body {
  display: flex;
  align-items: center;
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #f5f5f5;
}

.form-signin {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: auto;
}

.form-signin .checkbox {
  font-weight: 400;
}

.form-signin .form-floating:focus-within {
  z-index: 2;
}

.form-signin input[type="text"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
</style>
 
<main class="form-signin">
  <form action="{{route('loginAction')}}" hx-trigger="submit" hx-target="#main" hx-post="{{route('loginAction')}}" 
   hx-target="#main" >
  @csrf
    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
    <div class="form-floating">
      <input type="text" class="form-control
       @error('name') is-invalid @enderror
      " id="floatingInput" name="name"
       placeholder="chat handle of yours"
       required
       >
      <label for="floatingInput">Chat handle</label>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted">&copy; May 2024</p>
  </form>
</main>