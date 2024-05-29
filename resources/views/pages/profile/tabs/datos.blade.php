<div class="card">
    <div class="card-body">
        <div class="d-flex flex-wrap">
            <div class="col-md-5 align-items-center justify-content-center text-center">
                <div class="d-felx">
                    <div>
                        <img class="img-thumbnail" src="{{ auth()->user()->avatar() }}" alt="Avatar" style="width: 200px; height: 200px;">
                    </div>
                    <div class="">
                        <a data-bs-toggle="modal" data-bs-target="#cambioAvatar" class="btn btn-primary">Cambiar</a>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="name" value="{{ auth()->user()->name }}"
                        readonly>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" value="{{ auth()->user()->email }}"
                        readonly>
                </div>
                <div class="mb-3 text-end">
                    <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cambioPass">
                        <span class="text-center mb-3">Cambio de contraseña</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
