<div class="col-12 card">
    <div class="col-12 card-body">
        <div class="table-responsive">
            <table id="usuarios_table" class="table table-striped col-12 w-100 data_table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Se unió en</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($results['users'] as $user)
                        <tr>
                            <td>
                                @if ($user->id == auth()->user()->id)
                                    <a class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                                        href="{{ route('perfil.index') }}"><img
                                            src="{{ asset($user->avatar()) }}"
                                            alt="{{ asset('images/avatar/default.png') }}"
                                            style="width: 20px; height: 20px; border-radius: 50%;" class="py-0"> {{ $user->name }}</a>
                                @else
                                    <a class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                                        href="{{ route('perfil.show', $user->id) }}"><img
                                        src="{{ asset($user->avatar()) }}"
                                        alt="{{ asset('images/avatar/default.png') }}"
                                        style="width: 20px; height: 20px; border-radius: 50%;" class="py-0"> {{ $user->name }}</a>
                                @endif
                            </td>
                            <td>{{ $user->created_at->format('d-m-Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
