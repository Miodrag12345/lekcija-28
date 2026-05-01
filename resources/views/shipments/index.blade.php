@extends('layout')

@section('content')

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            max-width: 1000px;
            margin: 40px auto;
        }

        .title {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .shipment-card {
            background: #fff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            transition: transform 0.2s ease;
        }

        .shipment-card:hover {
            transform: translateY(-5px);
        }

        .shipment-header {
            font-size: 22px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .shipment-info {
            font-size: 16px;
            color: #555;
            margin: 5px 0;
        }

        .price {
            font-size: 18px;
            color: #27ae60;
            font-weight: bold;
        }

        .empty {
            text-align: center;
            color: #999;
            font-size: 18px;
        }
    </style>

    <div class="container">
        <h1 class="title">Shipments List</h1>

        @forelse($shipments as $shipment)
            <div class="shipment-card">
                <div class="shipment-header">
                    {{ $shipment->title }}
                </div>

                <div class="shipment-info">
                    <strong>ID:</strong> {{ $shipment->id ?? 'N/A' }}
                </div>

                <div class="shipment-info">
                    <strong>Description:</strong> {{ $shipment->description ?? 'No description' }}
                </div>

                <div class="shipment-info price">
                    Price: ${{ $shipment->price }}
                </div>

                <div class="shipment-info">
                    <strong>Created at:</strong> {{ $shipment->created_at ?? 'N/A' }}
                </div>

                <div class="shipment-info">
                    <strong>Updated at:</strong> {{ $shipment->updated_at ?? 'N/A' }}
                </div>
            </div>
        @empty
            <div class="empty">No shipments available.</div>
        @endforelse
    </div>

@endsection
