@extends('layout.master')

@section('content')
    <div class="container">
        {{-- Button Create customer --}}
        <button type="button" class="btn btn-primary my-2" data-toggle="modal" data-target="#add-customer">
            Tambah Customer
        </button>

        {{-- Modal Create customer --}}
        <div class="modal fade" id="add-customer" tabindex="-1" role="dialog" aria-labelledby="id-customer" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="id-customer">Tambah Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('customer_store') }}">
                            @csrf
                            <div class="form-group">
                              <label for="name">Nama Customer</label>
                              <input type="text" name="name" class="form-control" id="name" aria-describedby="name" placeholder="Masukkan nama customer..">
                              @error('name')
                              <div class="text-danger">{{ $message }}</div>
                              @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email Customer</label>
                                <input type="text" name="email" class="form-control" id="email" aria-describedby="email" placeholder="Masukkan email customer..">
                                @error('email')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="address">Alamat Customer</label>
                                <input type="text" name="address" class="form-control" id="address" aria-describedby="address" placeholder="Masukkan alamat customer..">
                                @error('address')
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

        {{-- List customer --}}
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Nama</th>
                <th scope="col">Email</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach($customers as $customer)
                <tr>
                    <th scope="row">{{ $customer->id }}</th>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit-customer-{{ $customer->id }}">
                            Edit
                        </button>
                        <form action="{{ route('customer_destroy', ['customer' => $customer->id]) }}" method="POST" class="form-inline">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger ml-3 my-2">Hapus</button>
                        </form>
                    </td>
                </tr>

                {{-- Modal Edit --}}
                <div class="modal fade" id="edit-customer-{{ $customer->id }}" tabindex="-1" role="dialog" aria-labelledby="edit-customer-{{ $customer->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="edit-customer-{{ $customer->id }}">Edit customer</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('customer_update', ['customer' => $customer->id]) }}">
                                    @method('PATCH')
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Nama Customer</label>
                                        <input type="text" name="name" class="form-control" id="name" value={{ old('name') ?? $customer->name }} aria-describedby="name" placeholder="Masukkan nama customer..">
                                        @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Email Customer</label>
                                        <input type="text" name="email" class="form-control" id="email" value={{ old('email') ?? $customer->email }} aria-describedby="email" placeholder="Masukkan email customer..">
                                        @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Alamat Customer</label>
                                        <input type="text" name="address" class="form-control" id="address" value={{ old('addres') ?? $customer->address}} aria-describedby="address" placeholder="Masukkan alamat customer..">
                                        @error('address')
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
