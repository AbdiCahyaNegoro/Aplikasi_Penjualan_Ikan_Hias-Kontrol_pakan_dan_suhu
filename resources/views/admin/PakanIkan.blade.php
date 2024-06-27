@extends('layouts.beranda.masterberanda')

@section('content')
    <div class="container-fluid">
        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Pakan Ikan</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Kontrol Pemberi Pakan Ikan</h1>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <button id="feedBtn" class="btn btn-primary btn-block">Beri Makan Ikan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('feedBtn').addEventListener('click', function() {
            fetch('{{ route('kasihmakan') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log(data.message); // Pesan sukses dari server
                // Tambahkan logika lain jika perlu
            })
            .catch(error => {
                console.error('There has been a problem with your fetch operation:', error);
            });
        });
    </script>
@endsection
