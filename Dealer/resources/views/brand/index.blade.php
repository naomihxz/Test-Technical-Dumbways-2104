@extends('layout.master')

@section('content')
    <div class="container">
        {{-- Button Create Brand --}}
        <button type="button" class="btn btn-primary my-2" data-toggle="modal" data-target="#add-brand">
            Tambah Brand Baru
        </button>

        {{-- Modal Create Brand --}}
        <div class="modal fade" id="add-brand" tabindex="-1" role="dialog" aria-labelledby="id-brand" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="id-brand">Tambah Brand</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('brand_store') }}">
                            @csrf
                            <div class="form-group">
                              <label for="name">Nama Brand</label>
                              <input type="text" name="name" class="form-control" id="name" aria-describedby="name" placeholder="Masukkan nama brand...">
                              @error('name')
                              <div class="text-danger">{{ $message }}</div>
                              @enderror
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- List Brand --}}
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Nama</th>
                <th scope="col">Jumlah Mobil</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach($brands as $brand)
                <tr>
                    <th scope="row">{{ $brand->id }}</th>
                    <td>{{ $brand->name }}</td>
                    <td>{{ $brand->cars_count() }}</td>
                    <td>
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit-brand-{{ $brand->id }}">
                            Edit
                        </button>
                        <form action="{{ route('brand_destroy', ['brand' => $brand->id]) }}" method="POST" class="form-inline">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger ml-3 my-2">Hapus</button>
                        </form>
                    </td>
                </tr>

                {{-- Modal Edit --}}
                <div class="modal fade" id="edit-brand-{{ $brand->id }}" tabindex="-1" role="dialog" aria-labelledby="edit-brand-{{ $brand->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="edit-brand-{{ $brand->id }}">Edit Brand</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('brand_update', ['brand' => $brand->id]) }}">
                                    @method('PATCH')
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Nama Brand</label>
                                        <input type="text" name="name" class="form-control" id="name" value={{ old('name') ?? $brand->name }} aria-describedby="name" placeholder="Masukkan nama brand...">
                                        @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
