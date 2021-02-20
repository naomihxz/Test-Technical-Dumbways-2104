@extends('layout.master')

@section('content')
    <div class="container">
        {{-- Button Create cars --}}
        <button type="button" class="btn btn-primary my-2" data-toggle="modal" data-target="#add-cars">
            Tambah Mobil
        </button>

        {{-- Modal Create cars --}}
        <div class="modal fade" id="add-cars" tabindex="-1" role="dialog" aria-labelledby="id-cars" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="id-cars">Tambah Mobil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('car_store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                              <label for="name">Nama Mobil</label>
                              <input type="text" name="name" class="form-control" id="name" aria-describedby="name" placeholder="Masukkan nama mobil...">
                              @error('name')
                              <div class="text-danger">{{ $message }}</div>
                              @enderror
                            </div>
                            <div class="form-group">
                                <label for="car-brands">Brand Mobil</label>
                                <select class="form-control" id="car-brands" name="brand_id">
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}"> {{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                @error('brand_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="image" class="col-form-label">Upload Gambar</label>
                                <input type="file" class="form-control" id="image" name="image">
                                @error('image')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="color">Warna</label>
                                <input type="text" name="color" class="form-control" id="color" aria-describedby="color" placeholder="Masukkan warna mobil...">
                                @error('color')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Deskripsi</label>
                                <input type="text" name="description" class="form-control" id="description" aria-describedby="description" placeholder="Masukkan deskripsi mobil...">
                                @error('description')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="stock">Stok</label>
                                <input type="text" name="stock" class="form-control" id="stock" aria-describedby="stock" placeholder="Masukkan stock mobil...">
                                @error('stock')
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

        {{-- List cars --}}
        <table class="table">
            <thead>
              <tr>
                <th class="text-center" scope="col">Id</th>
                <th class="text-center" scope="col">Nama</th>
                <th class="text-center" scope="col">Brand</th>
                <th class="text-center" scope="col">Stok</th>
                <th class="text-center" scope="col">Gambar</th>
                <th class="text-center" scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach($cars as $car)
                <tr>
                    <th class="text-center" scope="row">{{ $car->id }}</th>
                    <td class="text-center">{{ $car->name }}</td>
                    <td class="text-center">{{ $car->brand->name }}</td>
                    <td class="text-center">{{ $car->stock }}</td>
                    <td class="text-center"><img src="{{ route('car_img', $car->id) }}" style="max-height: 200px"></td>
                    <td class="text-center">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#car-{{ $car->id }}">
                            Tambah stok
                        </button>
                        <form action="{{ route('car_destroy', ['car' => $car->id]) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger ml-3 my-2">Hapus</button>
                        </form>
                    </td>
                </tr>

                {{-- Modal Tambah Stok --}}
                <div class="modal fade" id="car-{{ $car->id }}" tabindex="-1" role="dialog" aria-labelledby="car-{{ $car->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="car-{{ $car->id }}">Tambah stok</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form method="POST" action="{{ route('car_stock', ['car' => $car->id]) }}">
                            @method('PATCH')
                            @csrf
                            <fieldset disabled>
                                <div class="form-group">
                                    <label for="id-car">Id</label>
                                    <input type="text" name="id" value="{{$car->id}}" id="id-car" class="form-control" placeholder="{{ $car->id }}">
                                </div>
                            </fieldset>
                            <div class="form-group">
                                <label for="stock">Tambah Stok</label>
                                <input type="text" name="stock" class="form-control" id="stock" aria-describedby="stock" placeholder="Ingin menambah stok sebanyak...">
                                @error('stock')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Tambah</button>
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
