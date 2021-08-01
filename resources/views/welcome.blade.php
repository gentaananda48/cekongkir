<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Check Ongkir</title>

    {{-- CSS External Online --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    {{-- JavaScript Ext. Online --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{--  --}}

</head>
<body>
    {{-- Content --}}
    <div class="container">
        <div class="row pt-5">
            <div class="col-lg-12">
                <div class="card">
                     <div class="card-header">
                        Cek Ongkir
                     </div>
                     <div class="card-body">
                         {{-- Form Cek Ongkir --}}
                        <form action="/" class="form-horizontal justify-content-center" role="form" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group justify-content-sm-center">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="province">Provinsi Asal</label>
                                        <select name="province_origin" id="province_origin" class="form-control">
                                            <option value="">--Provinsi--</option>
                                            @foreach ($provinces as $province => $value)
                                            <option value="{{ $province }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="city_origin">Kota Asal</label>
                                        <select name="city_origin" id="city_origin" class="form-control">
                                            <option>--Kota--</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="province_destination">Provinsi Tujuan</label>
                                        <select name="province_destination" id="province_destination" class="form-control">
                                            <option value="">--Provinsi--</option>
                                            @foreach ($provinces as $province => $value)
                                            <option value="{{ $province }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="city_destination">Kota Tujuan</label>
                                        <select name="city_destination" id="city_destination" class="form-control">
                                            <option>--Kota--</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="courier">Kurir</label>
                                        <select name="courier" id="courier" class="form-control">
                                            @foreach ($couriers as $courier => $value)
                                            <option value="{{ $courier }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="weight">Berat (g)</label>
                                        <input type="number" name="weight" id="weight" class="form-control" value="1000">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-success mt-3">Cari Harga</button>

                            </div>
                        </form>
                        {{-- end of Form Cek Ongkir --}}
                     </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end of Content --}}

    {{-- Script proses AJAX dependensi Drop Down --}}
    <script>
        // jQuery daerah asal
        $(document).ready(function(){
            $('select[name="province_origin"]').on('change', function(){
                let provinceId = $(this).val();
                if(provinceId) {
                    jQuery.ajax({
                        url:'/province/'+provinceId+'/cities',
                        type:"GET",
                        dataType:"json",
                        success:function(data){
                            $('select[name="city_origin"]').empty();
                            $.each(data, function(key, value){
                                $('select[name="city_origin"]').append('<option value="'+ key +'">'+ value + '</option>');
                            });
                        },
                    });
                } 
                else {
                    $('select[name="city_origin"]').empty();
                }
            });

            // jQuery daerah tujuan
            $('select[name="province_destination"]').on('change', function(){
                let provinceId = $(this).val();
                if(provinceId) {
                    jQuery.ajax({
                        url:'/province/'+provinceId+'/cities',
                        type:"GET",
                        dataType:"json",
                        success:function(data){
                            $('select[name="city_destination"]').empty();
                            $.each(data, function(key, value){
                                $('select[name="city_destination"]').append('<option value="'+ key +'">'+ value + '</option>');
                            });
                        },
                    });
                } 
                else {
                    $('select[name="city_destination"]').empty();
                }
            });

        });
    </script>
    {{-- end of Script proses AJAX dependensi Drop Down --}}
</body>
</html>