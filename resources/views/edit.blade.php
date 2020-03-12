@extends('DashboardModule::dashboard.index')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @include('DashboardModule::partials.alerts')

                        <h4 class="card-title">
                            {{ isset($hotel) ? 'Edytowanie' : 'Dodawanie nowego' }} hotelu
                        </h4>
                        <form method="POST" action="{{ isset($hotel) ? route('MapsModule::maps.update', ['hotel' => $hotel]) : route('MapsModule::maps.store') }}" enctype="multipart/form-data">
                            @csrf
                            @if (isset($hotel))
                                @method('PUT')
                            @endif

                            <div class="d-flex justify-content-center">
                                <div class="form-group @error('name') has-danger @enderror col-6">
                                    <label for="">Nazwa</label>
                                    <input type="text" class="form-control" name="name" placeholder="Wpisz nazwe" value="{{ isset($hotel) ? $hotel->name : old('name') }}">
                                    @error('name')
                                        <small class="error mt-1 text-danger d-block">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group @error('full_name') has-danger @enderror col-6">
                                    <label for="">Pełna Nazwa</label>
                                    <input type="text" class="form-control" name="full_name" placeholder="Wpisz pełną nazwę" value="{{ isset($hotel) ? $hotel->full_name : old('full_name') }}">
                                    @error('full_name')
                                        <small class="error mt-1 text-danger d-block">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="photo">Logo</label>
                                <input
                                    id="logo"
                                    type="file"
                                    name="logo_file"
                                    class="dropify"
                                    data-height="100"
                                    data-allowed-file-extensions="svg png jpg jpeg"
                                    @if(isset($hotel) && isset($hotel->logo))
                                        data-default-file="{{asset($hotel->logo)}}"
                                    @endif
                                    data-max-file-size="1M">

                                @error('logo_file')
                                    <small class="error mt-1 text-danger d-block">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="photo">Zdjęcie obiektu</label>
                                <input
                                    id="photo"
                                    type="file"
                                    name="photo_file"
                                    class="dropify"
                                    data-height="100"
                                    data-allowed-file-extensions="svg png jpg jpeg"
                                    @if(isset($hotel))
                                        data-default-file="{{asset($hotel->photo)}}"
                                    @endif
                                    data-max-file-size="1M">

                                @error('photo_file')
                                    <small class="error mt-1 text-danger d-block">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-center">
                                <div class="form-group @error('coordinates.latitude') has-danger @enderror col-6">
                                    <label for="">Latitude</label>
                                    <input type="text" class="form-control" name="coordinates[latitude]" value="{{ isset($hotel) ? $hotel->coordinates['latitude'] : old('coordinates.latitude') }}">
                                    @error('coordinates.latitude')
                                        <small class="error mt-1 text-danger d-block">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group @error('coordinates.longitude') has-danger @enderror col-6">
                                    <label for="">Longitude</label>
                                    <input type="text" class="form-control" name="coordinates[longitude]" value="{{ isset($hotel) ? $hotel->coordinates['longitude'] : old('coordinates.longitude')}}">
                                    @error('coordinates.longitude')
                                        <small class="error mt-1 text-danger d-block">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex justify-content-center">
                                <div class="form-group @error('reservation') has-danger @enderror col-6">
                                    <label for="">Rezerwacja</label>
                                    <input type="text" class="form-control" name="reservation" value="{{ isset($hotel) ? $hotel->reservation : old('reservation')}}">
                                    @error('reservation')
                                        <small class="error mt-1 text-danger d-block">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group @error('reception') has-danger @enderror col-6">
                                    <label for="">Recepcja</label>
                                    <input type="text" class="form-control" name="reception" value="{{ isset($hotel) ? $hotel->reception : old('reception')}}">
                                    @error('reception')
                                        <small class="error mt-1 text-danger d-block">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex justify-content-center">
                                <div class="form-group @error('localization') has-danger @enderror col-6">
                                    <label for="">Miasto</label>
                                    <input type="text" class="form-control" name="localization" value="{{ isset($hotel) ? $hotel->localization : old('localization')}}">
                                    @error('localization')
                                        <small class="error mt-1 text-danger d-block">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group @error('status') has-danger @enderror col-6">
                                    <label for="">Rezerwacja</label>
                                    <select type="text" class="form-control" name="status">
                                        @php
                                            $currentStatus = isset($hotel) ? $hotel->status : old('status')
                                        @endphp
                                        @foreach($statuses as $status)
                                            <option value="{{$status}}" @if($currentStatus === $status) selected @endif>
                                                {{ $status }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center">
                                <div class="form-group @error('street') has-danger @enderror col-6">
                                    <label for="">Ulica</label>
                                    <input type="text" class="form-control" name="street" value="{{ isset($hotel) ? $hotel->street : old('street') }}">
                                    @error('street')
                                        <small class="error mt-1 text-danger d-block">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group @error('sell') has-danger @enderror col-6">
                                    <label for="">Sprzedaż</label>
                                    <input type="text" class="form-control" name="sell" value="{{ isset($hotel) ? $hotel->sell : old('sell') }}">
                                    @error('sell')
                                        <small class="error mt-1 text-danger d-block">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group @error('arrive') has-danger @enderror col-12">
                                <label for="">Jak dojade</label>
                                <input type="text" class="form-control" name="arrive" value="{{ isset($hotel) ? $hotel->arrive : old('arrive') }}">
                                @error('arrive')
                                    <small class="error mt-1 text-danger d-block">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group @error('copyright') has-danger @enderror col-12">
                                <label for="">Copyright</label>
                                <input type="text" class="form-control" name="copyright" value="{{ isset($hotel) ? $hotel->copyright : old('copyright') }}">
                                @error('copyright')
                                    <small class="error mt-1 text-danger d-block">{{ $message }}</small>
                                @enderror
                            </div>

                            <button type="submit" class="float-right mt-2 btn btn-success mr-2">Zapisz</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('javascripts')
    @parent
    <script>
        $('.dropify').dropify({})
    </script>
@endsection
