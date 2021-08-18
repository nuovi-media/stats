@if (session('success'))
    <div class="row">
        <div class="col-12">
            <x-adminlte-alert theme="success">
            {{ session('success') }}
            </x-adminlte-alert>
        </div>
    </div>
@endif

@if (session('danger'))
    <div class="row">
        <div class="col-12">
            <x-adminlte-alert theme="danger">
                {{ session('danger') }}
            </x-adminlte-alert>
        </div>
    </div>
@endif
