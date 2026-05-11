
@extends('layout')

@section('content')

    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f6f9; margin: 0; padding: 0; }
        .container { width: 90%; max-width: 1000px; margin: 40px auto; }
        .title { text-align: center; margin-bottom: 30px; color: #333; }
        .btn-create { display: block; width: fit-content; margin: 0 auto 30px; padding: 10px 25px; background: #3498db; color: #fff; border-radius: 6px; text-decoration: none; font-size: 15px; }
        .btn-create:hover { background: #2980b9; }
        .shipment-card { background: #fff; padding: 20px; margin-bottom: 20px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); transition: transform 0.2s ease; }
        .shipment-card:hover { transform: translateY(-5px); }
        .shipment-header { font-size: 22px; font-weight: bold; color: #2c3e50; margin-bottom: 10px; }
        .shipment-info { font-size: 15px; color: #555; margin: 5px 0; }
        .price { font-size: 18px; color: #27ae60; font-weight: bold; }
        .status-badge { display: inline-block; padding: 3px 10px; border-radius: 12px; font-size: 13px; font-weight: bold; background: #f0f0f0; color: #333; }
        .status-unassigned { background: #ffeaa7; color: #d68910; }
        .status-in_progress { background: #d6eaf8; color: #1a5276; }
        .status-completed { background: #d5f5e3; color: #1e8449; }
        .status-problem { background: #fadbd8; color: #922b21; }
        .document-link { color: #3498db; text-decoration: none; }
        .document-link:hover { text-decoration: underline; }
        .empty { text-align: center; color: #999; font-size: 18px; }
    </style>

    <div class="container">
        <h1 class="title">Shipments List</h1>

        <a href="{{ route('shipments.create') }}" class="btn-create">+ Create New Shipment</a>

        @forelse($shipments as $shipment)
            <div class="shipment-card">
                <div class="shipment-header">{{ $shipment->title }}</div>

                <div class="shipment-info">
                    <strong>Route:</strong> {{ $shipment->from_city }}, {{ $shipment->from_country }}
                    → {{ $shipment->to_city }}, {{ $shipment->to_country }}
                </div>



                <div class="shipment-info price">
                    Price: ${{ number_format($shipment->price, 2) }}
                </div>

                <div class="shipment-info">
                    <strong>Status:</strong>
                    <span class="status-badge status-{{ $shipment->status }}">
                    {{ ucfirst(str_replace('_', ' ', $shipment->status)) }}
                </span>
                </div>

                @if($shipment->details)
                    <div class="shipment-info">
                        <strong>Details:</strong> {{ $shipment->details }}
                    </div>
                @endif

                @if($shipment->documents)
                    <div class="shipment-info">
                        <strong>Document:</strong>
                        <a href="{{ asset('storage/' . $shipment->documents) }}" target="_blank" class="document-link">
                            View Document
                        </a>
                    </div>
                @endif

                <div class="shipment-info">
                    <strong>Created:</strong> {{ $shipment->created_at->format('d.m.Y H:i') }}
                </div>
            </div>

            <div class="shipment-info">
               <a href="{{route('shipments.show'),['shipment' =>$shipment->id]}}">View shipment</a>
            </div>
        @empty
            <div class="empty">No shipments available.</div>
        @endforelse
    </div>

@endsection
